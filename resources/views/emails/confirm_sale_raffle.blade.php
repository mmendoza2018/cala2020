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

        .order-details {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .order-details th,
        .order-details td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .order-details th {
            background-color: #f4f4f4;
        }

        .total {
            font-weight: bold;
            text-align: right;
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
            <h2>¡Gracias por completar tu pedido!</h2>
            <span class="message">Hemos recibido tu pago con éxito. Te recomendamos estar atento a la fecha del sorteo y a otros detalles importantes.</span>
            <p>Código de la orden #: {{ $ecommerceSale->code }}</p>
        </div>

        <table class="order-details">
            <thead>
                <tr>
                    <th>Ticket</th>
                    <th>Codigo</th>
                    <th>Precio unitario</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ecommerceSaleDetails as $detail)
                    <tr>
                        <td>{{ $detail->product_name }}</td>
                        <td>{{ $detail->code }}</td>
                        <td>S/{{ $detail->price }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>S/{{ $detail->subtotal }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="total">Total</td>
                    <td>S/{{ number_format($ecommerceSale->total, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p>Si tiene alguna pregunta sobre su pedido, comuníquese con nosotros a administrador@ruletabiker.com</p>
        </div>
    </div>
</body>

</html>
