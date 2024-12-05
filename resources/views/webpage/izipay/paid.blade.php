<html>

<head>
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
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <style>
        body {
            text-align: center;
            padding: 40px 0;
            background: #EBF0F5;
        }

        h1 {
            color: #004AAD;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-weight: 900;
            font-size: 40px;
            margin-bottom: 10px;
        }

        p {
            color: #404F5E;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-size: 20px;
            margin: 0;
        }

        i {
            color: #004badbd;
            font-size: 100px;
            line-height: 200px;
            margin-left: -15px;
        }

        .card {
            background: white;
            padding: 60px;
            border-radius: 4px;
            box-shadow: 0 2px 3px #C8D0D8;
            display: inline-block;
            margin: 0 auto;
        }

        .button-paid {
            background-color: #222;
            border-radius: 4px;
            border-style: none;
            box-sizing: border-box;
            color: #fff;
            cursor: pointer;
            display: inline-block;
            font-family: "Farfetch Basis", "Helvetica Neue", Arial, sans-serif;
            font-size: 16px;
            font-weight: 700;
            line-height: 1.5;
            margin: 0;
            max-width: none;
            min-height: 44px;
            min-width: 10px;
            outline: none;
            overflow: hidden;
            padding: 9px 20px 8px;
            position: relative;
            text-align: center;
            text-transform: none;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            width: 100%;
            text-decoration: none;
            border-radius: 50px;
        }
    </style>
</head>

<body>
   {{--  <div class="container">
        <h1>Transaction paid !</h1>
        <h3>Raw POST data received:</h3>
        <pre><code class="json">{{ $dataPost }}</code></pre>

        <h3>Parsed POST["kr-answer"] data:</h3>
        <pre><code class="json">{{ $formAnswer }}</code></pre>
    </div> --}}
    <div class="card">
        <div style="border-radius:200px; height:200px; width:200px; background: #0159fc10; margin:0 auto;">
            <i class="checkmark">✓</i>
        </div>
        <h1>Hemos procesado tu compra</h1>
        <p>¡Nos pondremos en contacto contigo en breve!</p>
        <h1><a href="{{ route('webpage.store') }}" class="button-paid">Volver a la tienda</a></h1>
    </div>
</body>

</html>
