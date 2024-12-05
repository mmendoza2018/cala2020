let dataTableProductAttribute = null;

window.addEventListener("load", () => {
    dataTableProductAttribute = $("#tableProductAttribute").DataTable({
        info: false,
        columnDefs: [
            {
                targets: 2, // Índice de la columna del botón
                className: 'text-center' // Aplica clase a toda la columna (si es necesario)
            }
        ]
    });
});


document.addEventListener("submit", async (e) => {
    if (e.target.matches("#formAddProductAttribute")) {
        e.preventDefault();

        if (!FormValidate("formAddProductAttribute")) {
            toastAlert("Algunos campos son necesarios", "warning")
            return;
        }

        const formData = new FormData(e.target);

        try {
            let response = await customFetch(
                ROUTES.PRODUCT_ATTRIBUTE + `/store`, "POST", formData
            )

            if (response.status === "success") {
                boxAlert("Agregado con exito!", "success")
                closeModal("modalAddProductAttribute")
                e.target.reset();
                let data = response.data;
                let btnActHTML = `<i class="ri-edit-box-fill ri-xl cursor-pointer" onclick="getAttributeProduct('${data.id}')"></i>`;

                let rowNode = dataTableProductAttribute.row.add([
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

    if (e.target.matches("#formActProductAttribute")) {
        e.preventDefault();

        if (!FormValidate("formActProductAttribute")) {
            toastAlert("Algunos campos son necesarios", "warning")
            return;
        }

        const formData = new FormData(e.target);
        formData.append('_method', 'PUT');

        try {
            let response = await customFetch(
                ROUTES.PRODUCT_ATTRIBUTE + `/${e.target.id.value}`, "POST", formData
            )

            if (response.status === "success") {
                boxAlert("Actualizado con exito!", "success")
                closeModal("modalActProductAttribute")
                e.target.reset();
                let data = response.data;
                let trUpdatedElement = $('[data-table="' + data.id + '"]')[0];
                const trUpdated = dataTableProductAttribute.row(trUpdatedElement);
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

const getAttributeProduct = async (id) => {
    try {
        openModal("modalActProductAttribute");

        let response = await customFetch(ROUTES.PRODUCT_ATTRIBUTE + `/${id}`);
        if (response.status === "success") {
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