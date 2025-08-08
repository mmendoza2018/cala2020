
document.addEventListener("click", async (e) => {
    if (e.target.matches(".btnLegalities")) {
        e.preventDefault();

        let editorElement = document.querySelector(".ck-editor__editable");
        let contenido = editorElement.innerHTML;
        let typeLegality = document.querySelector("[data-type_legality]");
        console.log(contenido);
        try {
            let formData = new FormData();
            formData.append("type", typeLegality.dataset.type_legality)
            formData.append("description", contenido)

            let url = ``;
            if (typeLegality.dataset.type_legality === "POLITICAS_DE_REEMBOLSO") {
                url = ROUTES.REFUND_POLICIES + `/store`;
            } else {
                url = ROUTES.TERMS_CONDITIONS + `/store`;
            }

            let response = await customFetch(url, "POST", formData)
            if (response.status === "success") {
                boxAlert("Actualizado con exito!", "success")
                location.reload();
            } else {
                boxAlertValidation(response.errors)
            }
        } catch (error) {
            console.error('Error de red:', error);
        }
    }
});