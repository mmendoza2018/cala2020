document.addEventListener("DOMContentLoaded", () => {

    if (document.getElementById("tableProducts")) {

        $('#tableProducts').DataTable({
            "info": false,
            language: {
                "decimal": ",",
                "thousands": ".",
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros en total)",
                "search": "Buscar:",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "emptyTable": "No hay datos disponibles"
            }
        });
    }

    if (document.getElementById("tableTickets")) {

        $('#tableTickets').DataTable({
            "info": false,
            language: {
                "decimal": ",",
                "thousands": ".",
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros en total)",
                "search": "Buscar:",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "emptyTable": "No hay datos disponibles"
            }
        });
    }


})


document.addEventListener("submit", async (e) => {
    if (e.target.matches("#formRegister")) {
        e.preventDefault();
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

        if (!FormValidate("formRegister")) {
            toastAlert("Algunos campos son necesarios", "warning")
            return;
        }

        if (password !== confirmPassword) {
            toastAlert("Las contraseñas no coinciden. Por favor, inténtalo de nuevo.", "warning")
        }

        const formData = new FormData(e.target);

        try {
            let response = await customFetch(
                ROUTES.REGISTER_PAGE,
                "POST",
                formData
            )

            if (response.status === "success") {
                hideLoader();
                boxAlertWidthConfirmation("Registro exitoso", "Te hemos enviado un correo para que puedas verificar tu dirección de email. Por favor, revisa tu bandeja de entrada o spam y sigue las instrucciones.", "warning", false)
                setTimeout(() => {
                    location.reload();
                }, 10000);
            } else {
                boxAlertValidation(response.errors)
            }
        } catch (error) {
            console.error('Error de red:', error);
        }
    }

    if (e.target.matches("#formLogin")) {
        e.preventDefault();

        if (!FormValidate("formLogin")) {
            toastAlert("Algunos campos son necesarios", "warning")
            return;
        }

        const formData = new FormData(e.target);

        try {
            let response = await customFetch(
                ROUTES.LOGIN_PAGE,
                "POST",
                formData
            )

            if (response.status === "success") {
                toastAlert("Inicio de sesion exitoso", "success");
                setTimeout(() => {
                    location.href = "/#productsSection";
                }, 1000);
            } else {
                boxAlertValidation(response.errors)
            }
        } catch (error) {
            console.error('Error de red:', error);
        }
    }

    if (e.target.matches("#formUpdateUser")) {
        e.preventDefault();

        if (!FormValidate("formUpdateUser")) {
            toastAlert("Algunos campos son necesarios", "warning")
            return;
        }

        const formData = new FormData(e.target);
        formData.append('_method', 'PUT');

        try {
            let response = await customFetch(
                ROUTES.USER_PAGE + `/${e.target.id.value}`,
                "POST",
                formData
            )

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

document.addEventListener("click", async (e) => {

    if (e.target.matches("#logoutSessionPage")) {
        try {
            let response = await customFetch(ROUTES.LOGOUT_PAGE)
            if (response.status === "success") {
                toastAlert("Sesión cerrada", "success");
                location.reload();
            } else {
                boxAlertValidation(response.errors)
            }
        } catch (error) {
            console.error('Error de red:', error);
        }
    }

    if (e.target.matches("#showDetailSale")) {
        try {
            let idSale = e.target.dataset.id_sale;
            let response = await customFetch(ROUTES.USER_PAGE + `/order_details/${idSale}`)

            if (response.status === "success") {
                console.log('response :>> ', response);
                // Obtener el tbody donde se insertarán las filas
                const containerTbody = document.getElementById('detailSaleEcommerce');
                containerTbody.innerHTML = "";
                // Recorrer el arreglo y generar las filas
                response.data.forEach((detail, index) => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                                    <td class="p-2">${index + 1}</td>
                                    <td class="p-2">${detail.product_name}</td>
                                    <td class="p-2">${detail.price}</td>
                                    <td class="p-2">${detail.quantity}</td>
                                    <td class="p-2">${detail.subtotal}</td>
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
})

const getCustomer = async (id) => {
    try {
        openModal("modalActCustomer");

        let response = await customFetch(ROUTES.CUSTOMER + `/${id}`);
        if (response.status === "success") {
            console.log('response :>> ', response);
            let data = response.data;
            document.getElementById("id").value = data.id;
            document.getElementById("dni").value = data.dni;
            document.getElementById("full_name").value = data.full_name;
            document.getElementById("email").value = data.email;
            document.getElementById("phone").value = data.phone;
            document.getElementById("address").value = data.address;
            document.getElementById("observation").value = data.observation;
            document.getElementById("status").value = 1;
        } else {
            boxAlertValidation(response.errors)
        }
    } catch (error) {
        console.log('error :>> ', error);
    }
}