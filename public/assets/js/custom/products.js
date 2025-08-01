let dataTableProducts = null;
let choicesInstances = [];  // Array para almacenar todas las instancias
let dropzoneGlobal = null;

document.addEventListener("DOMContentLoaded", async () => {
    if (document.getElementById("tableProducts") !== null) {
        dataTableProducts = $("#tableProducts").DataTable({
            info: false,
            columnDefs: [
                {
                    targets: 3, // Índice de la columna del botón
                    className: 'text-center' // Aplica clase a toda la columna (si es necesario)
                }
            ],
            language: languageDataTable
        });
    }

    if (document.querySelector(`[data-page_edit]`) !== null) {
        await getProduct();
    } else {
        agregarTemplate("templateProductVariants", "containerProductVariants");
        initDropzone('dropzoneContainerAdd', 'dropzoneAdd', 'dropzonePreviewAdd', false);
    }

});

const getProduct = async () => {
    try {
        const partes = window.location.pathname.split('/').filter(p => p);
        const idProduct = partes[partes.length - 2];
        let response = await customFetch(ROUTES.PRODUCTS + `/${idProduct}`);
        if (response.status === "success") {
            let data = response.data;
            console.log('(luismi): response.data :>> ', response.data);
            initDropzone('dropzoneContainerAct', 'dropzoneAct', 'dropzonePreviewAct', data.imageDetail, data.imageChecks);
        } else {
            boxAlertValidation(response.errors)
        }
    } catch (error) {
        console.log('error :>> ', error);
    }
}

const agregarTemplate = (idTemplate, idContainer) => {
    let template = document.getElementById(idTemplate);

    // Clonar el contenido del template
    let templateClonado = template.content.cloneNode(true);
    let selectTemplate = templateClonado.querySelector("select");
    let contenedor = document.getElementById(idContainer);

    contenedor.appendChild(templateClonado);
    //$(selectTemplate).select2();
};


document.addEventListener("click", (e) => {
    if (e.target.matches("#btnNewVariant")) {
        agregarTemplate("templateProductVariants", "containerProductVariants")
    }

    if (e.target.matches(".btnRemoveVariant")) {
        eliminarTrProducto(e.target);
    }
});

const generateInpoutsToUpload = (description = '', status = false) => {
    const container = document.createElement('div');
    container.classList.add("mt-2")
    container.style.display = 'flex';
    container.style.alignItems = 'center';

    // Crear el input de texto
    const descriptionInput = document.createElement('input');
    descriptionInput.setAttribute('type', 'text');
    descriptionInput.setAttribute('name', 'description[]');
    descriptionInput.setAttribute('placeholder', 'Descripción');
    descriptionInput.setAttribute('data-validate', '');
    descriptionInput.value = description;

    descriptionInput.classList.add(
        'description-input', 'rounded-full', 'form-input', 'border-slate-200',
        'dark:border-zink-500', 'focus:outline-none', 'focus:border-custom-500',
        'disabled:bg-slate-100', 'dark:disabled:bg-zink-600', 'disabled:border-slate-300',
        'dark:disabled:border-zink-500', 'dark:disabled:text-zink-200',
        'disabled:text-slate-500', 'dark:text-zink-100', 'dark:bg-zink-700',
        'dark:focus:border-custom-800', 'placeholder:text-slate-400',
        'dark:placeholder:text-zink-200'
    );

    descriptionInput.style.flex = '1';  // Ocupa el 95% de la fila
    descriptionInput.style.marginRight = '8px';  // Espacio entre el input y el checkbox

    // Crear el input de checkbox
    const checkbox = document.createElement('input');
    checkbox.setAttribute('type', 'checkbox');
    checkbox.setAttribute('value', '1');
    checkbox.setAttribute('name', 'checkbox[]');
    checkbox.checked = status;
    checkbox.classList.add(
        'border', 'rounded-sm', 'appearance-none', 'cursor-pointer', 'size-4',
        'bg-slate-100', 'border-slate-200', 'dark:bg-zink-600', 'dark:border-zink-500',
        'checked:bg-sky-500', 'checked:border-sky-500', 'dark:checked:bg-sky-500',
        'dark:checked:border-sky-500', 'checked:disabled:bg-sky-400',
        'checked:disabled:border-sky-400', 'status-image'
    );

    // Añadir inputs al contenedor
    container.appendChild(descriptionInput);
    container.appendChild(checkbox);

    let inpoutsToUpload = container
    return inpoutsToUpload;
}

