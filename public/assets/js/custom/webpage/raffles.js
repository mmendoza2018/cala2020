
/* timer para el detalle del sorteo  */

// Función para obtener el tiempo restante
function getTimeRemaining(endtime) {
    var t = Date.parse(endtime) - Date.parse(new Date());

    var seconds = Math.floor((t / 1000) % 60);
    var minutes = Math.floor((t / 1000 / 60) % 60);
    var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
    var days = Math.floor(t / (1000 * 60 * 60 * 24));

    return {
        'total': t,
        'days': days,
        'hours': hours,
        'minutes': minutes,
        'seconds': seconds
    };
}

// Inicializa el reloj y deténlo cuando llegue a cero
function initializeClock(id, endtime) {
    let clock = document.getElementById(id);
    let daysSpan = clock.querySelector('.days');
    let hoursSpan = clock.querySelector('.hours');
    let minutesSpan = clock.querySelector('.minutes');
    let secondsSpan = clock.querySelector('.seconds');

    function updateClock() {
        let t = getTimeRemaining(endtime);

        daysSpan.innerHTML = t.days;
        hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
        minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
        secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

        if (t.total <= 0) {
            clearInterval(timeinterval);
            // Puedes mostrar un mensaje si deseas que se muestre algo cuando el tiempo se acabe
        }
    }

    updateClock(); // Ejecuta la función una vez al principio para evitar el retraso
    var timeinterval = setInterval(updateClock, 1000);
}

document.addEventListener("DOMContentLoaded", () => {
    let cardsWithDrawDate = document.querySelectorAll("[data-draw_date]");
    if (cardsWithDrawDate.length > 0) {
        cardsWithDrawDate.forEach(e => {
            startCountdown(e.dataset.draw_date, e);
        });
    }

    let drawDateDetail = document.querySelector("[data-draw_date_detail]");
    if (drawDateDetail) {
        initializeClock("timerDetailRaffle", drawDateDetail.dataset.draw_date_detail);
    }

    if (document.querySelector(".splideRaffles")) {
        var main = new Splide('#main-carousel', {
            type: 'fade',
            rewind: true,
            pagination: false,
            arrows: false,
        });

        var thumbnails = new Splide('#thumbnail-carousel', {
            fixedWidth: 200,
            fixedHeight: 115,
            gap: 10,
            rewind: true,
            pagination: false,
            isNavigation: true,
            breakpoints: {
                600: {
                    fixedWidth: 100,
                    fixedHeight: 55,
                },
            },
        });

        main.sync(thumbnails);
        main.mount();
        thumbnails.mount();
    }

});

function startCountdown(endDate, element) {
    // Convert the end date to milliseconds
    const endTime = new Date(endDate).getTime();

    // Update the countdown every 1 second
    const countdownInterval = setInterval(function () {
        // Get current time
        const now = new Date().getTime();

        // Calculate the remaining time
        const timeRemaining = endTime - now;

        // Time calculations for days, hours, minutes and seconds
        const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
        const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

        let formatedRemaining = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

        // If the countdown is over, clear the interval and display a message
        if (timeRemaining < 0) {
            clearInterval(countdownInterval);
            element.innerHTML = "Expired";
        } else {
            // Update the element with the formatted remaining time
            element.innerHTML = formatedRemaining;
        }
    }, 1000);
}

const addRaffleToShoppingCart = async () => {
    try {
        let idRaffle = document.querySelector(`[data-id_raffle]`).dataset.id_raffle;
        let quantity = document.getElementById("quantityRaffle").value;

        const formData = new FormData();

        formData.append("idRaffle", idRaffle);
        formData.append("quantity", quantity);
        formData.append("type", "plus");

        let response = await customFetch(
            ROUTES.SHOPPING_CART_RAFFLES + `/addRemoveRaffle`,
            "POST",
            formData
        )
        if (response.status === "success") {
            let data = response.data;
            console.log('data :>> ', data);
            renderRaffleShoppingCartModal(data);
            $('.js-panel-cart').addClass('show-header-cart');
        } else {
            toastAlert(response.errors, "warning");
        }
    } catch (error) {
        console.error('Error de red:', error);
    }

}

const addRemoveRaffleToShoppingCart = async (element, type = "plus") => {

    try {
        let idRaffle = element.dataset.id_raffle;
        const formData = new FormData();

        formData.append("idRaffle", idRaffle);
        formData.append("quantity", 1);
        formData.append("type", type);

        let response = await customFetch(
            ROUTES.SHOPPING_CART_RAFFLES + `/addRemoveRaffle`,
            "POST",
            formData
        )
        if (response.status === "success") {
            let data = response.data;
            renderRaffleShoppingCartModal(data);
        } else {
            boxAlertValidation(response.errors);
        }
    } catch (error) {
        console.error('Error de red:', error);
    }

}

