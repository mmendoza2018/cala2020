@extends('layouts.webpage.master')
@section('headers')
    <link rel="stylesheet" href="{{ URL::to('assets/libs/splide/dist/css/splide.min.css') }}">
@endsection
@section('content')
    <div style="min-height: 90vh; margin-top: 100px">
        <div class="about-section pt-120 pb-100 mt-50 n0-bg overflow-hidden winbg">
            <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto" style="max-width: 700px">
                <h4 class="text-center mb-5">RULETA BIKER | LIBRO DE RECLAMACIONES - LEY N°29571</h4>
                <form class="form-cmn-action" id="formComplaint">
                    <div class="form-cmn">
                        <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                            Código de Reclamo
                        </label>
                        <input type="number"
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-slate-300 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                            placeholder="936113256" name="email" data-validate readonly value="{{ $lastComplaint }}">
                    </div>
                    <div
                        class="user-profile-thumb position-relative text-center border-bottom pb-xxl-5 pb-4 mb-5 pt-xxl-5 pt-4 mt-5">
                        <div class="content">
                            <span class="fs20 fw_700 n4-clr d-block mb-1 text-16" style="font-weight: bold">
                                Datos del Cliente
                            </span>
                        </div>
                    </div>
                    <div class="form-cmn mt-2">
                        <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                            Nombres
                        </label>
                        <input type="text"
                            class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-slate-300 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                            name="first_name" data-validate>
                    </div>

                    <div class="flex flex-col md:flex-row justify-center w-full gap-5">
                        <div class="w-full md:w-2/4">
                            <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                                Apellido Paterno
                            </label>
                            <input type="text"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-slate-300 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                                name="last_name" data-validate>
                        </div>
                        <div class="w-full md:w-2/4">
                            <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                                Apellido Materno
                            </label>
                            <input type="text"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-slate-300 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                                name="second_last_name" data-validate>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row justify-center w-full gap-5">
                        <div class="w-full md:w-2/4">
                            <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                                Tipo de documento
                            </label>
                            <x-select data-custom_select2 name="document_type" data-validate id="select-department"
                                class="select-custom">
                                <option selected value="">Selecciona una opción</option>
                                <option value="DNI">DNI</option>
                                <option value="C.E">C.E</option>
                                <option value="PASAPORTE">PASAPORTE</option>
                            </x-select>
                        </div>
                        <div class="w-full md:w-2/4">
                            <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                                Número de documento
                            </label>
                            <input type="text"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-slate-300 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                                name="document_number" data-validate>
                        </div>
                    </div>
                    <div
                        class="user-profile-thumb position-relative text-center border-bottom pb-xxl-5 pb-4 mb-5 pt-xxl-5 pt-4 mt-5">
                        <div class="content">
                            <span class="fs20 fw_700 n4-clr d-block mb-1 text-16" style="font-weight: bold">
                                Datos del Contacto
                            </span>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row justify-center w-full gap-5">
                        <div class="w-full md:w-2/4">
                            <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                                Correo electrónico
                            </label>
                            <input type="email" id="alternativeNumberInput"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-slate-300 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                                name="email" data-validate>
                        </div>
                        <div class="w-full md:w-2/4">
                            <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                                Teléfono
                            </label>
                            <input type="text"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-slate-300 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                                name="phone_number" data-validate>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row justify-center w-full gap-5">
                        <div class="w-full md:w-2/4">
                            <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                                Dirección de domicilio
                            </label>
                            <input type="text"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-slate-300 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                                name="address" data-validate>
                        </div>
                        <div class="w-full md:w-2/4">
                            <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                                Departamento
                            </label>
                            <input type="text"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-slate-300 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                                name="state" data-validate>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row justify-center w-full gap-5">
                        <div class="w-full md:w-2/4">
                            <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                                Provincia
                            </label>
                            <input type="text"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-slate-300 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                                name="province" data-validate>
                        </div>
                        <div class="w-full md:w-2/4">
                            <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                                Distrito
                            </label>
                            <input type="text"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-slate-300 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                                name="district" data-validate>
                        </div>
                    </div>

                    <div>
                        <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1 mt-3">
                            ¿Eres menor de edad?
                        </label>

                        <div class="form-check">
                            <input id="radioDefault1"
                                class="border rounded-full appearance-none cursor-pointer size-4 bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500 dark:checked:bg-custom-500 dark:checked:border-custom-500"
                                type="radio" name="is_minor" value="1" checked=""
                                onchange="changeByMinorInput()">
                            <label class="form-check-label" for="radioDefault1">
                                Si
                            </label>
                        </div>
                        <div class="form-check">
                            <input id="radioDefault2"
                                class="border rounded-full appearance-none cursor-pointer size-4 bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500 dark:checked:bg-custom-500 dark:checked:border-custom-500"
                                type="radio" name="is_minor" value="0" checked=""
                                onchange="changeByMinorInput()">
                            <label class="form-check-label" for="radioDefault2">
                                No
                            </label>
                        </div>
                    </div>

                    <div id="containerApoderado">

                    </div>
                    <div
                        class="user-profile-thumb position-relative text-center border-bottom pb-xxl-5 pb-4 mb-5 pt-xxl-5 pt-4 mt-5">
                        <div class="content">
                            <span class="fs20 fw_700 n4-clr d-block mb-1 text-16" style="font-weight: bold">
                                Datos de la queja
                            </span>
                        </div>
                    </div>

                    <div>
                        <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1 mt-3">
                            Motivo
                        </label>

                        <div class="form-check mt-3">
                            <input id="radioDefault3"
                                class="border rounded-full appearance-none cursor-pointer size-4 bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500 dark:checked:bg-custom-500 dark:checked:border-custom-500"
                                type="radio" name="claim_type" value="Queja">
                            <label class="form-check-label" for="radioDefault3">
                                Queja / Servicio: Descontento respecto a la atención al público
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input id="radioDefault4"
                                class="border rounded-full appearance-none cursor-pointer size-4 bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500 dark:checked:bg-custom-500 dark:checked:border-custom-500"
                                type="radio" name="claim_type" value="Reclamo">
                            <label class="form-check-label" for="radioDefault4">
                                Reclamo / Producto: Disconformidad relacionada a los productos o servicios
                            </label>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12 col-lg-6">
                            <div class="form-cmn">
                                <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                                    Número de comprobante
                                </label>
                                <input type="text"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-slate-300 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                                    name="receipt_number" data-validate>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-cmn">
                                <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                                    Fecha de compra
                                </label>
                                <input type="date"
                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-slate-300 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                                    name="purchase_date" data-validate>
                            </div>
                        </div>
                    </div>

                    <div class="form-cmn mt-2">
                        <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                            Detalle del reclamo
                        </label>
                        <textarea
                            class="form-input border-slate-200 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                            placeholder="El producto o servicios que adquiri... (detalle)" name="claim_details" rows="2" data-validate></textarea>
                    </div>

                    <div class="form-cmn mt-2 mb-3">
                        <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                            Pedido del cliente
                        </label>
                        <textarea
                            class="form-input border-slate-200 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                            placeholder="Solicito que se ...(detalle)" name="customer_request" rows="2" data-validate></textarea>
                    </div>
                    <div>
                        <div class="form-check">
                            <input id="checkboxDefault21"
                                class="border rounded-sm appearance-none cursor-pointer size-4 bg-slate-100 border-slate-200 dark:bg-zink-600 checked:bg-custom-500 checked:border-custom-500 "
                                type="checkbox" value="" checked="">
                            <label class="form-check-label" for="checkboxDefault21" data-validate>
                                He leído y acepto los términos y condiciones de compra en la página web.
                            </label>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p>
                            De acuerdo a las disposiciones del libro de reclamaciones y normas del Código de Protección y
                            Defensa del Consumidor, el libro de reclamaciones virtual podrá ser usado por los consumidores
                            para presentar sus quejas y reclamos. La formulación del reclamo no impide acudir a otras vías
                            de solución de controversias ni es requisito para interponer una denuncia ante el INDECOPI. El
                            proveedor debe dar respuesta al reclamo o queja en un plazo no mayor a quince (15) días hábiles,
                            el cuál es improrrogable.
                        </p>
                    </div>
                    <div class="mt-3 text-end">
                        <button type="submit"
                            class="text-white bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 mb-5">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <template id="templateApoderado">
        <div class="user-profile-thumb position-relative text-center border-bottom pb-xxl-5 pb-4 mb-5 pt-xxl-5 pt-4 mt-5">
            <div class="content">
                <span class="fs20 fw_700 n4-clr d-block mb-1">
                    Datos del apoderado
                </span>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12 col-lg-6">
                <div class="form-cmn">
                    <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                        Tipo de documento
                    </label>
                    <x-select data-custom_select2 name="guardian_document_type" data-validate id="select-department"
                        class="select-custom">
                        <option selected value="">Selecciona una opción</option>
                        <option value="DNI">DNI</option>
                        <option value="C.E">C.E</option>
                        <option value="PASAPORTE">PASAPORTE</option>
                    </x-select>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-cmn">
                    <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                        Número de documento
                    </label>
                    <input type="text"
                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-slate-300 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                        name="guardian_document_number" data-validate>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12 col-lg-6">
                <div class="form-cmn">
                    <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                        Celular
                    </label>
                    <input type="text"
                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-slate-300 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                        name="guardian_phone_number" data-validate>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-cmn">
                    <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                        Nombres
                    </label>
                    <input type="text"
                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-slate-300 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                        name="guardian_first_name" data-validate>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12 col-lg-6">
                <div class="form-cmn">
                    <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                        Apellido paterno
                    </label>
                    <input type="text"
                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-slate-300 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                        name="guardian_last_name" data-validate>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-cmn">
                    <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                        Apellido materno
                    </label>
                    <input type="text"
                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-slate-300 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                        name="guardian_second_last_name" data-validate>
                </div>
            </div>
        </div>
    </template>
@endsection

@section('scripts')
    <script src="{{ URL::to('assets/js/custom/webpage/raffles.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/products.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/complaint.js') }}"></script>
@endsection
