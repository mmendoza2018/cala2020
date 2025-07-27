var backDropOverlay = document.getElementById("backDropDiv");
let baseCodeCompany = document.querySelector(`[data-code_company]`).dataset.code_company;
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

const initializeSelect2 = () => {
    const $elements = $('[data-custom_select2]');
    if ($elements.length !== 0) {
        $elements.select2({
            placeholder: 'Selecciona una opción',
            allowClear: true
        });
    }
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
    //initializeSelect2();
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
const dropdown = document.querySelector('.custom-dropdown');
const input = dropdown ? dropdown.querySelector('.custom-dropdown__input') : null;
const options = dropdown ? dropdown.querySelectorAll('.custom-dropdown__item') : null;
if (input) {

    input.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdown.classList.toggle('open');
    });
}
if (options) {
    options.forEach(option => {
        option.addEventListener('click', (e) => {
            e.stopPropagation();
            input.value = option.textContent;
            input.dataset.value = option.dataset.value;
            input.dispatchEvent(new Event('input'));
            dropdown.classList.remove('open');
        });
    });
}

// Cerrar al hacer clic fuera
document.addEventListener('click', () => {
    dropdown?.classList?.remove('open');
});


//nav footer 
let lastScrollTop = 0;
const navBottom = document.getElementById("mobileBottomNav");
window.addEventListener("scroll", () => {
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

/* search product */

let inputSearchProduct = document.querySelector(".custom-form-search-products");

inputSearchProduct.addEventListener("focus", function () {
    let container = document.getElementById("containerSearchProducts");
    container.style.display = "block"; // Azul claro
});

inputSearchProduct.addEventListener("blur", function () {
    setTimeout(() => {
        let container = document.getElementById("containerSearchProducts");
        container.style.display = "none"; // Restablecer
    }, 500);
});

/* let inputSearchProductMovile = document.querySelector("#customFormSearchProductsMobile");

inputSearchProductMovile.addEventListener("focus", function () {
    let container = document.getElementById("containerSearchProductsMobile");
    container.style.display = "block"; // Azul claro
});

inputSearchProductMovile.addEventListener("blur", function () {
    setTimeout(() => {
        let container = document.getElementById("containerSearchProductsMobile");
        container.style.display = "none"; // Restablecer
    }, 500);
});
 */

const searchProducts = async (element = null, containerProducts) => {

    try {
        let query = '';
        if (element) {
            query = element.value;
        }

        let response = await customFetch(
            ROUTES.SEARCH_PRODUCTS + `?query=${query}`
        )/* aqui */
        if (response.status === "success") {
            let baseUrl = document.querySelector(`[data-base_url]`).dataset.base_url;
            let container = document.getElementById(containerProducts);
            console.log('response :>> ', response.data);
            // Limpiar contenido previo
            container.innerHTML = "";
            if (response.data.length <= 0) {
                let htmlSinProductos = `<div href="javascript:void(0);" class="d-flex p-2">
                                            <div class="col-12 text-center">
                                                No se econtraron productos, vuelva a intentarlo 
                                            </div>
                                        </div>`;
                container.innerHTML = htmlSinProductos;
            } else {
                response.data.forEach(product => {
                    let images = product.product_images;

                    // obtener la imagen principal
                    let imageMain = images.find(image => image.is_main === 1);
                    let firstImage = imageMain
                        ? `${baseUrl}/storage/uploads/${baseCodeCompany}/${imageMain.image_name}`
                        : "ruta_por_defecto.jpg";

                    let card = document.createElement("a");
                    card.href = `${baseUrl}/productos/${product.slug}`;
                    card.className = "flex gap-2 product";

                    card.innerHTML = `
                        <div class="flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 shrink-0 dark:bg-zink-500">
                            <img src="${firstImage}" alt="" class="h-8">
                        </div>
                        <div class="overflow-hidden grow">
                            <a href="${baseUrl}/productos/${product.slug}" class="transition-all duration-200 ease-linear hover:text-custom-500">
                                <h6 class="mb-1 text-15">${product.title}</h6>
                            </a>
                            <div class="flex items-end mb-2">
                                <h5 class="text-base product-price" style="margin-top: 0">S/<span>${product.product_attributes[0]?.default_price ?? "0.00"}</span></h5>
                                ${product?.product_brand
                                                ? `<div class="font-normal rtl:mr-1 ltr:ml-1 text-slate-500 dark:text-zink-200">
                                            (${product.product_brand.description})
                                        </div>`
                                                : ''
                                            }
                            </div>
                        </div>
                    `;

                    container.appendChild(card);
                });

            }
        }
    } catch (error) {
        console.error('error :>> ', error);
    }

}

function getDivFromTheElement(element) {
    let temp = element.parentNode.querySelector('input.product-quantity');

    if (!temp) {
        const upperParent = element.parentNode;
        return getDivFromTheElement(upperParent);
    }
    return temp;
}

document.body.addEventListener('click', function (event) {
    // Si se clickea un botón + o -, encontramos el contenedor más cercano
    const clickedButton = event.target.closest('.plusBtn, .minusBtn');
    if (!clickedButton) return;

    const container = clickedButton.closest('.containerMinusPlus');
    console.log('(luismi): container :>> ', container);
    if (!container) return;

    const input = container.querySelector('input[type="number"]');
    console.log('(luismi): input :>> ', input);
    if (!input) return;

    let value = parseInt(input.value, 10) || 0;
    const min = parseInt(input.min, 10) || 0;
    const max = parseInt(input.max, 10) || 9999;

    if (clickedButton.classList.contains('plusBtn') && value < max) {
        input.value = value + 1;
    }

    if (clickedButton.classList.contains('minusBtn') && value > min) {
        input.value = value - 1;
    }
});
