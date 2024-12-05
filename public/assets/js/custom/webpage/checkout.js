const btnCheckout = document.getElementById('btnCheckoutProducts');

btnCheckout.addEventListener('click', function (e) {

    if (!FormValidate("formDataUserCheckoutProducts")) {
        toastAlert("Algunos campos son necesarios", "warning")
        return;
    }

    Culqi.publicKey = 'pk_test_24eddafcc5104a78';

    try {
        Culqi.settings({
            title: 'RULETA BIKER',
            currency: 'PEN', // Este parámetro es requerido para realizar pagos yape
            amount: document.querySelector("[data-total_global_culqui]").dataset.total_global_culqui, // Este parámetro es requerido para realizar pagos yape
            order: 'ord_live_0CjjdWhFpEAZlxlz', // Este parámetro es requerido para realizar pagos con pagoEfectivo, billeteras y Cuotéalo
            /* xculqirsaid: 'Inserta aquí el id de tu llave pública RSA',
            rsapublickey: 'Inserta aquí tu llave pública RSA', */
        });

        Culqi.options({
            lang: "ES",
            installments: false, // Habilitar o deshabilitar el campo de cuotas
            paymentMethods: {
                tarjeta: true,
                yape: true,
                bancaMovil: false,
                agente: false,
                billetera: false,
                cuotealo: false,
            },
            style: {
                logo: "https://static.culqi.com/v2/v2/static/img/logo.png",
            }
        });
        Culqi.open();
        e.preventDefault();
    } catch (error) {
        console.log('error :>> ', error);
    }

})


const culqi = async () => {
    if (Culqi.token) { // ¡Objeto Token creado exitosamente!
        const token = Culqi.token.id;
        const email = Culqi.token.email;

        console.log('Culqi :>> ', Culqi);

        try {
            const body = JSON.stringify({ token, email });

            const options = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body,
            }

            const response = await fetch(ROUTES.USER_PAGE + `/culqui/charge`, options);

            // Verifica si la respuesta fue exitosa
            if (!response.ok) {
                throw new Error(`Error: ${response.statusText}`);
            }

            const responseData = await response.json();
            Culqi.close()
            if (responseData.success) {
                boxAlertWidthConfirmation(responseData.data.outcome.user_message, 'Nos pondremos en contacto contigo, en las proximas horas', 'success', true)
                setTimeout(() => {
                    location.href = "/#productsSection";
                }, 5000);
            } else {
                console.log('responseData :>> ', responseData);
                boxAlertWidthConfirmation('Ocurrio un error en la transacción', responseData.data.user_message, 'error', true)
            }

        } catch (error) {
            console.error('Error:', error);
        }

    } else if (Culqi.order) { // ¡Objeto Order creado exitosamente!
        const order = Culqi.order;
        console.log('Se ha creado el objeto Order: ', order);

    } else {
        // Mostramos JSON de objeto error en consola
        console.log('Error : ', Culqi.error);
    }
};