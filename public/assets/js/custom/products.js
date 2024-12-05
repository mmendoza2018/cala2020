let dataTableProducts = null;
let choicesInstances = [];  // Array para almacenar todas las instancias

document.addEventListener("DOMContentLoaded", () => {
    if (document.getElementById("tableProducts") !== null) {
        dataTableProducts = $("#tableProducts").DataTable({
            info: false,
            columnDefs: [
                {
                    targets: 3, // Índice de la columna del botón
                    className: 'text-center' // Aplica clase a toda la columna (si es necesario)
                }
            ]
        });
    }
    initializeChoices();
});
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

let dropzoneAdd = null;
if (document.querySelector(".dropzoneAdd") !== null) {

    agregarTemplate("templateProductVariants", "containerProductVariants");

    let dropzonePreviewNode = document.querySelector("#dropzone-preview-list");
    dropzonePreviewNode.id = "";
    let previewTemplate = dropzonePreviewNode.parentNode.innerHTML;
    dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode);

    dropzoneAdd = new Dropzone(".dropzoneAdd", {
        url: 'https://httpbin.org/post',
        method: "post",
        previewTemplate: previewTemplate,
        previewsContainer: "#dropzone-preview",
        clickable: ".dropzoneAdd", // Asegúrate de que solo el área de dropzone sea clicable
    });

    dropzoneAdd.on("addedfile", (file) => {
        let inpoutsToUpload = generateInpoutsToUpload();
        file.previewElement.appendChild(inpoutsToUpload);
    });

}

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

        let editorElement = document.querySelector(".ck-editor__editable");
        let contenido = editorElement.innerHTML;

        const variants = []; // Array para almacenar todas las variantes

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

        formData.append("productVariants", JSON.stringify(variants));
        formData.append("description", contenido);

        dropzoneAdd.files.forEach(file => {
            // Encuentra el input de descripción asociado
            const descriptionInput = file.previewElement.querySelector('.description-input');
            const StatusImage = file.previewElement.querySelector('.status-image');
            if (descriptionInput) {
                // Añade la descripción al FormData junto con el archivo
                formData.append("imageDescriptions[]", descriptionInput.value);
                formData.append("imageStatus[]", StatusImage.checked);
            }
            // Añade el archivo al FormData
            formData.append("productImages[]", file);
        });

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
    const checkboxes = document.querySelectorAll('.status-image');
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


const selectRaffle = (element) => {
    
    const containerFile = document.getElementById("containerFile");
    const inputFile = `<label class="inline-block text-base font-medium">Calendario digital</label>
                        <input type="file" accept="image/*,application/pdf" class="cursor-pointer form-file border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500" name="digital_product">`;

    if (element.value === "") {
        containerFile.innerHTML = "";
    } else {
        containerFile.innerHTML = inputFile;
    }

}