const renderRaffleShoppingCart = (data) => {
    const template = document.getElementById('templateRaffleShoppingCart');
    const container = document.querySelector('#containerRaffleShoppingCart');
    let baseUrl = document.querySelector(`[data-base_url]`).dataset.base_url;
    let total = 0;
    let subtotal = 0;

    container.innerHTML = "";

    if (Object.keys(data).length === 0) {
        container.innerHTML = `
        <tr>
            <td colspan="2">
                <div class="p-10 text-sm border text-center rounded-md text-slate-500 border-slate-200 bg-slate-50 dark:bg-zink-500/30 dark:border-zink-500 dark:text-zink-200">
                    <span class="font-bold">Aun no se añadieron Tickets a la orden</span>
                </div>
            </td>
        </tr>
        `;
    } else {
        Object.values(data).forEach(ticket => {
            // Clonamos el contenido del template
            const clone = template.content.cloneNode(true);
            let subtotalProduct = parseFloat(ticket.quantity * ticket.price).toFixed(2);

            // Asignamos los valores correspondientes
            clone.querySelector('.imgShoppinfCart').src = `${baseUrl}/storage/uploads/${ticket.image.path}`;
            clone.querySelector('.descriptionShoppinfCart').textContent = `${ticket.title}`;
            clone.querySelector('.priceShoppinfCart').textContent = `S/${ticket.price}`;
            clone.querySelector('.quantityShoppinfCart').value = ticket.quantity;
            clone.querySelector('.subtotalShoppinfCart').textContent = subtotalProduct;


            clone.querySelector('.minusBtnShoppinfCart').dataset.id_raffle = ticket.raffleId;
            clone.querySelector('.plusBtnShoppinfCart').dataset.id_raffle = ticket.raffleId;
            clone.querySelector('.removeBtnShoppinfCart').dataset.id_raffle = ticket.raffleId;

            subtotal += Number(subtotalProduct);
            total = subtotal;

            container.appendChild(clone);
        });
    }

    document.querySelector("#detailsContainerRaffleShoppingCart .numProducts").textContent = Object.values(data).length;
    document.querySelector("#detailsContainerRaffleShoppingCart .subtotal").textContent = subtotal.toFixed(2);
    document.querySelector("#detailsContainerRaffleShoppingCart .total").textContent = total.toFixed(2);

}

const renderRaffleShoppingCartModal = (data) => {
    const template = document.getElementById('templateRaffleShoppingCartModal');
    const container = document.querySelector('#containerRaffleShoppinfCartModal');
    let baseUrl = document.querySelector(`[data-base_url]`).dataset.base_url;
    let total = 0;
    let subtotal = 0;

    container.innerHTML = "";

    if (Object.keys(data).length === 0) {
        container.innerHTML = `
        <tr>
            <td colspan="2">
                <div class="p-10 text-sm border text-center rounded-md text-slate-500 border-slate-200 bg-slate-50 dark:bg-zink-500/30 dark:border-zink-500 dark:text-zink-200">
                    <span class="font-bold">Aun no se añadieron Tickets a la orden</span>
                </div>
            </td>
        </tr>
        `;
        updateNumberRafflesShoppingCart(0)
    } else {
        Object.values(data).forEach(ticket => {
            // Clonamos el contenido del template
            const clone = template.content.cloneNode(true);
            let subTotal = parseFloat(ticket.quantity * ticket.price).toFixed(2);

            // Asignamos los valores correspondientes
            clone.querySelector('.imgShoppingCartModal').src = `${baseUrl}/storage/uploads/${ticket.image.path}`;
            clone.querySelector('.descriptionShoppingCartModal').textContent = `${ticket.title}`;
            clone.querySelector('.priceShoppingCartModal').textContent = `S/${ticket.price}`;
            clone.querySelector('.quantityShoppingCartModal').value = ticket.quantity;
            clone.querySelector('.subtotalShoppingCartModal').textContent = subTotal;


            clone.querySelector('.minusBtnShoppingCartModal').dataset.id_raffle = ticket.raffleId;
            clone.querySelector('.plusBtnShoppingCartModal').dataset.id_raffle = ticket.raffleId;
            clone.querySelector('.removeBtnShoppingCartModal').dataset.id_raffle = ticket.raffleId;

            subtotal += Number(subTotal);
            total = subtotal;

            container.appendChild(clone);
        });

        updateNumberRafflesShoppingCart(Object.values(data).length)
    }

    document.querySelector("#detailsContainerRaffleShoppingCartModal .totalShoppingCartModal").textContent = total.toFixed(2);

}

const updateNumberRafflesShoppingCart = (numTickets) => {
    document.getElementById(`numRafflesShoppingCart`).innerHTML = numTickets;
}

const addRemoveRaffleCart = (element, type = "plus") => {
    if (type === "plus") {
        addRaffleShoppingCart(element)
    }
    if (type === "minus") {
        addRaffleShoppingCart(element, "minus")
    }
}

const addRaffleShoppingCart = async (element, type = "plus") => {

    try {

        let idRaffle = document.querySelector(`[data-id_raffle]`).dataset.id_raffle;
        const formData = new FormData();

        formData.append("idRaffle", idRaffle);
        formData.append("quantity", 1);
        formData.append("type", type);

        let response = await customFetch(
            ROUTES.SHOPPING_CART_RAFFLES + `/addRemoveRaffle`,
            "POST",
            formData
        )
        if (response.status === "success") {
            let data = response.data;
            renderRaffleShoppingCartModal(data);
            toastAlert("Ticket agregado", "success", "bottom-start", 1000)
            if (document.getElementById("containerShoppingCartRaffle")) {
                renderRaffleShoppingCart(data);
            }
        } else {
            boxAlertValidation(response.errors);
        }
    } catch (error) {
        console.error('Error de red:', error);
    }

}

const removeRaffleShoppingCart = async (element) => {

    try {
        let idRaffle = element.dataset.id_raffle;
        let response = await customFetch(
            ROUTES.SHOPPING_CART_RAFFLES + `/removeRaffle/${idRaffle}`,
            "DELETE"
        )
        if (response.status === "success") {
            let data = response.data;
            renderRaffleShoppingCartModal(data);
            if (document.getElementById("containerRaffleShoppingCart")) {
                renderRaffleShoppingCart(data);
            }
        } else {
            boxAlertValidation(response.errors);
        }
    } catch (error) {
        console.error('Error de red:', error);
    }
}
