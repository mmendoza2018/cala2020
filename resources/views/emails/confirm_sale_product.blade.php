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
            max-width: 700px;
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
        .ticket {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            margin: 5px;
            background-color: #f8f8f8;
            font-size: 14px;
            width: 92px;    
        }
        .ticket-table {
            width: 100%;
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
            <span class="message">Nos pondremos en contacto pronto para ver los detalles del envío, como ubicación y
                demás.</span>
            <p>Código de la orden #: {{ $ecommerceSale->code }}</p>
        </div>

        <table class="order-details">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Detalle</th>
                    <th>Precio unitario</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ecommerceSaleDetails as $detail)
                    <tr>
                        <td>{{ $detail->product_name }}</td>
                        <td>
                            @foreach ($detail->productAttribute->attributesCombination as $combination)
                                {{ $combination->attribute->attributeGroup->description }}:
                                {{ $combination->attribute->description }}<br>
                            @endforeach
                        </td>
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
        @if ($ticketsSaleDetails)
            <div>
                <div class="order-info">
                    <h2>¡Gracias a tu compra obtuviste estos tickets de regalo!</h2>
                    <p>Estos son los tickets que has obtenido. ¡Mantente atento a nuestras redes sociales para conocer las
                        fechas y horarios del sorteo! </p>
                </div>
                <table class="ticket-table" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <table cellpadding="0" cellspacing="0">
                                @php
                                    $counter = 0;
                                @endphp
        
                                <tr>
                                    @foreach ($ticketsSaleDetails as $ticket)
                                        <td class="ticket">{{ $ticket->ticket_code }}</td>
                                        @php $counter++; @endphp
        
                                        @if ($counter % 5 == 0)
                                </tr>
                                <tr>
                                    @endif
                                    @endforeach
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        @endif

        <div class="footer">
            <p>Si tiene alguna pregunta sobre su pedido, comuníquese con nosotros a administrador@ruletabiker.com</p>
        </div>
    </div>
</body>

</html>
