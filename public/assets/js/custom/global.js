let backDropOverlay = document.getElementById("backDropDiv");
let baseUrl = document.querySelector(`[data-base_url]`).dataset.base_url;
let baseCodeCompany = document.querySelector(`[data-code_company]`).dataset.code_company;
const bodyElement = document.body;

const languageDataTable = {
    "decimal": ",",
    "thousands": ".",
    "lengthMenu": "Mostrar _MENU_ registros",
    "zeroRecords": "No se encontraron resultados",
    "info": "Mostrando página _PAGE_ de _PAGES_",
    "infoEmpty": "No hay registros disponibles",
    "infoFiltered": "(filtrado de _MAX_ registros en total)",
    "search": "Buscar:",
    "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
    },
    "loadingRecords": "Cargando...",
    "processing": "Procesando...",
    "emptyTable": "No hay datos disponibles"
}

const closeModal = (idModal) => {
    document.getElementById(idModal).classList.add('show');
    document.getElementById(idModal).classList.add('hidden');
    document.getElementById("backDropDiv").classList.add('hidden');
}

const openModal = (idModal) => {
    setTimeout(() => {
        document.getElementById(idModal).classList.remove('show');
    }, 100);
    document.getElementById(idModal).classList.remove('hidden');
    document.getElementById("backDropDiv").classList.remove('hidden');
}

function toggleElementState(elementId, show, delay) {
    const element = document.getElementById(elementId);
    if (element) {
        if (!show) {
            element.classList.add('show');
            backDropOverlay.classList.add('hidden');
            setTimeout(() => {
                element.classList.add("hidden");
            }, 350);
        } else {
            element.classList.remove("hidden");
            setTimeout(() => {
                element.classList.remove('show');
                backDropOverlay.classList.remove('hidden');
            }, delay);
        }
        bodyElement.classList.toggle('overflow-hidden', show);
        if (show) {
            openDrawerId = elementId;
            openModalId = elementId;
        } else {
            openDrawerId = null;
            openModalId = null;
        }
    }
}

// Ejemplo de uso
const toastAlert = (
    title = "Toast por defecto",
    icon = "success",
    position = "bottom-end"
) => {
    const Toast = Swal.mixin({
        toast: true,
        position,
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        },
    });
    Toast.fire({
        icon,
        title,
    });
};


const boxAlert = (
    title = "Mensaje por defecto",
    icon = "success",
    tiempo = "3000"
) => {
    Swal.fire({
        position: "center",
        icon: icon,
        title: title,
        showConfirmButton: false,
        timer: tiempo,
    });
};

const boxAlertValidation = (messages) => {
    const messageList = messages.map(message => `<li>${message}</li>`).join('');
    const messageHTML = `<ul>${messageList}</ul>`;

    Swal.fire({
        position: "center",
        icon: "error",
        title: "Error de validación",
        html: messageHTML,
        confirmButtonText: 'Aceptar'
    });
}

document.addEventListener("click", (e) => {
    if (e.target.matches(".btnSidebar")) {
        localStorage.setItem("idActiveElSidebarLotery", e.target.dataset.side_key);
    }
});


const activarItemSidebar = () => {
    let keyElementoActivo = localStorage.getItem("idActiveElSidebarLotery");
    let elementoActivo = document.querySelector(`[data-side_key="${keyElementoActivo}"]`);
    let elementoMenuPadre = elementoActivo.parentNode;
    elementoActivo.classList.add("active");

    let currentElement = elementoActivo;
    let contador = 0;

    while (currentElement) {
        const closestDropdown = currentElement.closest('.dropdown_custom');

        if (closestDropdown) {
            let buttonElement = closestDropdown.children[0];
            let dropdownElement = closestDropdown.children[1];
            dropdownElement.classList.remove("hidden");
            buttonElement.classList.add("show");
            currentElement = closestDropdown.parentElement;

        } else {
            break;
        }

        contador++;

        // Si llega a 10, sale del bucle por seguridad
        if (contador === 10) {
            console.log("Se alcanzó el límite de búsqueda, algo está mal.");
            break;
        }
    }
};

