window.addEventListener("load", () => {
    dataTableComplaints = $("#tableComplaints").DataTable({
        info: false,
        language: languageDataTable
    });
});

document.addEventListener("submit", async (e) => {
    if (e.target.matches("#formActComplaint")) {
        e.preventDefault();

        if (!FormValidate("formActComplaint")) {
            toastAlert("Algunos campos son necesarios", "warning")
            return;
        }

        const formData = new FormData(e.target);
        formData.append('_method', 'PUT');

        try {
            let response = await customFetch(ROUTES.COMPLAINTS_BOOK  + `/${e.target.id.value}`, "POST", formData)

            if (response.status === "success") {
                boxAlert("Actualizado y enviado con exito!", "success")
                location.reload();
            } else {
                boxAlertValidation(response.errors)
            }
        } catch (error) {
            console.error('Error de red:', error);
        }
    }
});

const setIdComplaint = async (idComplaint) => {
    document.getElementById("idComplaint").value = idComplaint;
}

const generatePDF = async (idMovimiento) => {
    try {
        let response = await customFetch(
            ROUTES.PDF + "/complaint/" + idMovimiento,
            "GET",
            null,
            "buffer"
        )
        openModal("modalPDFGlobal");
        arrayBufferToPDF("contentModalPDFGlobal", response);

    } catch (error) {
        console.error('Error de red:', error);
    }
}