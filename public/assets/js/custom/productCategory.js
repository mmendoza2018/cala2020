let dataTableCategoryProduct = null;

window.addEventListener("load", () => {
    dataTableCategoryProduct = $("#tableCategoryProduct").DataTable({
        info: false,
        columnDefs: [
            {
                targets: 3, // Índice de la columna del botón
                className: 'text-center' // Aplica clase a toda la columna (si es necesario)
            }
        ]
    });
});


document.addEventListener("submit", async (e) => {
    if (e.target.matches("#formAddproductCategory")) {
        e.preventDefault();

        if (!FormValidate("formAddproductCategory")) {
            toastAlert("Algunos campos son necesarios", "warning")
            return;
        }

        const formData = new FormData(e.target);

        try {
            let response = await customFetch(
                ROUTES.PRODUCT_CATEGORY + `/store`,
                "POST",
                formData
            )

            if (response.status === "success") {
                boxAlert("Agregado con exito!", "success")
                closeModal("modalAddCategoryProduct")
                e.target.reset();
                let data = response.data;
                let btnActHTML = `<i class="ri-edit-box-fill ri-xl cursor-pointer" onclick="getProductCategory('${data.id}')"></i>`;

                let rowNode = dataTableCategoryProduct.row.add([
                    data.id,
                    data.description,
                    data.code,
                    btnActHTML
                ]).draw(false).node(); // Obtén el nodo DOM de la fila

                let $row = $(rowNode);

                $row.attr('data-table', data.id);
            } else {
                boxAlertValidation(result.errors)
            }
        } catch (error) {
            console.error('Error de red:', error);
        }
    }

    if (e.target.matches("#formActproductCategory")) {
        e.preventDefault();

        if (!FormValidate("formActproductCategory")) {
            toastAlert("Algunos campos son necesarios", "warning")
            return;
        }

        const formData = new FormData(e.target);
        formData.append('_method', 'PUT');

        try {
            let response = await customFetch(
                ROUTES.PRODUCT_CATEGORY + `/${e.target.id.value}`,
                "POST",
                formData
            )

            if (response.status === "success") {
                boxAlert("Actualizado con exito!", "success")
                closeModal("modalActCategoryProduct")
                e.target.reset();
                let data = response.data;
                let trUpdatedElement = $('[data-table="' + data.id + '"]')[0];
                const trUpdated = dataTableCategoryProduct.row(trUpdatedElement);
                let btnAct = trUpdatedElement.querySelector("i").outerHTML;

                if (data.status == 0) return trUpdated.remove().draw(false);

                trUpdated
                    .data([data.id, data.description, data.code, btnAct])
                    .draw(false);
            } else {
                boxAlertValidation(result.errors)
            }
        } catch (error) {
            console.error('Error de red:', error);
        }
    }

});

const getProductCategory = async (id) => {
    try {
        openModal("modalActCategoryProduct");

        let response = await customFetch(ROUTES.PRODUCT_CATEGORY + `/${id}`);
        if (response.status === "success") {
            let data = response.data;
            document.getElementById("id").value = data.id;
            document.getElementById("description").value = data.description;
            document.getElementById("code").value = data.code;
            document.getElementById("status").value = data.status;
        } else {
            boxAlertValidation(result.errors)
        }
    } catch (error) {
        console.log('error :>> ', error);
    }
}


document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('updateCategoryProduct', (event) => {
        let data = event["detail"][0]["data"];

        let trUpdatedElement = $('[data-table="' + data.id + '"]')[0];
        const trUpdated = dataTableCategoryProduct.row(trUpdatedElement);
        let btnAct = trUpdatedElement.querySelector("i").outerHTML;

        if (data.status == 0) return trUpdated.remove().draw(false);

        trUpdated
            .data([data.id, data.description, data.code, btnAct])
            .draw(false);

        trUpdatedElement.querySelector("i").addEventListener('click', function () {
            Livewire.dispatch('reloadDataCategoryProduct', [data.id]);
            toggleElementState("modalActCategoryProduct", true, 0);
        });
    });


    window.addEventListener('registerCategoryProduct', (event) => {
        let data = event["detail"][0]["data"];

        boxAlert("Agregado con éxito!", "success");
        closeModal("modalAddCategoryProduct");

        let btnActHTML = `<i class="ri-edit-box-fill ri-xl cursor-pointer"
                             data-modal-target="modalAddCategoryProduct"
                             onclick="Livewire.dispatch('reloadDataCategoryProduct', [${data.id}])"></i>`;

        let rowNode = dataTableCategoryProduct.row.add([
            data.id,
            data.description,
            data.code,
            btnActHTML
        ]).draw(false).node(); // Obtén el nodo DOM de la fila

        let $row = $(rowNode);

        // Añade el atributo data-table con el ID del empleado
        $row.attr('data-table', data.id);

        document.querySelector(`[data-table="${data.id}"] i`).addEventListener('click', function () {
            Livewire.dispatch('reloadDataCategoryProduct', [data.id]);
            toggleElementState("modalActCategoryProduct", true, 0);
        });

    });
});