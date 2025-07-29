
window.addEventListener("load", () => {
    dataTableCustomer = $("#tableOrders").DataTable({
        info: false,
        language: languageDataTable
    });
});

const getOrdersDetail = async (idOrder) => {
    try {
        let response = await customFetch(ROUTES.ORDERS + `/${idOrder}`)

        if (response.status === "success") {
            console.log('response :>> ', response);
            // Obtener el tbody donde se insertarán las filas
            const containerTbody = document.getElementById('detailSaleEcommerce');
            containerTbody.innerHTML = "";
            // Recorrer el arreglo y generar las filas
            response.data.details.forEach((detail, index) => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                                <td class="px-3.5 py-2.5 border border-slate-200 dark:border-zink-500">${index + 1}</td>
                                <td class="px-3.5 py-2.5 border border-slate-200 dark:border-zink-500">${detail.product_name}</td>
                                <td class="px-3.5 py-2.5 border border-slate-200 dark:border-zink-500">${detail.price}</td>
                                <td class="px-3.5 py-2.5 border border-slate-200 dark:border-zink-500">${detail.quantity}</td>
                                <td class="px-3.5 py-2.5 border border-slate-200 dark:border-zink-500">${detail.subtotal}</td>
                                `;
                containerTbody.appendChild(tr);
            });
        } else {
            boxAlertValidation(response.errors)
        }
    } catch (error) {
        console.error('Error de red:', error);
    }
}

document.addEventListener("change", async (e) => {
    if (e.target.matches(".order-status-select")) {
        try {
            const orderId = e.target.dataset.id;
            const newStatus = e.target.value;
            
            let formData = new FormData();
            formData.append("status", newStatus);

            let response = await customFetch(ROUTES.ORDERS + `/update-status/${orderId}`, "POST", formData);
            console.log('(luismi): response :>> ', response);
            if (response.status === "success") {
                location.reload();
            } else {
                boxAlertValidation(response.errors);
            }
        } catch (error) {
            console.error('Error de red:', error);
        }
    }
});