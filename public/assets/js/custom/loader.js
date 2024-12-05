const loader = document.getElementById("loaderGlobal");

const showLoader = () => {
    loader.classList.add("show_loader");
}
const hideLoader = () => {
    loader.classList.remove("show_loader");
}

window.addEventListener("DOMContentLoaded", () => {
    showLoader();
})

window.addEventListener("load", () => {
    hideLoader();
})
