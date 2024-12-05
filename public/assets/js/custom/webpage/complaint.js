document.addEventListener("submit", async (e) => {
    if (e.target.matches("#formComplaint")) {
        e.preventDefault();

        if (!FormValidate("formComplaint")) {
            toastAlert("Algunos campos son necesarios", "warning")
            return;
        }

        const formData = new FormData(e.target);

        try {
            let response = await customFetch(`/libro-store`, "POST", formData)

            if (response.status === "success") {
                boxAlertWidthConfirmation("Registro exitoso", "Hemos enviado un correo electrónico con el documento PDF de tu reclamo. Te invitamos a revisar tu bandeja de entrada o la carpeta de spam y seguir las instrucciones proporcionadas.", "warning", false)
                e.target.reset();
            } else {
                boxAlertValidation(response.errors)
            }
        } catch (error) {
            console.error('Error de red:', error);
        }
    }
});

const changeByMinorInput = () => {
    const selectedValue = document.querySelector('input[name="is_minor"]:checked').value;
    let container = document.getElementById("containerApoderado");
    container.innerHTML = "";
    if (selectedValue == 1) {
        let templateApoderado = document.getElementById('templateApoderado');
        const clone = templateApoderado.content.cloneNode(true);
        container.appendChild(clone);
    }
}