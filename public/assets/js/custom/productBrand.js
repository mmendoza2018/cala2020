let dataTableBrandProduct = null;

window.addEventListener("load", () => {
    dataTableBrandProduct = $("#tableProductBrand").DataTable({
        info: false,
        columnDefs: [
            {
                targets: 3, // Índice de la columna del botón
                className: 'text-center' // Aplica clase a toda la columna (si es necesario)
            }
        ]
    });
});


document.addEventListener("submit", async (e) => {
    if (e.target.matches("#formAddproductBrand")) {
        e.preventDefault();

        if (!FormValidate("formAddproductBrand")) {
            toastAlert("Algunos campos son necesarios", "warning")
            return;
        }

        const formData = new FormData(e.target);
        const images = await getImageDropzone();
        if (images.length <= 0) return boxAlert("La imagen no puede estar vacia", "warning");

        formData.append("imagen", images[0]);

        try {
            let response = await customFetch(
                ROUTES.PRODUCT_BRAND + `/store`,
                "POST",
                formData
            )

            if (response.status === "success") {
                boxAlert("Agregado con exito!", "success")
                closeModal("modalAddProductBrand")
                e.target.reset();
                let data = response.data;
                let btnActHTML = `<i class="ri-edit-box-fill ri-xl cursor-pointer" onclick="getProductBrand('${data.id}')"></i>`;
                let img = `<img src="${baseUrl}/storage/uploads/${data.imagen}" class="h-10 h-16 rounded-md" style="width: 4rem">`;

                let rowNode = dataTableBrandProduct.row.add([
                    data.id,
                    img,
                    data.description,
                    btnActHTML
                ]).draw(false).node(); // Obtén el nodo DOM de la fila

                let $row = $(rowNode);

                $row.attr('data-table', data.id);
            } else {
                boxAlertValidation(response.errors)
            }
        } catch (error) {
            console.error('Error de red:', error);
        }
    }

    if (e.target.matches("#formActproductBrand")) {
        e.preventDefault();

        if (!FormValidate("formActproductBrand")) {
            toastAlert("Algunos campos son necesarios", "warning")
            return;
        }

        const formData = new FormData(e.target);
        const images = await getImageDropzone();
        if (images.length <= 0) return boxAlert("La imagen no puede estar vacia", "warning");
        
        formData.append("imagen", images[0]);
        formData.append('_method', 'PUT');

        try {
            let response = await customFetch(
                ROUTES.PRODUCT_BRAND + `/${e.target.id.value}`,
                "POST",
                formData
            )

            if (response.status === "success") {
                boxAlert("Actualizado con exito!", "success")
                closeModal("modalActProductBrand")
                e.target.reset();
                let data = response.data;
                let trUpdatedElement = $('[data-table="' + data.id + '"]')[0];
                const trUpdated = dataTableBrandProduct.row(trUpdatedElement);
                let btnAct = trUpdatedElement.querySelector("i").outerHTML;
                let img = `<img src="${baseUrl}/storage/uploads/${data.imagen}" class="h-10 h-16 rounded-md" style="width: 4rem">`;

                if (data.status == 0) return trUpdated.remove().draw(false);

                trUpdated
                    .data([data.id,img, data.description, btnAct])
                    .draw(false);
            } else {
                boxAlertValidation(response.errors)
            }
        } catch (error) {
            console.error('Error de red:', error);
        }
    }

});

const openModalAdd = () => {
    openModal('modalAddProductBrand');
    initDropzone('dropzoneContainerAdd', 'dropzoneAdd', 'dropzonePreviewAdd', false);
}

