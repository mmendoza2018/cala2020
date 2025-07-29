<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        {{ file_get_contents(resource_path('views/admin/pdfs/styles.css')) }}
    </style>
</head>

<body>
    <div class="mb-1">
        <img src="{{ public_path('storage/uploads/' . $generalInfo->code . '/' . $generalInfo->logo) }}" alt="" style="width: 100px; margin-bottom: 5px">
        <div class="mb-3">
            <p class="m-0 p-0">
                <span class="fw-bold">N° de reclamo:</span>
                <span class="m-0">{{ $complaintsBook->id }}</span>
            </p>
            <p class="m-0">
                <span class="fw-bold">RUC:</span>
                <span class="m-0">{{ $generalInfo->ruc }}</span>
            </p>
            <p class="m-0">
                <span class="fw-bold">Razon social: </span>
                <span class="m-0">{{ $generalInfo->business_name }}</span>
            </p>
            <p class="m-0">
                <span class="fw-bold">Dirección comercial:</span>
                <span class="m-0">{{ $generalInfo->address }}</span>
            </p>
            <p class="m-0">
                <span class="fw-bold">Fecha de emisión del reclamo:</span>
                <span class="m-0">{{ $complaintsBook->created_at }}</span>
            </p>
        </div>
    </div>
    <div class="text-center p-0 m-0 border-radius-1">
        <h2 class="p-0 m-1">HOJA DE RECLAMACIÓN </h2>
    </div>

    <div>
        <h3>Datos del consumidor reclamante</h3>
    </div>

    <table class="w-100 table border-table-complaint border-collapsse">
        <tr>
            <td class="w-33 p-2">
                <span class="me-2 fw-bold">Nombres:</span>
                <span>{{ $complaintsBook->first_name }}</span>
            </td>
            <td class="w-33 p-2">
                <span class="me-2 fw-bold">Apellido materno:</span>
                <span>{{ $complaintsBook->last_name }}</span>
            </td>
            <td class="w-33 p-2">
                <span class="me-2 fw-bold">Apellido paterno:</span>
                <span>{{ $complaintsBook->second_last_name }} </span>
            </td>
        </tr>
        <tr>
            <td class="w-33 p-2">
                <span class="me-2 fw-bold">Tipo de documento:</span>
                <span>{{ $complaintsBook->document_type }}</span>
            </td>
            <td class="w-33 p-2">
                <span class="me-2 fw-bold">Número de documento:</span>
                <span>{{ $complaintsBook->document_number }}</span>
            </td>
            <td class="w-33 p-2">
                <span class="me-2 fw-bold">Celular:</span>
                <span>{{ $complaintsBook->phone_number }}</span>
            </td>
        </tr>
        <tr>
            <td class="w-33 p-2">
                <span class="me-2 fw-bold">Departamento:</span>
                <span>{{ $complaintsBook->state }}</span>
            </td>
            <td class="w-33 p-2">
                <span class="me-2 fw-bold">Provincia:</span>
                <span>{{ $complaintsBook->province }}</span>
            </td>
            <td class="w-33 p-2">
                <span class="me-2 fw-bold">Distrito:</span>
                <span>{{ $complaintsBook->district }}</span>
            </td>
        </tr>
        <tr>
            <td class="w-33 p-2">
                <span class="me-2 fw-bold">Dirección:</span>
                <span>{{ $complaintsBook->address }}</span>
            </td>
            <td class="w-33 p-2">
                <span class="me-2 fw-bold">Correo:</span>
                <span>{{ $complaintsBook->email }}</span>
            </td>
        </tr>
    </table>
    <table class="table w-100 mt-3">
        <tr>
            <td class="w-33 p-2 bg-gray-complaint ">
                <span class="me-2">¿Es menor de edad? </span>
                <span>
                    {!! $complaintsBook->is_minor == 1 ? 'Si' : 'No' !!}
                </span>
            </td>
            <td class="w-33"></td>
            <td class="w-33"></td>
        </tr>
    </table>

    <div>
        <h3>Datos del apoderado (solo menor de edad)</h3>
    </div>

    <table class="w-100 table border-table-complaint border-collapsse">
        <tr>
            <td class="w-33 p-2">
                <span class="me-2 fw-bold">Nombres:</span>
                <span>{{ $complaintsBook->guardian_first_name }}</span>
            </td>
            <td class="w-33 p-2">
                <span class="me-2 fw-bold">Primer apellido:</span>
                <span>{{ $complaintsBook->guardian_last_name }}</span>
            </td>
            <td class="w-33 p-2">
                <span class="me-2 fw-bold">Segundo apellido:</span>
                <span>{{ $complaintsBook->guardian_second_last_name }}</span>
            </td>
        </tr>
        <tr>
            <td class="w-33 p-2">
                <span class="me-2 fw-bold">Tipo de documento:</span>
                <span>{{ $complaintsBook->guardian_document_type }}</span>
            </td>
            <td class="w-33 p-2">
                <span class="me-2 fw-bold">Número de documento:</span>
                <span>{{ $complaintsBook->guardian_document_number }}</span>
            </td>
            <td class="w-33 p-2">
                <span class="me-2 fw-bold">Celular:</span>
                <span>{{ $complaintsBook->guardian_phone_number }}</span>
            </td>
        </tr>
    </table>

    <div>
        <h3>Detalle del reclamo</h3>
    </div>

    <table class="w-100 table border-table-complaint">
        <tr>
            <td class="w-33 p-2">
                <span class="me-2 fw-bold">Tipo de reclamo:</span>
                <span>{{ $complaintsBook->claim_type }}</span>
            </td>
            <td class="w-33 p-2">
                <span class="me-2 fw-bold">Número de comprobante:</span>
                <span>{{ $complaintsBook->receipt_number }}</span>
            </td>
            <td class="w-33 p-2">
                <span class="me-2 fw-bold">Fecha de compra:</span>
                <span>{{ $complaintsBook->purchase_date }}</span>
            </td>
        </tr>
        <tr>
            <td class="w-33 p-2">
                <span class="me-2 fw-bold">Fecha de respuesta:</span>
                <span>{{ $complaintsBook->response_date }}</span>
            </td>
        </tr>
    </table>
    <table class="w-100 table border-table-complaint mt-3">
        <tr>
            <td class="w-33 p-2 bg-gray-complaint border-none">
                <span class="me-2 fw-bold">Detalle del reclamo:</span>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                {{ $complaintsBook->claim_details }}
            </td>
        </tr>
    </table>

    <table class="w-100 table border-table-complaint mt-3">
        <tr>
            <td class="w-33 p-2 bg-gray-complaint border-none">
                <span class="me-2 fw-bold">Pedido del cliente:</span>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                {{ $complaintsBook->customer_request }}
            </td>
        </tr>
    </table>

    @if ($complaintsBook->response_date)
        <table class="w-100 table border-table-complaint mt-3">
            <tr>
                <td class="w-33 p-2 bg-gray-complaint border-none">
                    <span class="me-2 fw-bold">Respuesta o solución:</span>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    {{ $complaintsBook->response }}
                </td>
            </tr>
        </table>
    @endif

    <p class="m-0 mt-3">
        * Reclamo:
        Disconformidad relacionada a los
        productos o servicios.
    </p>
    <p class="m-0">
        * Queja:
        Disconformidad no relacionada a los productos o servicios; o,
        malestar o descontento respecto a la atención al público
    </p>
    <p class="m-0">
        * La formulación del reclamo no impide acudir a otras vías de solución de controversias ni es requisito previo
        para interponer una denuncia ante el INDECOPI.

    </p>
    <p class="m-0">
        * El proveedor debe dar respuesta al reclamo o queja en un plazo no mayor a quince (15) días hábiles, el cual es
        improrrogable.
    </p>

    <div class="footer-complaint">
        Página {PAGENO} de {nbpg} <!-- mPDF reconoce estas etiquetas y reemplaza con los números de página -->
    </div>

</body>

</html>
