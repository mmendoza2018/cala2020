let dropzoneArray = [];

window.addEventListener("DOMContentLoaded", () => {

    getThemes();

})

document.addEventListener("submit", async (e) => {
    if (e.target.matches("#formThemesUpdate")) {
        e.preventDefault();

        if (!FormValidate("formThemesUpdate")) {
            toastAlert("Algunos campos son necesarios", "warning")
            return;
        }

        try {
            let formData = new FormData(e.target);
            // Añadir el array al FormData
            formData.append('_method', 'PUT');
            let url = ROUTES.THEMES + `/update`;
            let response = await customFetch(url, "POST", formData)
            if (response.status === "success") {
                boxAlert("Actualizado con exito!", "success")
            } else {
                boxAlertValidation(response.errors)
            }
        } catch (error) {
            console.error('Error de red:', error);
        }
    }
});

document.addEventListener("change", async (e) => {
    if (e.target.matches('.color-selector.primary input[type="radio"]')) {
        let inputPrimaryColor = document.getElementById("inputPrimaryColor");
        inputPrimaryColor.value = e.target.value;
    }

    if (e.target.matches('.color-selector.secondary input[type="radio"]')) {
        let inputSecondaryColor = document.getElementById("inputSecondaryColor");
        inputSecondaryColor.value = e.target.value;
    }

});



const getThemes = async () => {
    try {
        let response = await customFetch(ROUTES.THEMES);
        if (response.status === "success") {
            console.log('response :>> ', response);
            let data = response.data;
            let inputPrimaryColor = document.getElementById("inputPrimaryColor");
            let inputSecondaryColor = document.getElementById("inputSecondaryColor");

            inputPrimaryColor.value = data.primary_color;
            inputSecondaryColor.value = data.secondary_color;
        } else {
            boxAlertValidation(response.errors)
        }
    } catch (error) {
        console.log('error :>> ', error);
    }
}