const validaVariantesUnicas = (rows) => {
    const combinations = new Set();
    let hasDuplicate = false;

    rows.forEach(row => {
        const selects = row.querySelectorAll('select[name="variant"]');
        if (selects.length < 2) return; // Evitar errores si faltan selects

        const val1 = selects[0].value;
        const val2 = selects[1].value;

        if (!val1 || !val2) return; // Aún no seleccionados

        const comboKey = `${val1}-${val2}`;

        if (combinations.has(comboKey)) {
            hasDuplicate = true;
            row.style.backgroundColor = '#fee2e2'; // marcar visualmente
        } else {
            combinations.add(comboKey);
            row.style.backgroundColor = ''; // limpiar marca previa
        }
    });


    return hasDuplicate;
}

document.addEventListener("submit", async (e) => {
    if (e.target.matches("#formAddProducts")) {
        e.preventDefault();

        if (!FormValidate("formAddProducts")) {
            toastAlert("Algunos campos son necesarios", "warning")
            return;
        }

        const formData = new FormData(e.target);

        let validateCheckboxs = validateSingleCheckbox();
        if (!validateCheckboxs[0]) {
            return toastAlert(validateCheckboxs[1], "warning")
        }

        let validateRadioVariants = validateUniqueRadio();
        if (!validateRadioVariants[0]) {
            return toastAlert(validateRadioVariants[1], "warning")
        }

        let rowsVariants = document.querySelectorAll("#containerProductVariants tr")
        if (validaVariantesUnicas(rowsVariants)) {
            toastAlert("No puede existir dos combinaciones del mismo tipo", "warning");
            return;
        }

        let editorElement = document.querySelector(".ck-editor__editable");
        let contenido = editorElement.innerHTML;

        const variants = [];

        // Seleccionamos todas las filas de combinaciones
        const rows = document.querySelectorAll('#containerProductVariants tr');

        rows.forEach(row => {
            const attributes = [];

            // Capturamos los atributos de cada grupo
            const selects = row.querySelectorAll('select[name="variant"]');
            selects.forEach(select => {
                const attributeId = select.value; // ID del atributo seleccionado
                const description = select.options[select.selectedIndex].text; // Descripción del atributo
                if (attributeId) {
                    attributes.push({ id: attributeId, description: description });
                }
            });

            // Creamos un objeto para la variante actual
            variants.push({
                attributes,
                reference: row.querySelector('input[name="reference"]').value,
                default_price: row.querySelector('input[name="default_price"]').value,
                stock: row.querySelector('input[name="stock"]').value,
                is_default: row.querySelector('input[name="is_default"]:checked') ? true : false
            });
        });

        const { filesFinal, filesChecks } = await getImageDropzone();

        filesFinal.forEach(image => formData.append("imagenes[]", image));
        filesChecks.forEach(check => formData.append("is_main[]", check));
        formData.append("productVariants", JSON.stringify(variants));
        formData.append("description", contenido);

        try {
            let response = await customFetch(
                ROUTES.PRODUCTS + `/store`,
                "POST",
                formData
            )

            if (response.status === "success") {
                boxAlert("Agregado con exito!", "success")
                location.reload();
            } else {
                boxAlertValidation(response.errors)
            }
        } catch (error) {
            console.error('Error de red:', error);
        }

    }

    if (e.target.matches("#formActProducts")) {
        e.preventDefault();

        if (!FormValidate("formActProducts")) {
            toastAlert("Algunos campos son necesarios", "warning")
            return;
        }

        const formData = new FormData(e.target);

        let editorElement = document.querySelector(".ck-editor__editable");
        let contenido = editorElement.innerHTML;

        let validateCheckboxs = validateSingleCheckbox();
        if (!validateCheckboxs[0]) {
            return toastAlert(validateCheckboxs[1], "warning")
        }

        let validateRadioVariants = validateUniqueRadio();
        if (!validateRadioVariants[0]) {
            return toastAlert(validateRadioVariants[1], "warning")
        }

        let rowsVariants = document.querySelectorAll("#containerProductVariants tr")
        if (validaVariantesUnicas(rowsVariants)) {
            toastAlert("No puede existir dos combinaciones del mismo tipo", "warning");
            return;
        }

        // Verifica todos los checkboxes
        e.target.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            if (!checkbox.checked) {
                // Añade el checkbox desmarcado con valor 0
                formData.append(checkbox.name, '0');
            }
        });

        const variants = []; // Array para almacenar todas las variantes

        // Seleccionamos todas las filas de combinaciones
        const rows = document.querySelectorAll('#containerProductVariants tr');

        rows.forEach(row => {
            const attributes = [];

            // Capturamos los atributos de cada grupo
            const selects = row.querySelectorAll('select[name="variant"]');
            selects.forEach(select => {
                const attributeId = select
                    .value; // ID del atributo seleccionado
                const description = select.options[select.selectedIndex]
                    .text; // Descripción del atributo
                if (attributeId) {
                    attributes.push({
                        id: attributeId,
                        description: description
                    });
                }
            });

            // Creamos un objeto para la variante actual
            variants.push({
                attributes,
                idProductAttribute: row.querySelector(
                    'input[name="idProductAttribute"]').value,
                reference: row.querySelector('input[name="reference"]')
                    .value,
                default_price: row.querySelector(
                    'input[name="default_price"]').value,
                stock: row.querySelector('input[name="stock"]').value,
                is_default: row.querySelector(
                    'input[name="is_default"]:checked') ? true :
                    false
            });
        });

        formData.append("description", contenido);
        formData.append("productVariants", JSON.stringify(variants));

        const { filesFinal, filesChecks } = await getImageDropzone();

        filesFinal.forEach(image => formData.append("imagenes[]", image));
        filesChecks.forEach(check => formData.append("is_main[]", check));
        formData.append('_method', 'PUT');

        try {
            let response = await customFetch(
                ROUTES.PRODUCTS + `/${e.target.id.value}`,
                "POST",
                formData
            );
            console.log('response :>> ', response);
            if (response.status) {
                boxAlert("Actualizado con exito!", "success")
            } else {
                boxAlertValidation(response.errors)
            }
        } catch (error) {
            console.error('Error de red:', error);
        }

    }

});

