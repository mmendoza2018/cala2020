@extends('layouts.webpage.master')

@section('headers')
    <script src="https://checkout.culqi.com/js/v4"></script>
@endsection

@section('content')
    <div>
        <!-- ==== Checkout Section ==== -->
        <section class="checkout-section pt-120 pb-120 mt-50 n0-bg">
            <div class="container">
                <div class="row g-6">
                    <div class="col-lg-8">
                        <div class="checkout-informationwrap">
                            @if (!Auth::guard('web')->check())
                                <div class="checkout-righbar nw4-border radius12 p-xxl-6 p-4 mt-lg-0 mt-4">
                                    <p class="fs18">
                                        <a href="#" class="s1-clr">¡Importante!</a> regístrese para completar su
                                        compra. Sus productos se mantendrán en el carrito mientras lo hace. Si ya tiene
                                        cuenta, inicie sesión. ¡Es rápido y fácil! Para cualquier duda, contáctenos.
                                    </p>
                                    <div class="row my-4">
                                        <div class="col-12 col-md-6">
                                            <a href="{{ route('webpage.login') }}"
                                                class="kewta-btn d-inline-flex align-items-center w-100">
                                                <span class="kew-text s1-border n0-clr act4-clr w-100"
                                                    style="padding-left: 5px; padding-right: 5px;">
                                                    Iniciar sesión
                                                </span>
                                            </a>

                                        </div>
                                        <div class="col-12 col-md-6">
                                            <a href="{{ route('webpage.register', ['fromCheckout' => true]) }}"
                                                class="kewta-btn kewta-alt d-inline-flex align-items-center w-100">
                                                <span class="kew-text s1-bg n0-clr aos-init aos-animate w-100"
                                                    data-aos="zoom-in-left" data-aos-duration="900">
                                                    Registrarse
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="mb-xxl-15 mb-xl-10 mb-8">
                                    <h4 class="n4-clr mb-xxl-10 mb-xl-8 mb-lg-7 mb-6">
                                        Información de contacto
                                    </h4>
                                    <form id="formDataUserCheckoutProducts" class="ch-form-one">
                                        @php
                                            $userAutenticated = Auth::guard('web')->user();
                                        @endphp
                                        <div class="row g-6">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="ch-form-items">
                                                    <label for="name1"
                                                        class="text-uppercase fs18 fw_600 n3-clr mb-xxl-4 mb-xl-3 mb-2">
                                                        Nombres
                                                    </label>
                                                    <input id="name1" type="text"
                                                        value="{{ $userAutenticated->names }}" readonly data-validate>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="ch-form-items">
                                                    <label for="lname1"
                                                        class="text-uppercase fs18 fw_600 n3-clr mb-xxl-4 mb-xl-3 mb-2">
                                                        Apellidos
                                                    </label>
                                                    <input id="lname1" type="text"
                                                        value="{{ $userAutenticated->surnames }}" readonly data-validate>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="ch-form-items">
                                                    <label for="phs"
                                                        class="text-uppercase fs18 fw_600 n3-clr mb-xxl-4 mb-xl-3 mb-2">
                                                        numero de celular
                                                    </label>
                                                    <input id="phs" type="text"
                                                        value="{{ $userAutenticated->phone }}" readonly data-validate>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="ch-form-items">
                                                    <label for="eml"
                                                        class="text-uppercase fs18 fw_600 n3-clr mb-xxl-4 mb-xl-3 mb-2">
                                                        Correo electronico
                                                    </label>
                                                    <input id="eml" type="email"
                                                        value="{{ $userAutenticated->email }}" readonly data-validate>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="ch-form-items">
                                                    <label for="eml"
                                                        class="text-uppercase fs18 fw_600 n3-clr mb-xxl-4 mb-xl-3 mb-2">
                                                        DNI
                                                    </label>
                                                    <input id="eml" type="text"
                                                        value="{{ $userAutenticated->dni }}" readonly data-validate>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="ch-form-items">
                                                    <label class="text-uppercase fs18 fw_600 n3-clr mb-xxl-4 mb-xl-3 mb-2">
                                                        fecha de nacimiento
                                                    </label>
                                                    <input type="date" value="{{ $userAutenticated->date_of_birth }}" data-validate>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="ch-form-items">
                                                    <label class="text-uppercase fs18 fw_600 n3-clr mb-xxl-4 mb-xl-3 mb-2">
                                                        Género
                                                    </label>

                                                    <input type="text"
                                                        value="{{ $userAutenticated->gender }}" readonly data-validate>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="ch-form-items">
                                                    <label for="eml"
                                                        class="text-uppercase fs18 fw_600 n3-clr mb-xxl-4 mb-xl-3 mb-2">
                                                        Ciudad o departamento
                                                    </label>
                                                    <input id="eml" type="text"
                                                        value="{{ $userAutenticated->department }}" readonly data-validate>
                                                </div>
                                            </div>
                                            <div>
                                                <a href="{{ route('webpage.user.profileView') }}"
                                                    class="kewta-btn kewta-alt d-inline-flex align-items-center">
                                                    <span class="kew-text s1-bg n0-clr aos-init aos-animate"
                                                        style="padding-left: 30px; padding-right: 30px;" data-aos="zoom-in-left"
                                                        data-aos-duration="900">
                                                        Actualizar datos
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cmn-box-addingbg win40-ragba border radius24 py-xxl-10 py-xl-8 py-lg-6 py-5"
                            id="detailsContainerShoppingCart">
                            <div
                                class="d-flex align-items-center justify-content-between flex-wrap px-xxl-8 px-xl-6 px-sm-5 px-4 mb-xxl-5 mb-xl-5 mb-lg-8 mb-6 gap-2">
                                <h5 class="user-title n4-clr" style="text-align: center">
                                    Detalles de compra
                                </h5>
                            </div>
                            <div class="payment-methodwrap">
                                <div
                                    class="payment-method-items gap-3 border-bottom border-top pb-xxl-5 pb-xl-5 pb-4 pt-xxl-5 pt-xl-5 pt-4 d-flex algin-items-center justify-content-between px-xxl-8 px-xl-6 px-sm-5 px-4">
                                    <div class="row w-100">
                                        <div class="col-6">
                                            <span class="n4-clr fw_600 d-block mb-0">
                                                Productos
                                            </span>
                                        </div>
                                        <div class="col-6">
                                            <span class="n4-clr fw_600 d-block mb-0 numProducts">
                                                {{ session()->has('shoppingCartProducts') ? count(session('shoppingCartProducts')) : 0 }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="payment-method-items gap-3 border-bottom border-top pb-xxl-5 pb-xl-5 pb-4 pt-xxl-5 pt-xl-5 pt-4 d-flex algin-items-center justify-content-between px-xxl-8 px-xl-6 px-sm-5 px-4">
                                    <div class="row w-100">
                                        <div class="col-6">
                                            <span class="n4-clr fw_600 d-block mb-0">
                                                Subtotal
                                            </span>
                                        </div>
                                        <div class="col-6">
                                            <span class="n4-clr fw_600 d-block mb-0 subtotal">
                                                S/{{ number_format($total, 2) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="payment-method-items gap-3 border-bottom border-top pb-xxl-5 pb-xl-5 pb-4 pt-xxl-5 pt-xl-5 pt-4 d-flex algin-items-center justify-content-between px-xxl-8 px-xl-6 px-sm-5 px-4">
                                    <div class="row w-100">
                                        <div class="col-6">
                                            <span class="n4-clr fw_600 d-block mb-0">
                                                Total
                                            </span>
                                        </div>
                                        <div class="col-6">
                                            <span class="n4-clr fw_600 d-block mb-0 total"
                                                data-total_global_culqui="{{ $total * 100 }}">
                                                S/{{ number_format($total, 2) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            $productsAndAutenticationValid =
                                Auth::guard('web')->check() && session()->has('shoppingCartProducts') ? true : false;
                        @endphp
                        @if ($productsAndAutenticationValid)
                            <a href="{{ route('form_checkout_izipay') }}" class="kewta-btn kewta-alt align-items-center d-block w-100 mt-3">
                                <span class="kew-text s1-bg n0-clr" style="padding-left: 30px; padding-right: 30px;" data-aos="zoom-in-left" data-aos-duration="900">
                                    Proceder con el pago
                                </span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- ==== Checkout Section ==== -->
    </div>
@endsection

@section('scripts')
    <script src="{{ URL::to('assets/js/custom/webpage/checkout.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/raffles.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/products.js') }}"></script>
@endsection
