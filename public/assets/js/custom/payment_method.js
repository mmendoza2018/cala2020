let dropzoneArray = [];

window.addEventListener("load", () => {

    getPaymentMethods();

})


document.addEventListener("submit", async (e) => {
    if (e.target.matches("#formActSocialNetwork")) {
        e.preventDefault();

        if (!FormValidate("formActSocialNetwork")) {
            toastAlert("Algunos campos son necesarios", "warning")
            return;
        }

        try {
            let rows = document.querySelectorAll("#containerPaymentMethods tr");
            let formData = new FormData();
            let finalArray = [];
            console.log('dropzoneArray :>> ', dropzoneArray);

            // Iterar sobre cada fila para extraer datos
            for (const [index, tr] of rows.entries()) {
                console.log("Procesando fila:", index + 1);

                // Obtener archivos aceptados de Dropzone
                let acceptedFiles = dropzoneArray[index].getAcceptedFiles();
                let instanciasDropzone = dropzoneArray[index].files;
                console.log('instanciasDropzone :>> ', instanciasDropzone);

                
                // Solo permitimos un archivo por Dropzone, obtener el primero
                let fileToUpload = instanciasDropzone[0];
                
                if (!fileToUpload) {
                    console.log(`La imagen #${index + 1} no puede estar vacía`, "warning");
                    continue; // Saltar esta iteración si no hay archivos
                }

                // Verificar si el archivo es un mock y convertirlo a File
                if (!(fileToUpload instanceof File)) {
                    const response = await fetch(fileToUpload.url);
                    const blob = await response.blob();
                    fileToUpload = new File([blob], fileToUpload.name, {
                        type: blob.type
                    });
                }

                // Agregar archivo al FormData
                formData.append("images[]", fileToUpload);
                console.log(`Archivo procesado (fila ${index + 1}):`, fileToUpload);

                let obj = {
                    description: tr.querySelector(".description").value,
                    id: tr.querySelector(".id").value
                };

                finalArray.push(obj);
            }

            // Añadir el array al FormData
            formData.append('paymentMethods', JSON.stringify(finalArray));
            formData.append('_method', 'PUT');
            let url = ROUTES.PAYMENT_METHOD + `/update`;
            let response = await customFetch(url, "POST", formData)
            if (response.status === "success") {
                boxAlert("Actualizado con exito!", "success")
            } else {
                boxAlertValidation(response.errors)
            }
        } catch (error) {
            console.error('Error de red:', error);
        }
    }

});

document.addEventListener("click", (e) => {
    if (e.target.matches("#btnAddAttencionNumber")) {
        agregarTemplate("templatePaymentMethods", "containerPaymentMethods")
    }

    if (e.target.matches(".btnRemovePaymentMethod")) {
        eliminarTrProducto(e.target);
    }
});


const eliminarTrProducto = (elemento) => {
    let trPadre = elemento.parentNode.parentNode;
    let tBody = trPadre.parentNode;
    let trs = Array.from(tBody.querySelectorAll("tr")); // Convertir a array para usar indexOf
    let posicion = trs.indexOf(trPadre); // Obtener posición en base 0
    
    dropzoneArray.splice(posicion, 1);

    if (trs.length <= 1) return;
    trPadre.remove();
};

const agregarTemplate = (idTemplate, idContainer, data = null) => {

    let template = document.getElementById(idTemplate);
    let templateClonado = template.content.cloneNode(true);
    let contenedor = document.getElementById(idContainer);
    let trs = contenedor.querySelectorAll("tr");
    const descripcionInput = templateClonado.querySelector(".description");
    const idInput = templateClonado.querySelector(".id");
    const dropzoneContainerElement = templateClonado.querySelector(".dropzone-container-sm");

    if (trs.length >= 5) return;
    contenedor.appendChild(templateClonado);

    createDropZone(dropzoneContainerElement, data);

    if (data) {
        descripcionInput.value = data.description;
        idInput.value = data.id;
    }

};

const createDropZone = (element, data) => {
    const zoneElement = element.querySelector(".dropzoneAdd");
    const previewElement = element.querySelector("#dropzone-preview");
    const previewTemplate = document.querySelector("#preview-template").innerHTML;

    dropzoneAdd = new Dropzone(element, {
        url: "https://httpbin.org/post", // URL ficticia, no se usará aún
        method: "post",
        previewTemplate: previewTemplate,
        previewsContainer: previewElement,
        clickable: element, // Click solo dentro del área de Dropzone
        autoProcessQueue: false, // No subir automáticamente
        addRemoveLinks: false, // Usamos nuestro propio botón de eliminar
        maxFiles: 1, // Permitir solo un archivo
        acceptedFiles: "image/*", // Solo aceptar imágenes
    });

    //Este evento se dispara automáticamente cuando Dropzone genera una miniatura
    dropzoneAdd.on("thumbnail", (file, dataUrl) => {
        const thumbnail = file.previewElement.querySelector("[data-dz-thumbnail]");
        if (thumbnail) {
            thumbnail.style.objectFit = "contain";
        }
    });

    dropzoneAdd.on("addedfile", (file) => {
        // Eliminar archivo del Dropzone cuando se haga clic en el botón eliminar
        const removeButton = file.previewElement.querySelector(".dz-remove-button");
        removeButton.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropzoneAdd.removeFile(file);
        });
    });

    if (data) {
        console.log("entro a crear el mock");

        let mockFile = {
            name: data.image,
            size: data.size,
            url: '/storage/uploads/' + data.image,
            isMock: true
        };

        // Emitir los eventos de Dropzone para añadir el archivo
        dropzoneAdd.emit("addedfile", mockFile);
        dropzoneAdd.emit("thumbnail", mockFile, '/storage/uploads/' + data.image);
        dropzoneAdd.emit("complete", mockFile);

        // Añadir el archivo a la lista de archivos de Dropzone
        dropzoneAdd.files.push(mockFile);
    }

    dropzoneArray.push(dropzoneAdd);
}

const getProductBrand = async (id) => {
    try {
        openModal("modalActProductBrand");

        let response = await customFetch(ROUTES.PRODUCT_BRAND + `/${id}`);
        if (response.status === "success") {
            console.log('response :>> ', response);
            let data = response.data;
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

const getPaymentMethods = async (id) => {
    try {
        let response = await customFetch(ROUTES.PAYMENT_METHOD);
        if (response.status === "success") {
            console.log('response :>> ', response);
            let data = response.data;

            data.forEach(paymentMethod => {
                agregarTemplate("templatePaymentMethods", "containerPaymentMethods", paymentMethod)
            });

        } else {
            boxAlertValidation(response.errors)
        }
    } catch (error) {
        console.log('error :>> ', error);
    }
}