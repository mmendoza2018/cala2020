@extends('layouts.webpage.master')
@section('headers')
    <link rel="stylesheet" href="{{ URL::to('assets/libs/splide/dist/css/splide.min.css') }}">
@endsection
@section('content')
    <div style="min-height: 90vh; margin-top: 100px">
        <div class="about-section pt-120 pb-100 mt-50 n0-bg overflow-hidden winbg">
            <div  class="container 2xl:max-w-[87.5rem] px-4 mx-auto">
                <h2 class="text-center mb-5">Política de cambios</h2>
                <p>
                    Los cambios de productos adquiridos a través de la plataforma de Ruleta Biker podrán solicitarse dentro
                    de los 15 días calendario siguientes a la recepción del pedido, siempre y cuando los productos se
                    encuentren en su estado original, sin uso y en su embalaje original.
                </p>
                <b>1. Proceso de Cambio</b>
                <p>
                    Para solicitar un cambio, el usuario deberá enviar un correo electrónico al servicio de atención al
                    cliente
                    de Ruleta Biker, indicando:
                </p>
                <ul style="list-style: disc; margin-left: 40px; font-size: 16px">
                    <li>Número de pedido</li>
                    <li>Motivo del cambio</li>
                    <li>Producto que se desea cambiar</li>
                </ul>
                <b>2. Costos de Envío</b>
                <p>
                    Los costos de envío relacionados con el cambio de productos serán asumidos por el usuario, a menos que
                    el
                    cambio sea necesario debido a un error de Ruleta Biker o la recepción de un producto defectuoso.
                </p>

                <b>3. Reembolsos</b>
                <p>
                    No se contemplan reembolsos en caso de cambios. El cambio se realizará por otro producto de igual o
                    mayor
                    valor. Si el producto elegido es de mayor valor, el usuario deberá abonar la diferencia.
                </p>
                <b>4. Excepciones</b>
                <p>
                    No se aceptarán cambios de productos que hayan sido usados o manipulados, así como productos
                    personalizados
                    o que no se encuentren en su estado original.
                </p>
                <b>5. Legislación Aplicable</b>
                <p>
                    Estas Políticas de Cambio se rigen por las leyes de la República del Perú.
                </p>
                <b>6. Contacto</b>
                <p>
                    Para más información sobre nuestra política de cambios, el usuario puede comunicarse a través de los
                    canales
                    de atención al cliente disponibles en la plataforma.
                </p>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ URL::to('assets/js/custom/webpage/raffles.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/products.js') }}"></script>
@endsection
