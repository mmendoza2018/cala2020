let dataTableTickets = null;
let choicesInstances = [];

window.addEventListener("load", () => {
    if (document.getElementById("tableTickets") !== null) {
        dataTableTickets = $("#tableTickets").DataTable({
            info: false,
        });
    }
    initializeChoices();
});


document.addEventListener("submit", async (e) => {

    if (e.target.matches("#formAddTickets")) {
        e.preventDefault();

        if (!FormValidate("formAddTickets")) {
            toastAlert("Algunos campos son necesarios", "warning")
            return;
        }

        const formData = new FormData(e.target);

        try {
            let response = await customFetch(ROUTES.TICKET_SALE + `/store`, "POST", formData)

            if (response.status === "success") {
                boxAlert("Agregado con exito!", "success")
                location.reload();
            } else {
                boxAlertValidation(response.errors)
            }
        } catch (error) {
            console.error('Error de red:', error);
        }
    }

    if (e.target.matches("#formActTickets")) {
        e.preventDefault();

        if (!FormValidate("formActTickets")) {
            toastAlert("Algunos campos son necesarios", "warning")
            return;
        }

        const formData = new FormData(e.target);
        formData.append('_method', 'PUT');

        try {
            console.log('e.target.id.value :>> ', e.target.id.value);
            let response = await customFetch(
                ROUTES.TICKET_SALE + `/${e.target.id.value}`,
                "POST",
                formData
            )

            if (response.status === "success") {
                boxAlert("Actualizado con exito!", "success")
                closeModal("modalActTicketSale")
                e.target.reset();
                let data = response.data;
                let trUpdatedElement = $('[data-table="' + data.id + '"]')[0];
                const trUpdated = dataTableTickets.row(trUpdatedElement);
                let btnUpdate = trUpdatedElement.querySelector("#btnUpdate").outerHTML;
                let btnDetail = trUpdatedElement.querySelector("#btnDetail").outerHTML;
                let btnSendEmail = trUpdatedElement.querySelector("#btnSendEmail").outerHTML;
                let btns = "";

                if (data.status == 0) {
                    btns = btnDetail;
                } else {
                    btns = btnUpdate + btnSendEmail + btnDetail;
                }
                //if (data.status == 0) return trUpdated.remove().draw(false);
                let badgeStatus = (data.status == 0) ? showBadgeStatus().danger : showBadgeStatus().success;

                trUpdated
                    .data([data.id, data.full_name, data.email, data.dni, data.raffle.title, data.raffle.ticket_price, data.quantity, badgeStatus, formatDate(data.created_at), btns])
                    .draw(false);
            } else {
                boxAlertValidation(response.errors)
            }
        } catch (error) {
            console.error('Error de red:', error);
        }
    }

});


const sendEmailForwarding = async (element) => {
    try {
        event.preventDefault();

        if (!FormValidate("formSendEmail")) {
            toastAlert("Algunos campos son necesarios", "warning")
            return;
        }

        let formData = new FormData(element);
        let response = await customFetch(ROUTES.TICKET_SALE + `/send-email`, "POST", formData);
        if (response.status === "success") {
            console.log('response :>> ', response);
            boxAlert("Enviado con exito!", "success")
        } else {
            boxAlertValidation(response.errors)
        }
    } catch (error) {
        console.log('error :>> ', error);
    }
}


const showBadgeStatus = () => {
    return {
        success: `<span class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent">
                        Activo
                    </span>`,

        danger: `<span class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent">Inactivo</span>`
    }
}

const getTicketSaleDetails = async (idTicketSale) => {
    try {
        openModal("modalDetailTicketSale");
        let response = await customFetch(ROUTES.TICKET_SALE + `/${idTicketSale}`);
        if (response.status === "success") {
            let data = response.data;
            // Recorrer el array y crear filas dinámicamente
            const tableBody = document.getElementById('containerTickets');
            tableBody.innerHTML = "";
            if ($.fn.DataTable.isDataTable("#tableTicketsDetails")) {
                $('#tableTicketsDetails').DataTable().clear().destroy();
            }

            data.tickets.forEach(ticket => {
                // Agregar una fila (tr) en la tabla
                tableBody.innerHTML += `
                    <tr>
                        <td>${ticket.ticket_code}</td>
                        <td>${ticket.raffle.title}</td>
                        <td>${ticket.ticket_price}</td>
                        <td>${formatDate(ticket.created_at)}</td>
                    </tr>
                `;
            });


            dataTableTickets = $("#tableTicketsDetails").DataTable({
                info: false,
            });

        } else {
            boxAlertValidation(response.errors)
        }
    } catch (error) {
        console.log('error :>> ', error);
    }
}


const getTicketSale = async (idTicketSale) => {
    try {
        openModal("modalActTicketSale");
        let response = await customFetch(ROUTES.TICKET_SALE + `/${idTicketSale}`);
        if (response.status === "success") {
            let data = response.data;

            document.getElementById("full_name").value = data.full_name;
            document.getElementById("dni").value = data.dni;
            document.getElementById("email").value = data.email;
            document.getElementById("status").value = data.status;
            document.getElementById("id").value = data.id;

        } else {
            boxAlertValidation(response.errors)
        }
    } catch (error) {
        console.log('error :>> ', error);
    }
}

const getRaffle = async (element) => {
    try {
        let response = await customFetch(ROUTES.RAFFLES + `/${element.value}`);
        if (response.status === "success") {
            let data = response.data;
            document.getElementById("ticket_price").value = data.ticket_price;

        } else {
            boxAlertValidation(response.errors)
        }
    } catch (error) {
        console.log('error :>> ', error);
    }
}

const getRaffleToSendEmail = async (idTicketSale) => {
    try {
        openModal("modalSendEmail");
        let response = await customFetch(ROUTES.TICKET_SALE + `/${idTicketSale}`);
        if (response.status === "success") {
            let data = response.data;

            document.getElementById("customer").value = data.user.names + " " + data.user.surnames;
            document.getElementById("dni").value = data.user.dni;
            document.getElementById("email").value = data.user.email;
            document.getElementById("quantity").value = data.quantity;
            document.getElementById("total").value = data.total;
            document.getElementById("idTicketSale").value = data.id;
            
        } else {
            boxAlertValidation(response.errors)
        }
    } catch (error) {
        console.log('error :>> ', error);
    }
}