const fileToBase64 = (image) => {
    return new Promise((resolve, reject) => {
        // Crear un objeto FileReader para leer el contenido de la imagen
        let reader = new FileReader();

        // Definir una función onload para el objeto FileReader
        reader.onload = function (event) {
            let base64Image = event.target.result;
            resolve(base64Image);
        };
        reader.onerror = function (error) {
            reject(error);
        };

        // Leer el contenido de la imagen como base64
        reader.readAsDataURL(image);
    });
};

const base64ToArrayBuffer = (base64Data) => {
    const binaryString = window.atob(base64Data);
    const byteArray = new Uint8Array(binaryString.length);
    for (let i = 0; i < binaryString.length; i++) {
        byteArray[i] = binaryString.charCodeAt(i);
    }
    return byteArray.buffer;
};

function bufferToDownloadExcel(buffer, nombreArchivo) {
    const blob = new Blob([buffer], { type: "application/octet-stream" });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement("a");
    a.href = url;
    a.download = nombreArchivo;
    document.body.appendChild(a);
    a.click();
    window.URL.revokeObjectURL(url);
    document.body.removeChild(a);
}

function base64ToDownloadEXCEL(base64Content, nombreArchivo) {
    // Decodificar el contenido Base64
    const byteCharacters = atob(base64Content);
    const byteNumbers = new Array(byteCharacters.length);
    for (let i = 0; i < byteCharacters.length; i++) {
        byteNumbers[i] = byteCharacters.charCodeAt(i);
    }
    const byteArray = new Uint8Array(byteNumbers);

    // Crear un Blob a partir del array de bytes
    const blob = new Blob([byteArray], {
        type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
    });

    // Crear un enlace de descarga y hacer clic en él para descargar el archivo
    const url = URL.createObjectURL(blob);
    const link = document.createElement("a");
    link.href = url;
    link.setAttribute("download", nombreArchivo);
    document.body.appendChild(link);
    link.click();

    // Limpiar
    URL.revokeObjectURL(url);
    document.body.removeChild(link);
}

async function convertirBase64(file) {
    const lector = new FileReader();

    lector.readAsBinaryString(file);

    return new Promise((resolve, reject) => {
        lector.onload = function (evento) {
            const contenido = evento.target.result;
            const base64 = btoa(contenido); // Convierte el contenido a base64
            resolve(base64);
        };
        lector.onerror = function (error) {
            reject(error);
        };
    });
}

function descargarExcel(base64Data) {
    const byteCharacters = atob(base64Data);
    const byteNumbers = new Array(byteCharacters.length);
    for (let i = 0; i < byteCharacters.length; i++) {
        byteNumbers[i] = byteCharacters.charCodeAt(i);
    }
    const byteArray = new Uint8Array(byteNumbers);

    // Crear un blob con los datos decodificados
    const blob = new Blob([byteArray], {
        type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
    });

    // Crear un objeto URL para el blob
    const blobUrl = URL.createObjectURL(blob);

    // Crear un enlace para descargar el archivo
    const link = document.createElement("a");
    link.href = blobUrl;
    link.download = "archivo_excel.xlsx"; // Nombre del archivo Excel
    document.body.appendChild(link);
    link.click();
    URL.revokeObjectURL(blobUrl);
}

const arrayBufferToPDF = (idContainer, arrayBuffer) => {
    document.getElementById(idContainer).innerHTML = "";
    let blob = new Blob([arrayBuffer], { type: "application/pdf" });
    let blobUrl = URL.createObjectURL(blob);
    let iframe = document.createElement("iframe");
    iframe.src = blobUrl;
    iframe.width = "100%";
    iframe.height = "500px";
    document.getElementById(idContainer).appendChild(iframe);
};

