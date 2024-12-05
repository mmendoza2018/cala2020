<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ==== Required Meta ==== -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruleta biker | Accesorios y actividades para Bikers con Impacto Social</title>
    <meta name="description"
        content="Ruleta Biker ofrece actividades y una variedad de accesorios para bikers, como guantes, cascos y más, destinados a apoyar causas sociales importantes como la educación, la salud y el medio ambiente. ¡Únete y ayuda a marcar la diferencia con cada participación!">
    <meta name="keywords"
        content="Ruleta Biker, actividades, bikers, ayuda social, accesorios para motos, guantes para bikers, cascos, salud, educación, medio ambiente, impacto social, comunidad biker">

    <!-- Reemplaza con la imagen principal de tu sitio -->
    <meta name="robots" content="index, follow">
    <!-- ==== #Favicon ==== -->
    <link rel="shortcut icon" href="{{ URL::to('assets/images/logo/favicon.ico') }}" type="image/x-icon">

    <!-- Meta Etiquetas de Autor y Copyright -->
    <meta name="author" content="Ruleta Biker">
    <meta name="copyright" content="© 2023 Ruleta Biker. Todos los derechos reservados.">

    <script src="{{ env('IZIPAY_CLIENT_ENDPOINT') }}/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js"
        kr-public-key="{{ env('IZIPAY_PUBLIC_KEY') }}" kr-post-url-success="paid-checkout-izipay"></script>

    <link rel="stylesheet"
        href="{{ env('IZIPAY_CLIENT_ENDPOINT') }}/static/js/krypton-client/V4.0/ext/neon-reset.min.css">
    <script type="text/javascript" src="{{ env('IZIPAY_CLIENT_ENDPOINT') }}/static/js/krypton-client/V4.0/ext/neon.js">
    </script>
    <style>
        body {
            height: 100vh;
            display: flex;
            flex-direction: column;
            place-content: center;
            place-items: center;
            background-color: #FF2D46;
        }

        .wrapper {
            background-color: #fff;
            padding: 1rem;
            border-radius: 8px;
            max-width: 310px;
        }

        .nav-bar {
            position: absolute;
            top: 10%;
        }

        h2 {
            width: 100%;
            max-width: 332px;
            color: #fff;
            border-bottom: 1px solid #f1f1f1;
            line-height: 1.5
        }

        .kr-smart-form {
            margin: auto;
        }

        .customerror {
            width: 332px
        }
    </style>

    <script type="text/javascript">
        window.onload =
            KR.onError(function(event) {
                var code = event.errorCode;
                var message = event.errorMessage;
                var myMessage = code + ": " + message;
                console.log(event);

                try {
                    /* if client answer exists, a refused transaction has been created */
                    /* it's not always the case. For example, if the form is empty,    */
                    /* error is raised before transaction creation                     */
                    var uuid = event.metadata.answer.clientAnswer.transactions[0].uuid;
                    myMessage += "\ntansaction uuid: " + uuid;
                } catch {}

                document.getElementsByClassName("customerror")[0].innerText = myMessage;
            });
    </script>

</head>

<body>
    <nav class="nav-bar">
        <a href="/">
            <img src="https://iziweb001b.s3.amazonaws.com/webresources/img/logo.png" width="150" alt=""></a>
    </nav>
    <h2 style="">Formulario de pago</h2>

    <div class="wrapper">
        <!-- payment form -->
        <div class="kr-smart-form" kr-form-token="{{ $formToken }}">
            @csrf
        </div>
        <div class="customerror"></div>
    </div>

</body>

</html>
