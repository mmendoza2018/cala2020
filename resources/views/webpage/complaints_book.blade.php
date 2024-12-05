@extends('layouts.webpage.master')
@section('headers')
    <link rel="stylesheet" href="{{ URL::to('assets/libs/splide/dist/css/splide.min.css') }}">
@endsection
@section('content')
    <div>
        <div class="about-section pt-120 pb-100 mt-50 n0-bg overflow-hidden winbg">
            <div class="container" style="max-width: 700px">
                <h4 class="text-center mb-5">RULETA BIKER | LIBRO DE RECLAMACIONES - LEY N°29571</h4>
                <form class="form-cmn-action" id="formComplaint">
                    <div class="form-cmn">
                        <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                            Código de Reclamo
                        </label>
                        <input type="email" name="email" value="{{ $lastComplaint }}" disabled readonly data-validate="">
                    </div>
                    <div
                        class="user-profile-thumb position-relative text-center border-bottom pb-xxl-5 pb-4 mb-5 pt-xxl-5 pt-4 mt-5">
                        <div class="content">
                            <span class="fs20 fw_700 n4-clr d-block mb-1">
                                Datos del Cliente
                            </span>
                        </div>
                    </div>
                    <div class="form-cmn mt-2">
                        <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                            Nombres
                        </label>
                        <input type="text" name="first_name" data-validate="">
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 col-lg-6">
                            <div class="form-cmn">
                                <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                                    Apellido Paterno
                                </label>
                                <input type="text" name="last_name" data-validate="">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-cmn">
                                <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                                    Apellido Materno
                                </label>
                                <input type="text" name="second_last_name" data-validate="">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 col-lg-6">
                            <div class="form-cmn">
                                <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                                    Tipo de documento
                                </label>
                                <select name="document_type" class="select-custom" data-validate>
                                    <option selected value="">Selecciona una opción</option>
                                    <option value="DNI">DNI</option>
                                    <option value="C.E">C.E</option>
                                    <option value="PASAPORTE">PASAPORTE</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-cmn">
                                <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                                    Número de documento
                                </label>
                                <input type="text" name="document_number" data-validate="">
                            </div>
                        </div>
                    </div>
                    <div
                        class="user-profile-thumb position-relative text-center border-bottom pb-xxl-5 pb-4 mb-5 pt-xxl-5 pt-4 mt-5">
                        <div class="content">
                            <span class="fs20 fw_700 n4-clr d-block mb-1">
                                Datos del Contacto
                            </span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 col-lg-6">
                            <div class="form-cmn">
                                <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                                    Correo electrónico
                                </label>
                                <input type="email" name="email" data-validate="">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-cmn">
                                <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                                    Teléfono
                                </label>
                                <input type="text" name="phone_number" data-validate="">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 col-lg-6">
                            <div class="form-cmn">
                                <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                                    Dirección de domicilio
                                </label>
                                <input type="text" name="address" data-validate="">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-cmn">
                                <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                                    Departamento
                                </label>
                                <input type="text" name="state" data-validate="">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 col-lg-6">
                            <div class="form-cmn">
                                <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                                    Provincia
                                </label>
                                <input type="text" name="province" data-validate="">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-cmn">
                                <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                                    Distrito
                                </label>
                                <input type="text" name="district" data-validate="">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1 mt-3">
                            ¿Eres menor de edad?
                        </label>

                        <div class="form-check">
                            <input class="form-check-input me-2" onchange="changeByMinorInput()" type="radio" style="padding: 10px" value="1"
                                name="is_minor">
                            <label class="form-check-label">
                                Si
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input me-2" onchange="changeByMinorInput()" type="radio" value="0" checked
                                style="padding: 10px" name="is_minor">
                            <label class="form-check-label">
                                No
                            </label>
                        </div>
                    </div>

                    <div id="containerApoderado">

                    </div>
                    <div
                        class="user-profile-thumb position-relative text-center border-bottom pb-xxl-5 pb-4 mb-5 pt-xxl-5 pt-4 mt-5">
                        <div class="content">
                            <span class="fs20 fw_700 n4-clr d-block mb-1">
                                Datos de la queja
                            </span>
                        </div>
                    </div>

                    <div>
                        <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1 mt-3">
                            Motivo
                        </label>

                        <div class="form-check mt-3">
                            <input class="form-check-input me-2" type="radio" style="padding: 10px" name="claim_type"
                                value="Queja">
                            <label class="form-check-label">
                                Queja / Servicio: Descontento respecto a la atención al público
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input me-2" type="radio" style="padding: 10px" name="claim_type"
                                value="Reclamo">
                            <label class="form-check-label">
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
                                <input type="text" name="receipt_number" data-validate="">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-cmn">
                                <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                                    Fecha de compra
                                </label>
                                <input type="date" name="purchase_date" data-validate="">
                            </div>
                        </div>
                    </div>

                    <div class="form-cmn mt-2">
                        <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                            Detalle del reclamo
                        </label>
                        <textarea name="claim_details" rows="2" data-validate
                            placeholder="El producto o servicios que adquiri... (detalle)"></textarea>
                    </div>

                    <div class="form-cmn mt-2">
                        <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                            Pedido del cliente
                        </label>
                        <textarea name="customer_request" rows="2" data-validate placeholder="Solicito que se ...(detalle)"></textarea>
                    </div>
                    <div>
                        <div class="form-check">
                            <input class="form-check-input me-3" type="checkbox" data-validate>
                            <label class="form-check-label">
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
                        <button type="submit" class="kewta-btn kewta-alt d-inline-flex align-items-center">
                            <span class="kew-text s1-bg n0-clr">
                                Enviar
                            </span>
                        </button>
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
                    <select name="guardian_document_type" class="select-custom" data-validate>
                        <option selected value="">Selecciona una opción</option>
                        <option value="DNI">DNI</option>
                        <option value="C.E">C.E</option>
                        <option value="PASAPORTE">PASAPORTE</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-cmn">
                    <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                        Número de documento
                    </label>
                    <input type="text" name="guardian_document_number" data-validate="">
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12 col-lg-6">
                <div class="form-cmn">
                    <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                        Celular
                    </label>
                    <input type="text" name="guardian_phone_number" data-validate="">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-cmn">
                    <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                        Nombres
                    </label>
                    <input type="text" name="guardian_first_name" data-validate="">
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12 col-lg-6">
                <div class="form-cmn">
                    <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                        Apellido paterno
                    </label>
                    <input type="text" name="guardian_last_name" data-validate="">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-cmn">
                    <label for="name1" class="text-capitalize fs18 fw_600 n3-clr mb-xxl-2 mb-xl-2 mb-1">
                        Apellido materno
                    </label>
                    <input type="text" name="guardian_second_last_name" data-validate="">
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
