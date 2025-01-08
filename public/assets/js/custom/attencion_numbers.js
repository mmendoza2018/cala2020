document.addEventListener("DOMContentLoaded", () => {

    //agregarTemplate("templateAttencionNumbers", "containerAttencionNumbers");

})


document.addEventListener("submit", async (e) => {
    if (e.target.matches("#formActAttentionNumbers")) {
        e.preventDefault();

        if (!FormValidate("formActAttentionNumbers")) {
            toastAlert("Algunos campos son necesarios", "warning")
            return;
        }

        const formData = new FormData(e.target);

        try {
            let rows = document.querySelectorAll("#containerAttencionNumbers tr");
            let formData = new FormData();
            let finalArray = [];

            rows.forEach(tr => {
                let obj = {
                    phone: tr.querySelector(".phone").value,
                    fullname: tr.querySelector(".fullname").value,
                    id: tr.querySelector(".id").value
                }
                finalArray.push(obj);
            });

            formData.append('attentionNumbers', JSON.stringify(finalArray));
            formData.append('_method', 'PUT');

            let url = ROUTES.ATTENTION_NUMBER + `/update`;
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

document.addEventListener("click", (e) => {
    if (e.target.matches("#btnAddAttencionNumber")) {
        agregarTemplate("templateAttencionNumbers", "containerAttencionNumbers")
    }

    if (e.target.matches(".btnRemoveAttencionNumber")) {
        eliminarTrProducto(e.target);
    }
});


const eliminarTrProducto = (elemento) => {
    let trPadre = elemento.parentNode.parentNode;
    let tBody = elemento.parentNode.parentNode.parentNode;
    let trs = tBody.querySelectorAll("tr");
    if (trs.length <= 1) return;
    trPadre.remove();
};

const agregarTemplate = (idTemplate, idContainer) => {

    let template = document.getElementById(idTemplate);
    let templateClonado = template.content.cloneNode(true);
    let contenedor = document.getElementById(idContainer);
    let trs = contenedor.querySelectorAll("tr");

    if (trs.length >= 5) return;
    contenedor.appendChild(templateClonado);

};

const getProductBrand = async (id) => {
    try {
        openModal("modalActProductBrand");

        let response = await customFetch(ROUTES.PRODUCT_BRAND + `/${id}`);
        if (response.status === "success") {
            console.log('response :>> ', response);
            let data = response.data;
            document.getElementById("id").value = data.id;
            document.getElementById("description").value = data.description;
            document.getElementById("status").value = data.status;
        } else {
            boxAlertValidation(response.errors)
        }
    } catch (error) {
        console.log('error :>> ', error);
    }
}