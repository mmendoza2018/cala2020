@extends('layouts.webpage.master')
@section('headers')
    <link rel="stylesheet" href="{{ URL::to('assets/libs/splide/dist/css/splide.min.css') }}">
@endsection
@section('content')
    <div style="min-height: 90vh; margin-top: 100px">
        <div class="about-section pt-120 pb-100 mt-50 n0-bg overflow-hidden winbg">
            <div  class="container 2xl:max-w-[87.5rem] px-4 mx-auto">
                <h2 class="text-center mb-5">Términos y Condiciones</h2>
                <b>1. Aceptación de los Términos</b>
                <p>
                    El uso de la plataforma web de Ruleta Biker implica la aceptación plena de estos Términos y Condiciones.
                    Si
                    el usuario no está de acuerdo con alguna de las disposiciones, deberá abstenerse de utilizar los
                    servicios
                    ofrecidos.
                </p>
                <b>2. Registro de Usuario</b>
                <p>
                    Para acceder a ciertos servicios, es necesario que el usuario se registre en la plataforma. El usuario
                    se
                    compromete a proporcionar información veraz y actualizada durante el proceso de registro y a mantener la
                    confidencialidad de su contraseña. El usuario será responsable de todas las actividades que se realicen
                    a
                    través de su cuenta.
                </p>
                <b>3. Participación en Actividades</b>
                <p>
                    La participación en los actividades organizados por Ruleta Biker está sujeta a las condiciones específicas
                    establecidas para cada evento. La inscripción en los actividades implica la aceptación de todas las reglas y
                    decisiones de la empresa, que serán finales e inapelables.
                </p>

                <b>4. Pagos y Transacciones</b>
                <p>
                    Los pagos por productos y actividades deben realizarse a través de los métodos de pago habilitados en la
                    plataforma. Ruleta Biker no se responsabiliza por errores en las transacciones o problemas derivados de
                    la
                    plataforma de pago.
                </p>
                <b>5. Modificaciones</b>
                <p>
                    Ruleta Biker se reserva el derecho de modificar estos Términos y Condiciones en cualquier momento. Las
                    modificaciones entrarán en vigencia desde su publicación en la plataforma. Es responsabilidad del usuario
                    revisar periódicamente los Términos y Condiciones.
                </p>
                <b>6. Legislación Aplicable</b>
                <p>
                    Estos Términos y Condiciones se rigen por las leyes de la República del Perú. Cualquier controversia que
                    surja en relación con el uso de la plataforma se someterá a la jurisdicción de los tribunales peruanos.
                </p>
                <b>7. Contacto</b>
                <p>
                    Para consultas o aclaraciones sobre estos Términos y Condiciones, el usuario puede comunicarse a través de
                    los canales de atención al cliente disponibles en la plataforma.
                </p>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ URL::to('assets/js/custom/webpage/raffles.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/products.js') }}"></script>
@endsection
