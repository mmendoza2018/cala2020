var backDropOverlay = document.getElementById("backDropDiv");
const bodyElement = document.body;
console.log('(luismi):>> 33333333333333');
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

/* // Mostrar el loader
function showLoader() {
    const loader = document.getElementById('loaderGlobal');
    loader.classList.add("show_loader");
}

// Ocultar el loader
function hideLoader() {
    const loader = document.getElementById('loaderGlobal');
    loader.classList.remove("show_loader");
} */
// Ejemplo de uso
const toastAlert = (
    title = "Toast por defecto",
    icon = "success",
    position = "bottom-end",
    timer = 3000
) => {
    const Toast = Swal.mixin({
        toast: true,
        position,
        showConfirmButton: false,
        timer,
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

const boxAlertWidthConfirmation = (
    title = "Mensaje por defecto",
    text = "",
    icon = "success",
    showConfirmButton = true,
) => {
    Swal.fire({
        position: "center",
        icon,
        title,
        text,
        showConfirmButton,  // Mostramos el botón OK
        confirmButtonText: 'Aceptar',  // Texto del botón OK
        showCloseButton: true,  // Opción para mostrar un botón de cierre adicional
        allowOutsideClick: false,  // Deshabilitamos el cierre al hacer clic fuera
        allowEscapeKey: false
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


const operacionPrecioCantidad = (elemento) => {
    let trPadre = elemento.parentNode.parentNode;
    let valuePrecioProducto = trPadre.querySelector(`[data-multi_campo_op_1]`).value || 1;
    let valueCantidadProducto = trPadre.querySelector(`[data-multi_campo_op_2]`).value || 1;
    let inputTotalPorProducto = trPadre.querySelector(`[data-multi_total_op]`);

    let totalSuma =
        parseFloat(valuePrecioProducto) * parseFloat(valueCantidadProducto);
    inputTotalPorProducto.value = totalSuma;
    sumarTotalProductos();
};

const sumarTotalProductos = () => {
    let elementosASumar = document.querySelectorAll(`[data-sum_global_campo]`);
    let sumaGlobal = 0;
    elementosASumar.forEach((inputTotal) => {
        sumaGlobal += parseFloat(inputTotal.value || 0);
    });
    document.querySelector(`[data-sum_global_total]`).value = parseFloat(sumaGlobal);
};

const debugFormData = (formData) => {
    for (let [clave, valor] of formData.entries()) {
        console.log(`${clave}: ${valor}`);
    }
}

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

/* animation for button whatsapp */

window.addEventListener("load", () => {
    $(".notificacion-whatsapp").animsition({
        inClass: 'fade-in',
        outClass: 'fade-out',
        inDuration: 1000,
        outDuration: 1000,
        onLoadEvent: false,
        overlay: false
    });

    $(".message-whatsapp").animsition({
        inClass: 'fade-in',
        outClass: 'fade-out',
        inDuration: 1000,
        outDuration: 1000,
        onLoadEvent: false,
        overlay: false
    });

    setTimeout(() => {
        $(".notificacion-whatsapp").css("display", "block").animsition('in');

        setTimeout(() => {
            $(".notificacion-whatsapp").css("display", "none");
            $(".message-whatsapp").css("display", "block").animsition('in');

            setTimeout(() => {
                $(".message-whatsapp").css("display", "none");
                $(".notificacion-whatsapp").css("display", "block").animsition('in');

                // 🟩 Mostrar caja de agentes después de 1 segundo
                setTimeout(() => {
                    const agentesBox = document.querySelector('.box-whatsapp-agentes');
                    agentesBox.classList.add('show');
                    agentesBox.classList.remove('hidden_box');

                    // 🟥 Ocultar la caja después de 5 segundos
                    setTimeout(() => {
                        agentesBox.classList.remove('show');
                        agentesBox.classList.add('hidden_box');
                    }, 5000);

                }, 1000);

            }, 5000);

        }, 3000);
    }, 3000);
});


/* click para el cuadro de whatsapp */

const btnWhatsapp = document.getElementById('btnWhatsappNumbers');
const agentesBox = document.querySelector('.box-whatsapp-agentes');

// Manejo manual del toggle al hacer clic en el botón
btnWhatsapp.addEventListener('click', () => {
    if (agentesBox.classList.contains('show')) {
        agentesBox.classList.remove('show');
        agentesBox.classList.add('hidden_box');
    } else {
        agentesBox.classList.remove('hidden_box');
        agentesBox.classList.add('show');
    }
});

/* dropdown */
const dropdown = document.querySelector('.custom-dropdown') || null;
const input = dropdown.querySelector('.custom-dropdown__input') || null;
const options = dropdown.querySelectorAll('.custom-dropdown__item') || null;

input.addEventListener('click', (e) => {
    e.stopPropagation();
    dropdown.classList.toggle('open');
});

options.forEach(option => {
    option.addEventListener('click', (e) => {
        e.stopPropagation();
        input.value = option.textContent;
        input.dataset.value = option.dataset.value;
        input.dispatchEvent(new Event('input'));
        dropdown.classList.remove('open');
    });
});

// Cerrar al hacer clic fuera
document.addEventListener('click', () => {
    dropdown.classList.remove('open');
});


//nav footer 
let lastScrollTop = 0;
const navBottom = document.getElementById("mobileBottomNav");
console.log('(luismi): navBottom :>> ', navBottom);
window.addEventListener("scroll", () => {
    console.log('(luismi):>> scroll');
    const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

    if (currentScroll > lastScrollTop) {
        navBottom.classList.add("hide");
    } else {
        navBottom.classList.remove("hide");
    }

    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
});

/* navbar */
function toggleMenuCustom() {
    const dropdown = document.getElementById('navbar-dropdown');
    dropdown.classList.toggle('show');
}



