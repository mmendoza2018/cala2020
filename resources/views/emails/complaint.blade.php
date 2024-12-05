<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de compra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .header {
            background-color: #1a1818;
            padding: 10px;
            color: #fff;
            text-align: center;
        }

        .header h1 {
            margin: 0;
        }

        .order-info {
            padding: 20px;
            text-align: center;
        }

        .order-info h2 {
            color: #004AAD;
        }

        .message {
            color: black;
            font-weight: bold;
            font-size: 18px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #aaa;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>RULETA BIKER</h1>
        </div>

        <div class="order-info">
            <h2>{{ $titleMail }}</h2>
            <p class="">{{ $descriptionMail }}</p>
            <p class="message">Apreciamos tu paciencia y comprensión.</p>
        </div>


        <div class="footer">
            <p>Si tiene alguna pregunta sobre su pedido, comuníquese con nosotros a administrador@ruletabiker.com</p>
        </div>
    </div>
</body>

</html>
