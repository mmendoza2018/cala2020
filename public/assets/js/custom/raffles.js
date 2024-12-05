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

const agregarTemplate = (idTemplate, idContainer, defaultValues = null) => {
    let template = document.getElementById(idTemplate);

    let templateClonado = template.content.cloneNode(true);
    let selectTemplate = templateClonado.querySelector("select");
    let inputsTemplate = templateClonado.querySelectorAll("input");
    let contenedor = document.getElementById(idContainer);

    contenedor.appendChild(templateClonado);
    const values = [
        {
            value: 'acelerate.svg',
            label: `<img src="${baseUrl}/assets/images/icons-db/acelerate.svg" style="width: 40px; height: 40px"/>`,
            id: 1
        },
        {
            value: 'bike01.svg',
            label: `<img src="${baseUrl}/assets/images/icons-db/bike01.svg" style="width: 40px; height: 40px"/>`,
            id: 1
        },
        {
            value: 'bike02.svg',
            label: `<img src="${baseUrl}/assets/images/icons-db/bike02.svg" style="width: 40px; height: 40px"/>`,
            id: 1
        },
        {
            value: 'bike03.svg',
            label: `<img src="${baseUrl}/assets/images/icons-db/bike03.svg" style="width: 40px; height: 40px"/>`,
            id: 1
        },
        {
            value: 'bike04.svg',
            label: `<img src="${baseUrl}/assets/images/icons-db/bike04.svg" style="width: 40px; height: 40px"/>`,
            id: 1
        },
        {
            value: 'bike05.svg',
            label: `<img src="${baseUrl}/assets/images/icons-db/bike05.svg" style="width: 40px; height: 40px"/>`,
            id: 1
        },
        {
            value: 'date.svg',
            label: `<img src="${baseUrl}/assets/images/icons-db/date.svg" style="width: 40px; height: 40px"/>`,
            id: 1
        },
        {
            value: 'engine.svg',
            label: `<img src="${baseUrl}/assets/images/icons-db/engine.svg" style="width: 40px; height: 40px"/>`,
            id: 1
        },
        {
            value: 'part.svg',
            label: `<img src="${baseUrl}/assets/images/icons-db/part.svg" style="width: 40px; height: 40px"/>`,
            id: 1
        },
        {
            value: 'power.svg',
            label: `<img src="${baseUrl}/assets/images/icons-db/power.svg" style="width: 40px; height: 40px"/>`,
            id: 1
        },
        {
            value: 'scape.svg',
            label: `<img src="${baseUrl}/assets/images/icons-db/scape.svg" style="width: 40px; height: 40px"/>`,
            id: 1
        },
        {
            value: 'speed.svg',
            label: `<img src="${baseUrl}/assets/images/icons-db/speed.svg" style="width: 40px; height: 40px"/>`,
            id: 1
        },
        {
            value: 'tire.svg',
            label: `<img src="${baseUrl}/assets/images/icons-db/tire.svg" style="width: 40px; height: 40px"/>`,
            id: 1
        },
        {
            value: 'acelerate02.svg',
            label: `<img src="${baseUrl}/assets/images/icons-db/acelerate02.svg" style="width: 40px; height: 40px"/>`,
            id: 1
        },
    ]
    const choiceInstance = new Choices(selectTemplate, {
        choices: values,
        allowHTML: true,
        searchEnabled: true,
        itemSelectText: '',
        shouldSort: false,     // Permite HTML en las opciones si es necesario
    });

    choicesInstances.push(choiceInstance);

    if (defaultValues) {
        choiceInstance.setChoiceByValue(defaultValues.image_name);
        inputsTemplate[0].value = defaultValues.id;
        inputsTemplate[1].value = defaultValues.title;
        inputsTemplate[2].value = defaultValues.description;
    }
    //$(selectTemplate).select2();
};

document.addEventListener("click", (e) => {
    if (e.target.matches("#btnNewFeature")) {

        agregarTemplate("templateFeatures", "containerFeatures")
    }

    if (e.target.matches(".btnRemoveFeature")) {
        eliminarTrProducto(e.target);
    }
});

let dropzoneAdd = null;
if (document.querySelector(".dropzoneAdd") !== null) {

    agregarTemplate("templateFeatures", "containerFeatures")

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
    if (e.target.matches("#formAddRaffles")) {
        e.preventDefault();

        if (!FormValidate("formAddRaffles")) {
            toastAlert("Algunos campos son necesarios", "warning")
            return;
        }

        const formData = new FormData(e.target);
        let validateCheckboxs = validateSingleCheckbox();
        if (!validateCheckboxs[0]) {
            return toastAlert(validateCheckboxs[1], "warning")
        }

        let editorElement = document.querySelector(".ck-editor__editable");
        let contenido = editorElement.innerHTML;

        const rowsVariants = document.querySelectorAll("#containerFeatures tr");
        let arrayVariants = [];
        rowsVariants.forEach(tr => {
            let inputs = tr.querySelectorAll("input");
            let variant = {
                "iconName": tr.querySelector("select").value,
                "title": inputs[1].value,
                "description": inputs[2].value,
            }
            arrayVariants.push(variant)
        });
        formData.append("description", contenido);
        formData.append("RaffleFeatures", JSON.stringify(arrayVariants));

        console.log('RaffleFeatures :>> ', JSON.stringify(arrayVariants));

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
            formData.append("RaffleImages[]", file);
        });
        try {
            let response = await customFetch(
                ROUTES.RAFFLES + `/store`,
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
