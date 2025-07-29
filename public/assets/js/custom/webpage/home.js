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

/* custom */
console.log('(luismi):>> entreeeeeee');
var splide = new Splide('#splidePrincipalBanner', {
    type: 'loop',        // Este activa el bucle infinito
    autoplay: true,         // Reproducción automática
    interval: 5000,         // Tiempo entre slides (en ms)
    pauseOnHover: false,      // No se detiene al pasar el mouse
    pauseOnFocus: false,      // No se detiene si el carrusel gana el foco
    speed: 800,          // Velocidad de transición (ms)
    arrows: true,        // Oculta flechas si no las necesitas
    pagination: false
});
splide.mount();

/* drag categories */




new Splide('#splideCategories', {
  type: 'loop',
  drag: 'free',
  perPage: 3,        // valor por defecto para pantallas grandes
  focus: 0,          // quitar centrado fuera de breakpoints
  gap: '1rem',
  breakpoints: {
    1024: {
      perPage: 2,
      focus: 'center',  // centrado solo en tablets
    },
    768: {
      perPage: 2,
      focus: 'center',  // centrado solo en móviles
    },
    512: {
      perPage: 1,
      focus: 'center',  // centrado solo en móviles
    },
  }
}).mount();

/* tabs */

const tabButtonsContainer = document.querySelector('.custom-tabs__buttons');
const leftArrow = document.querySelector('.custom-tabs__arrow.left');
const rightArrow = document.querySelector('.custom-tabs__arrow.right');

leftArrow.addEventListener('click', () => {
    tabButtonsContainer.scrollBy({ left: -150, behavior: 'smooth' });
});

rightArrow.addEventListener('click', () => {
    tabButtonsContainer.scrollBy({ left: 150, behavior: 'smooth' });
});

// El resto del JS de tabs sigue igual 👇
const tabButtons = document.querySelectorAll('.custom-tabs__btn');
const tabContents = document.querySelectorAll('.custom-tabs__content');

tabButtons.forEach(button => {
    button.addEventListener('click', () => {
        tabButtons.forEach(btn => btn.classList.remove('active'));
        tabContents.forEach(content => content.classList.remove('active'));

        button.classList.add('active');
        document.getElementById(button.dataset.tab).classList.add('active');
    });
});


new Splide('#splideOffers', {
    type: 'loop',
    perPage: 3,
    gap: '1rem', // Espacio entre slides
    breakpoints: {
        768: {
            perPage: 1,
        },
    },
}).mount();



new Splide('#splideBrands', {
    type: 'loop',
    perPage: 5,
    autoplay: true,
    interval: 1000,
    gap: '2rem', // Espacio entre slides
    breakpoints: {
        768: {
            perPage: 1,
        },
    },
}).mount();


/* nav */

const nav = document.querySelector('#navbar');
let lastScroll = 0;

function handleNavVisibility() {
    const currentScroll = window.scrollY;

    if (currentScroll <= 0) {
        nav.classList.add('hidden_hover');
        nav.classList.remove('show_hover');
    } else {
        nav.classList.remove('hidden_hover');
        nav.classList.add('show_hover');
    }

    lastScroll = currentScroll;
}

// Ejecutar al cargar la página


document.addEventListener("DOMContentLoaded", () => {
    handleNavVisibility();
})

// Escuchar scroll
window.addEventListener('scroll', handleNavVisibility);

