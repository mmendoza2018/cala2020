@extends('layouts.webpage.master')
@section('headers')
    <link rel="stylesheet" href="{{ URL::to('assets/libs/splide/dist/css/splide.min.css') }}">
@endsection
@section('content')
    <div>
        <!-- ==== Basket Section ==== -->
        <section class="basket-section pt-120 pb-120 mt-50 n0-bg">
            <div class="container">
                <div class="basket-wrapper">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-9" id="containerRaffleShoppingCart">
                            @php
                                $total = 0;
                            @endphp
                            @if (session()->has('shoppingCartRaffles') && count(session('shoppingCartRaffles')) > 0)
                                @foreach (session('shoppingCartRaffles') as $raffle)
                                    @php
                                        $subtotal = $raffle['price'] * $raffle['quantity']; // Calcula el subtotal para cada producto
                                        $total += $subtotal; // Acumula el subtotal en el total
                                    @endphp
                                    <div class="basket-items border-bottom pb-xxl-3 pb-3 mb-xxl-8 mb-6 d-flex flex-wrap flex-md-nowrap align-items-center justify-content-md-between justify-content-center gap-xxl-15 gap-6"
                                        data-aos="zoom-in-up" data-aos-duration="500">
                                        <div class="basket-thumb d-flex align-items-center gap-xxl-6 gap-4 w-100">
                                            <div class="thumb-basket position-relative d-center">
                                                <img src="{{ asset('storage/uploads/' . getCompanyCode() . '/' . $raffle['image']->path) }}"
                                                    alt="{{ $raffle['image']->description }}"
                                                    class="aspect-ratio-16-9 imgShoppingCart" style="width: 70%">
                                            </div>
                                            <div class="cont">
                                                <span class="n1-clr fw_700 mb-xxl-2 descriptionShoppingCart">
                                                    {{ $raffle['title'] }}
                                                </span>
                                                <p class="fw_600 priceShoppingCart">
                                                    S/{{ number_format($raffle['price'], 2) }}
                                                </p>
                                            </div>
                                        </div>
                                        <div
                                            class="basket-content-area d-flex align-items-center justify-content-between gap-3">
                                            <div class="quantity-basket d-inline">
                                                <div>
                                                    <p class="qty">
                                                        <button class="qtyminus minusBtnShoppingCart" onclick="addRemoveRaffleCart(this, 'minus')" 
                                                        data-id_raffle="{{ $raffle['raffleId'] }}">-</button>
                                                        <input type="number" name="qty" id="quantityProductCombination"
                                                            min="1" max="10" step="1"
                                                            class="qtyInput quantityShoppingCart" readonly
                                                            value="{{ $raffle['quantity'] }}">
                                                        <button class="qtyplus plusBtnShoppingCart" onclick="addRemoveRaffleCart(this, 'plus')" 
                                                        data-id_raffle="{{ $raffle['raffleId'] }}">+</button>
                                                    </p>
                                                </div>
                                            </div>
                                            <span class="fs20 fw_700 n1-clr subtotalShoppingCart">
                                                S/{{ number_format($subtotal, 2) }}
                                            </span>
                                            <button type="button"
                                                class="cmn-time border-clrn3 radius-circle d-center removeBtnShoppingCart"
                                                onclick="removeRaffleShoppingCart(this)"
                                                data-id_raffle="{{ $raffle['raffleId'] }}">
                                                <i class="ph ph-x n3-clr"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div
                                    class="p-10 text-sm border text-center rounded-md text-slate-500 border-slate-200 bg-slate-50 dark:bg-zink-500/30 dark:border-zink-500 dark:text-zink-200">
                                    <span class="font-bold">Aun no se añadieron Tickets a la orden</span>
                                </div>
                            @endif
                        </div>

                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="cmn-box-addingbg win40-ragba border radius24 py-xxl-10 py-xl-8 py-lg-6 py-5" id="detailsContainerRaffleShoppingCart">
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
                                                    Tickets
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
                                                <span class="n4-clr fw_600 d-block mb-0 total">
                                                    S/{{ number_format($total, 2) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button"
                                class="act4-bg fw_700 nw1-clr radius12 py-xxl-3 py-2 px-xxl-16 px-xl-10 px-8 mt-3">
                                Proceder con el pago
                            </button>
                        </div>

                    </div>

                    <div class="text-md-end text-center mt-3">

                    </div>
                </div>
            </div>
        </section>
        <template id="templateRaffleShoppingCart">
            <div class="basket-items border-bottom pb-xxl-3 pb-3 mb-xxl-8 mb-6 d-flex flex-wrap flex-md-nowrap align-items-center justify-content-md-between justify-content-center gap-xxl-15 gap-6"
                data-aos="zoom-in-up" data-aos-duration="500">
                <div class="basket-thumb d-flex align-items-center gap-xxl-6 gap-4 w-100">
                    <div class="thumb-basket position-relative d-center">
                        <img src="" alt="" class="aspect-ratio-1-1 imgShoppingCart" style="width: 70%">
                    </div>
                    <div class="cont">
                        <span class="n1-clr fw_700 mb-xxl-2 descriptionShoppingCart">
                            titulo
                        </span>
                        <p class="fw_600 priceShoppingCart">
                            precio
                        </p>
                        <div class="attributesShoppingCart">

                        </div>
                    </div>
                </div>
                <div class="basket-content-area d-flex align-items-center justify-content-between gap-3">
                    <div class="quantity-basket d-inline">
                        <div>
                            <p class="qty">
                                <button class="qtyminus minusBtnShoppingCart" onclick="addRemoveProductCart(this, 'minus')">-</button>
                                <input type="number" name="qty" id="quantityProductCombination" min="1"
                                    max="10" step="1" class="qtyInput quantityShoppingCart" value="" readonly>
                                <button class="qtyplus plusBtnShoppingCart" onclick="addRemoveProductCart(this, 'plus')">+</button>
                            </p>
                        </div>
                    </div>
                    <span class="fs20 fw_700 n1-clr subtotalShoppingCart">
                        S/ subtotal
                    </span>
                    <button type="button" class="cmn-time border-clrn3 radius-circle d-center removeBtnShoppingCart"
                        onclick="removeProductShoppingCart(this)" data-product_attribute_id="">
                        <i class="ph ph-x n3-clr"></i>
                    </button>
                </div>
            </div>
        </template>
        <!-- ==== Basket Section ==== -->
    </div>
@endsection

@section('scripts')
    <script src="{{ URL::to('assets/js/custom/webpage/raffles.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/products.js') }}"></script>
@endsection