const arrayBufferDownloadPDF = (arrayBuffer) => {
    let blob = new Blob([arrayBuffer], { type: "application/pdf" });
    let downloadLink = document.createElement("a");
    downloadLink.href = URL.createObjectURL(blob);
    downloadLink.download = "Tarjeta_circulacion.pdf";
    downloadLink.style.display = "none";
    downloadLink.click();
};


const FormValidate = (idFormulario) => {
    const listaCampos = document.querySelectorAll(`#${idFormulario} [data-validate]`);
    let validacion = true;

    if (listaCampos.length > 0) {
        listaCampos.forEach(elemento => {
            const tipoElemento = elemento.getAttribute("type");
            //validamos campos con value
            if (elemento.value === "") {
                validacion = false;
                elemento.style.setProperty("border", "1px solid red");
                setTimeout(() => {
                    elemento.style.setProperty("border", "");
                }, 2000);
            }

            //validamos campos tipo checkbox
            if (tipoElemento === "checkbox" && !elemento.checked) {
                validacion = false;
                elemento.style.setProperty("border", "1px solid red");
                setTimeout(() => {
                    elemento.style.setProperty("border", "");
                }, 2000);
            }

            //validamos campos tipo radio
            if (tipoElemento === "radio") {
                const name = elemento.getAttribute("name");
                const inputsRadio = document.querySelectorAll(`input[type="radio"][name="${name}"]`);
                let checked = false;

                inputsRadio.forEach(radio => {
                    if (radio.checked) {
                        checked = true;
                    }
                });

                if (!checked) {
                    validacion = false;
                }
            }
        })
    }
    return validacion;
}

const customFetch = async (
    url,
    method = "GET",
    datos = null,
    parseType = "json"
) => {
    try {
        const options = {
            method: method,
            body: datos,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        };
        showLoader();
        const response = await fetch(url, options);
        if (!response.ok) {
            throw new Error("Error de red: " + response.status);
        }
        hideLoader();
        switch (parseType) {
            case "text":
                return await response.text();
            case "buffer":
                return await response.arrayBuffer();
            case "json":
            default:
                return await response.json();
        }
    } catch (error) {
        hideLoader();
        throw error;
    }
};

//inicializar todos los choices del DOM
const initializeChoices = () => {
    document.querySelectorAll('[data-choices]').forEach((element) => {
        const choiceInstance = new Choices(element, {
            searchEnabled: true,  
            itemSelectText: '',  
            shouldSort: false,   
            allowHTML: true   
        });
        choicesInstances.push(choiceInstance);  // Almacena la instancia en el array
    });
}
//destruir todos las instancias choices del DOM
const destroyChoices = (choicesInstances) => {
    choicesInstances.forEach(instance => instance.destroy());
}

const initializeSelect2 = () => {
    const $elements = $('[data-custom_select2]');
    if ($elements.length !== 0) {
        $elements.select2({
            placeholder: 'Selecciona una opción',
            allowClear: true
        });
    }
};

const resetSelect2 = () => {
    // Selecciona todos los select2 y restablece su valor a vacío
    $('[data-custom_select2]').each(function () {
        $(this).val(null).select2('destroy').select2(); // Esto asegura que se reinicia correctamente
    });
};


window.addEventListener("load", () => {
    activarItemSidebar();
})

const formatDate = (isoDate, dateTime = true) => {
    const date = new Date(isoDate);

    const year = date.getUTCFullYear();
    const month = String(date.getUTCMonth() + 1).padStart(2, '0'); // Los meses son 0-indexed
    const day = String(date.getUTCDate()).padStart(2, '0');
    const hours = String(date.getUTCHours()).padStart(2, '0');
    const minutes = String(date.getUTCMinutes()).padStart(2, '0');
    const seconds = String(date.getUTCSeconds()).padStart(2, '0');
    if (dateTime) {
        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    } else {
        return `${year}-${month}-${day}`;
    }
}

window.addEventListener("load", () => {
    activarItemSidebar();
    initializeSelect2();
})