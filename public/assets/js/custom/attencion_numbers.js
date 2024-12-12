document.addEventListener("DOMContentLoaded", () => {

    agregarTemplate("templateAttencionNumbers", "containerAttencionNumbers");

})


document.addEventListener("submit", async (e) => {
    if (e.target.matches("#formAddproductBrand")) {
        e.preventDefault();

        if (!FormValidate("formAddproductBrand")) {
            toastAlert("Algunos campos son necesarios", "warning")
            return;
        }

        const formData = new FormData(e.target);

        try {
            let response = await customFetch(
                ROUTES.PRODUCT_BRAND + `/store`,
                "POST",
                formData
            )

            if (response.status === "success") {
                boxAlert("Agregado con exito!", "success")
                closeModal("modalAddProductBrand")
                e.target.reset();
                let data = response.data;
                let btnActHTML = `<i class="ri-edit-box-fill ri-xl cursor-pointer" onclick="getProductBrand('${data.id}')"></i>`;

                let rowNode = dataTableBrandProduct.row.add([
                    data.id,
                    data.description,
                    btnActHTML
                ]).draw(false).node(); // Obtén el nodo DOM de la fila

                let $row = $(rowNode);

                $row.attr('data-table', data.id);
            } else {
                boxAlertValidation(response.errors)
            }
        } catch (error) {
            console.error('Error de red:', error);
        }
    }

    if (e.target.matches("#formActproductBrand")) {
        e.preventDefault();

        if (!FormValidate("formActproductBrand")) {
            toastAlert("Algunos campos son necesarios", "warning")
            return;
        }

        const formData = new FormData(e.target);
        formData.append('_method', 'PUT');

        try {
            let response = await customFetch(
                ROUTES.PRODUCT_BRAND + `/${e.target.id.value}`,
                "POST",
                formData
            )

            if (response.status === "success") {
                boxAlert("Actualizado con exito!", "success")
                closeModal("modalActProductBrand")
                e.target.reset();
                let data = response.data;
                let trUpdatedElement = $('[data-table="' + data.id + '"]')[0];
                const trUpdated = dataTableBrandProduct.row(trUpdatedElement);
                let btnAct = trUpdatedElement.querySelector("i").outerHTML;

                if (data.status == 0) return trUpdated.remove().draw(false);

                trUpdated
                    .data([data.id, data.description, btnAct])
                    .draw(false);
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

    // Clonar el contenido del template
    let templateClonado = template.content.cloneNode(true);
    let contenedor = document.getElementById(idContainer);
    let trs = contenedor.querySelectorAll("tr");
    if (trs.length >= 5) return;
    contenedor.appendChild(templateClonado);
    //$(selectTemplate).select2();
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