const initDropzone = (container, element, dropzonePreviewElement, files = false) => {
    const dropzoneSelector = `#${container}, #${element}`;
    // 🔴 1. Destruir instancia previa si existe
    Dropzone.instances.forEach((dz) => {
        if (dz.element.matches(dropzoneSelector)) {
            dz.destroy();
        }
    });

    dropzoneGlobal = null;

    const previewTemplate = document.querySelector("#preview-template").innerHTML;
    // Destruye instancias anteriores si existen

    dropzoneGlobal = new Dropzone(`#${container}, #${element}`, {
        url: "https://httpbin.org/post", // URL ficticia, no se usará aún
        method: "post",
        previewTemplate: previewTemplate,
        previewsContainer: `#${dropzonePreviewElement}`,
        clickable: `#${container}, #${element}`, // Click solo dentro del área de Dropzone
        autoProcessQueue: false, // No subir automáticamente
        addRemoveLinks: false, // Usamos nuestro propio botón de eliminar
        maxFiles: 1, // Permitir solo un archivo
        acceptedFiles: "image/*", // Solo aceptar imágenes
        thumbnailWidth: null,
        thumbnailHeight: null,
    });

    dropzoneGlobal.on("thumbnail", (file, dataUrl) => {
        const thumbnail = file.previewElement.querySelector("[data-dz-thumbnail]");
        if (thumbnail) {
            thumbnail.style.objectFit = "contain";
        }
    });

    dropzoneGlobal.on("addedfile", (file) => {
        // Elimina anteriores si hay más de uno
        if (dropzoneGlobal.files.length > 1) {
            const filesToRemove = dropzoneGlobal.files.filter(f => f !== file);
            filesToRemove.forEach(f => dropzoneGlobal.removeFile(f));
        }

        const removeButton = file.previewElement.querySelector(`#${container} .dz-remove-button`);
        if (removeButton) {
            removeButton.addEventListener("click", (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropzoneGlobal.removeFile(file);
            });
        }
    });

    if (files) {
        files.forEach(file => {
            const mockFile = {
                name: file.name,
                size: file.size,
                url: file.url,
                isMock: true
            };

            dropzoneGlobal.emit("addedfile", mockFile);
            dropzoneGlobal.emit("thumbnail", mockFile, file.url);
            dropzoneGlobal.emit("complete", mockFile);

            dropzoneGlobal.files.push(mockFile);
        });
    }
}

const getImageDropzone = async () => {
    const filesToUpload = dropzoneGlobal.files;
    const filesFinal = [];

    for (const file of filesToUpload) {
        if (file instanceof File) {
            // Archivo real, simplemente lo agregamos
            filesFinal.push(file);
        } else if (file.url) {
            // Mock file: convertir a File desde URL
            try {
                const response = await fetch(file.url);
                const blob = await response.blob();
                const realFile = new File([blob], file.name, {
                    type: blob.type,
                });
                filesFinal.push(realFile);
            } catch (err) {
                console.error("Error al convertir mock a File:", err);
            }
        }
    }

    return filesFinal;
};

const getProductBrand = async (id) => {
    try {
        openModal("modalActProductBrand");

        let response = await customFetch(ROUTES.PRODUCT_BRAND + `/${id}`);
        if (response.status === "success") {
            console.log('response :>> ', response);
            let data = response.data;
            if (data.imageDetail) {
                initDropzone('dropzoneContainerAct','dropzoneAct','dropzonePreviewAct', data.imageDetail);
            }
            document.getElementById("id").value = data.id;
            document.getElementById("description").value = data.description;
            document.getElementById("status").value = data.status;
        } else {
            boxAlertValidation(response.errors)
        }
    } catch (error) {
        console.log('error :>> ', error);
    }
}


document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('updateCategoryProduct', (event) => {
        let data = event["detail"][0]["data"];

        let trUpdatedElement = $('[data-table="' + data.id + '"]')[0];
        const trUpdated = dataTableBrandProduct.row(trUpdatedElement);
        let btnAct = trUpdatedElement.querySelector("i").outerHTML;

        if (data.status == 0) return trUpdated.remove().draw(false);

        trUpdated
            .data([data.id, data.description, data.code, btnAct])
            .draw(false);

        trUpdatedElement.querySelector("i").addEventListener('click', function () {
            Livewire.dispatch('reloadDataCategoryProduct', [data.id]);
            toggleElementState("modalActCategoryProduct", true, 0);
        });
    });


    window.addEventListener('registerCategoryProduct', (event) => {
        let data = event["detail"][0]["data"];

        boxAlert("Agregado con éxito!", "success");
        closeModal("modalAddCategoryProduct");

        let btnActHTML = `<i class="ri-edit-box-fill ri-xl cursor-pointer"
                             data-modal-target="modalAddCategoryProduct"
                             onclick="Livewire.dispatch('reloadDataCategoryProduct', [${data.id}])"></i>`;

        let rowNode = dataTableBrandProduct.row.add([
            data.id,
            data.description,
            data.code,
            btnActHTML
        ]).draw(false).node(); // Obtén el nodo DOM de la fila

        let $row = $(rowNode);

        // Añade el atributo data-table con el ID del empleado
        $row.attr('data-table', data.id);

        document.querySelector(`[data-table="${data.id}"] i`).addEventListener('click', function () {
            Livewire.dispatch('reloadDataCategoryProduct', [data.id]);
            toggleElementState("modalActCategoryProduct", true, 0);
        });

    });
});