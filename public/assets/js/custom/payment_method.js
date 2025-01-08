let dropzoneArray = [];

window.addEventListener("load", () => {
    console.log("entre");

    //agregarTemplate("templateAttencionNumbers", "containerAttencionNumbers");
    //getSocialNetworks();

})


document.addEventListener("submit", async (e) => {
    if (e.target.matches("#formActSocialNetwork")) {
        e.preventDefault();

        if (!FormValidate("formActSocialNetwork")) {
            toastAlert("Algunos campos son necesarios", "warning")
            return;
        }

        try {
            // Seleccionar todas las filas de la tabla
            let rows = document.querySelectorAll("#containerSocialNetwork tr");
            let formData = new FormData();
            let finalArray = [];

            // Iterar sobre cada fila para extraer datos
            rows.forEach(tr => {
                let selectElement = tr.querySelector(".socialSelect");
                let selectedOption = $(selectElement).select2('data')[0];

                // Extraer datos del select y de otras columnas
                let obj = {
                    description: selectedOption.id, // Valor del select
                    icon: $(selectElement).find(`option[value="${selectedOption.id}"]`).data('icon'),
                    link: tr.querySelector(".link").value,
                    id: tr.querySelector(".id").value
                };
                finalArray.push(obj);
            });

            console.log('finalArray :>> ', finalArray);

            // Añadir el array al FormData
            formData.append('socialNetworks', JSON.stringify(finalArray));
            formData.append('_method', 'PUT');

            let url = ROUTES.SOCIAL_NETWORK + `/update`;
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
        agregarTemplate("templateSocialNetwork", "containerSocialNetwork")
    }

    if (e.target.matches(".btnRemoveSocialNetwork")) {
        eliminarTrProducto(e.target);
    }
});


const eliminarTrProducto = (elemento) => {
    let trPadre = elemento.parentNode.parentNode;
    let tBody = elemento.parentNode.parentNode.parentNode;
    let trs = tBody.querySelectorAll("tr");
    if (trs.length <= 1) return;
    trPadre.remove();
};

const agregarTemplate = (idTemplate, idContainer, data = null) => {

    let template = document.getElementById(idTemplate);
    let templateClonado = template.content.cloneNode(true);
    let contenedor = document.getElementById(idContainer);
    let select = templateClonado.querySelector("select");
    let trs = contenedor.querySelectorAll("tr");
    const socialSelect = templateClonado.querySelector(".socialSelect");
    const linkInput = templateClonado.querySelector(".link");
    const idInput = templateClonado.querySelector(".id");
    const dropzoneContainerElement = templateClonado.querySelector(".dropzone-container");
    console.log(dropzoneContainerElement);

    if (trs.length >= 5) return;
    contenedor.appendChild(templateClonado);

    createDropZone(dropzoneContainerElement, data);

    if (data) {
        linkInput.value = data.link;
        idInput.value = data.id;
        $(socialSelect).val(data.name).trigger('change');
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
        let mockFile = {
            name: file.logo_file.name,
            size: file.logo_file.size,
            url: file.logo_file.url,
            isMock: true
        };

        // Emitir los eventos de Dropzone para añadir el archivo
        dropzoneAdd.emit("addedfile", mockFile);
        dropzoneAdd.emit("thumbnail", mockFile, file.logo_file.url);
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

const getSocialNetworks = async (id) => {
    try {
        let response = await customFetch(ROUTES.SOCIAL_NETWORK);
        if (response.status === "success") {
            console.log('response :>> ', response);
            let data = response.data;

            data.forEach(element => {
                agregarTemplate("templateSocialNetwork", "containerSocialNetwork", element)
            });

        } else {
            boxAlertValidation(response.errors)
        }
    } catch (error) {
        console.log('error :>> ', error);
    }
}