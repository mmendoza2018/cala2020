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
    let drawDateDetail = document.querySelector("[data-draw_date_detail]");
    if (drawDateDetail) {
        initializeClock("sectionLastRaffleHome", drawDateDetail.dataset.draw_date_detail);
    }
});
