window.addEventListener("load", () => {

    //agregarTemplate("templateAttencionNumbers", "containerAttencionNumbers");
    getSocialNetworks();

})


document.addEventListener("submit", async (e) => {
    if (e.target.matches("#formActSocialNetwork")) {
        e.preventDefault();

        if (!FormValidate("formActSocialNetwork")) {
            toastAlert("Algunos campos son necesarios", "warning")
            return;
        }

        try {
            // Seleccionar todas las filas de la tabla
            let rows = document.querySelectorAll("#containerSocialNetwork tr");
            let formData = new FormData();
            let finalArray = [];

            // Iterar sobre cada fila para extraer datos
            rows.forEach(tr => {
                let selectElement = tr.querySelector(".socialSelect");
                let selectedOption = $(selectElement).select2('data')[0];

                // Extraer datos del select y de otras columnas
                let obj = {
                    description: selectedOption.id, // Valor del select
                    icon: $(selectElement).find(`option[value="${selectedOption.id}"]`).data('icon'),
                    link: tr.querySelector(".link").value,
                    id: tr.querySelector(".id").value
                };
                finalArray.push(obj);
            });

            console.log('finalArray :>> ', finalArray);

            // Añadir el array al FormData
            formData.append('socialNetworks', JSON.stringify(finalArray));
            formData.append('_method', 'PUT');

            let url = ROUTES.SOCIAL_NETWORK + `/update`;
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
        agregarTemplate("templateSocialNetwork", "containerSocialNetwork")
    }

    if (e.target.matches(".btnRemoveSocialNetwork")) {
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

const agregarTemplate = (idTemplate, idContainer, data = null) => {

    let template = document.getElementById(idTemplate);
    let templateClonado = template.content.cloneNode(true);
    let contenedor = document.getElementById(idContainer);
    let select = templateClonado.querySelector("select");
    let trs = contenedor.querySelectorAll("tr");
    const socialSelect = templateClonado.querySelector(".socialSelect");
    const linkInput = templateClonado.querySelector(".link");
    const idInput = templateClonado.querySelector(".id");

    console.log('select :>> ', select);

    if (trs.length >= 5) return;
    contenedor.appendChild(templateClonado);


    // Inicializar Select2 después de agregar el select al DOM
    $(select).select2({
        placeholder: "Selecciona una opción",
        allowClear: true,
        templateResult: formatOption,
        templateSelection: formatSelection,
        escapeMarkup: function (markup) {
            return markup;
        }
    });

    function formatOption(option) {
        if (!option.id) {
            return option.text;
        }
        const icon = $(option.element).data('icon');
        return $('<span>').html(icon + ' ' + option.text);
    }

    function formatSelection(option) {
        if (!option.id) {
            return option.text;
        }
        const icon = $(option.element).data('icon');
        return $('<span>').html(icon + ' ' + option.text);
    }

    if (data) {
        linkInput.value = data.link;
        idInput.value = data.id;
        $(socialSelect).val(data.name).trigger('change');
    }
    

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

const getSocialNetworks = async (id) => {
    try {
        let response = await customFetch(ROUTES.SOCIAL_NETWORK);
        if (response.status === "success") {
            console.log('response :>> ', response);
            let data = response.data;

            data.forEach(element => {
                agregarTemplate("templateSocialNetwork", "containerSocialNetwork", element)
            });

        } else {
            boxAlertValidation(response.errors)
        }
    } catch (error) {
        console.log('error :>> ', error);
    }
}