const eliminarTrProducto = (elemento) => {
    let trPadre = elemento.parentNode.parentNode.parentNode;
    let tBody = elemento.parentNode.parentNode.parentNode.parentNode;
    let trs = tBody.querySelectorAll("tr");
    if (trs.length <= 1) return;
    trPadre.remove();
};

function validateSingleCheckbox() {
    // Obtener todos los checkboxes con la clase especificada
    const checkboxes = document.querySelectorAll('[name="check_main_image"]');
    // Filtrar los checkboxes que están marcados
    const checkedCheckboxes = Array.from(checkboxes).filter(checkbox => checkbox.checked);
    let message = "";
    let isValidate = true;

    // Verificar que solo uno esté marcado
    if (checkedCheckboxes.length !== 1) {
        if (checkedCheckboxes.length === 0) {
            message = "Debe marcar por lo menos una imagen principal"
            isValidate = false;
        } else {
            message = "No puede marcar mas de una imagen principal"
            isValidate = false;
        }
    }
    return [isValidate, message];
}

function validateUniqueRadio() {
    const radios = document.querySelectorAll('.radio-default-variant');

    const isChecked = Array.from(radios).some(radio => {
        return radio.checked;
    });

    let message = "";
    let isValidate = true;

    if (!isChecked) {
        message = "Debe marcar una variante por defecto";
        isValidate = false;
    }

    return [isValidate, message];
}


const initDropzone = (container, element, dropzonePreviewElement, files = false, checks = false) => {
    console.log('(luismi): checks :>> ', checks);
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
        maxFiles: 5, // Permitir solo un archivo
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
        const removeButton = file.previewElement.querySelector(`#${container} .dz-remove-button`);
        if (removeButton) {
            removeButton.addEventListener("click", (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropzoneGlobal.removeFile(file);
            });
        }
    });
    console.log('(luismi): files :>> ', files);
    if (files) {
        files.forEach((file, index) => {
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

            // Esperar a que el DOM del preview esté disponible
            setTimeout(() => {
                const previews = document.querySelectorAll(`#${dropzonePreviewElement} .dz-preview`);
                const currentPreview = previews[index];
                console.log('(luismi): currentPreview :>> ', currentPreview);

                if (currentPreview) {
                    const radioInput = currentPreview.querySelector('input.primary-image-checkbox');
                    if (radioInput && checks[index] === 1) {
                        radioInput.checked = true;
                    }
                }
            }, 100);
        });
    }
}

const getImageDropzone = async () => {
    const filesToUpload = dropzoneGlobal.files;
    const filesFinal = [];
    const filesChecks = [];

    for (const file of filesToUpload) {
        const statusImage = file.previewElement.querySelector("[name='check_main_image']");
        filesChecks.push(statusImage.checked);

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

    return { filesFinal, filesChecks };
};