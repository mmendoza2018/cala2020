let dropzoneAdd = null;

document.addEventListener("DOMContentLoaded", () => {

    initDropzone();

})

const initDropzone = async () => {

    let file = await getGeneralInfo();

    document.getElementById("id").value = file.id;
    document.getElementById("title").value = file.title;
    document.getElementById("business_name").value = file.business_name;
    document.getElementById("ruc").value = file.ruc;
    document.getElementById("address").value = file.address;
    document.getElementById("email").value = file.email;
    document.getElementById("description").value = file.description;

    const previewTemplate = document.querySelector("#preview-template").innerHTML;

    dropzoneAdd = new Dropzone(".dropzone-container, .dropzoneAdd", {
        url: "https://httpbin.org/post", // URL ficticia, no se usará aún
        method: "post",
        previewTemplate: previewTemplate,
        previewsContainer: "#dropzone-preview",
        clickable: ".dropzone-container, .dropzoneAdd", // Click solo dentro del área de Dropzone
        autoProcessQueue: false, // No subir automáticamente
        addRemoveLinks: false, // Usamos nuestro propio botón de eliminar
        maxFiles: 1, // Permitir solo un archivo
        acceptedFiles: "image/*", // Solo aceptar imágenes
    });

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

        // Marcar imagen como principal
        /*  const primaryCheckbox = file.previewElement.querySelector(".primary-image-checkbox");
         primaryCheckbox.addEventListener("change", (e) => {
             if (e.target.checked) {
                 // Desmarcar todas las demás imágenes
                 document
                     .querySelectorAll(".primary-image-checkbox")
                     .forEach((checkbox) => {
                         if (checkbox !== e.target) checkbox.checked = false;
                     });
             }
         }); */
    });

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
const getGeneralInfo = async () => {

    try {
        let defaultId = 1;
        let response = await customFetch(ROUTES.GENERAL_STORE + "/" + defaultId)
        if (response.status === "success") {
            return response.data;
        } else {
            boxAlertValidation(response.errors)
        }
    } catch (error) {
        console.error('Error de red:', error);
    }

}


document.addEventListener("submit", async (e) => {
    if (e.target.matches("#formAddGeneralConfig")) {

        e.preventDefault();
        if (!FormValidate("formAddGeneralConfig")) {
            toastAlert("Algunos campos son necesarios", "warning")
            return;
        }

        const formData = new FormData(e.target);
        const acceptedFiles = dropzoneAdd.getAcceptedFiles();
        console.log('dropzoneAdd.files :>> ', dropzoneAdd.files);
        console.log('acceptedFiles :>> ', acceptedFiles);


        let fileToUpload = dropzoneAdd.files[0];

        if (!(fileToUpload instanceof File)) {
            const response = await fetch(fileToUpload.url);
            const blob = await response.blob();
            fileToUpload = new File([blob], fileToUpload.name, {
                type: blob.type
            });
        }

        formData.append("logo", fileToUpload);
        formData.append('_method', 'PUT');

        try {
            let response = await customFetch(ROUTES.GENERAL_STORE + `/update`, "POST", formData)
            if (response.status === "success") {
                boxAlert("Actualizado con exito!", "success")
                setTimeout(() => {
                    location.reload();
                }, 1500);
            } else {
                boxAlertValidation(response.errors)
            }
        } catch (error) {
            console.error('Error de red:', error);
        }
    }
});
