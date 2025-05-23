@extends('layouts.webpage.master')
@section('headers')
    <link rel="stylesheet" href="{{ URL::to('assets/libs/splide/dist/css/splide.min.css') }}">
@endsection
@section('content')
    <style>
        .splide__slide img {
            width: 100%;
            height: auto;
            aspect-ratio: 16 / 9;
            object-fit: contain;
        }
    </style>
    <div>
        <!-- ==== Banner Breadcrumbs ==== -->
        <div class="banner-bredcrumbs pt-70-fixed n4-bg position-relative overflow-hidden">
            <div class="container">
                <div class="breadcrumbs-content position-relative cus-z1 pt-120 pb-120 text-center">
                    <span class="mb-xxl-8 mb-xl-6 mb-5 display-two nw1-clr" data-aos="zoom-in" data-aos-duration="2000">
                        Detalles de la actividad
                    </span>
                </div>
            </div>
            <!--Banner Shape Images-->
            <img src="{{ URL::to('assets/images/global/shape-breadcrum-right.png') }}" alt="img"
                class="shape-breadcrumbright">
            <!--Banner Shape Images-->
        </div>
        <!-- ==== Banner Breadcrumbs ==== -->
        @php
            $images = json_decode($raffle->images, true);
        @endphp
        <!-- ==== Contest Details Slide ==== -->
        <div class="contest-carslide-section position-relative">
            <div class="container">
                <div
                    class="contest-details-carslidewrap position-relative biggest-winner-sldewrap swiper py-xxl-5 py-lg-6 py-7 px-2">
                    <div class="col-12 col-lg-9 mx-auto">
                        <section id="main-carousel" class="splide splideRaffles" data-aos="zoom-in" data-aos-duration="2000"
                            aria-label="The carousel with thumbnails. Selecting a thumbnail will change the Beautiful Gallery carousel.">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    @foreach ($images as $image)
                                        <li class="splide__slide">
                                            <img src="{{ asset('storage/uploads/' . getCompanyCode() . '/' . $image['path']) }}"
                                                alt="{{ $image['description'] }}">
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </section>

                        <section id="thumbnail-carousel" class="splide mt-5"
                            aria-label="The carousel with thumbnails. Selecting a thumbnail will change the Beautiful Gallery carousel.">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    @foreach ($images as $image)
                                        <li class="splide__slide">
                                            <img src="{{ asset('storage/uploads/' . getCompanyCode() . '/' . $image['path']) }}"
                                                alt="{{ $image['description'] }}">
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <!-- ==== Contest Details Slide ==== -->

        <!-- ==== Contest Section ==== -->
        <section class="contest-details pt-100 pb-120">
            <div class="container">
                <div class="row g-6">
                    <div class="col-lg-7" data-aos="zoom-in" data-aos-duration="2000">
                        <div class="contest-details-leftwrap border-bottom pb-6 mb-xxl-8 mb-6">
                            <div class="border-bottom pb-xxl-8 pb-6 mb-xxl-8 mb-6">
                                <h2 class="n4-clr mb-xxl-3 mb-2">
                                    {{ $raffle->title }}
                                </h2>
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <span class="border-con"></span>
                                    <span
                                        class="fs-eight n3-clr">{{ \Carbon\Carbon::parse($raffle->draw_date)->translatedFormat('d \d\e F \d\e Y') }}</span>
                                </div>
                            </div>
                            <div data-id_raffle="{{ $raffle->id }}"></div>
                            <div class="common-tabwrap">
                                <div class="singletab">
                                    <div>
                                        {!! $raffle->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-bottom pb-6 mb-xxl-8 mb-6">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-12 col-lg-5">
                                    <h5 class="s1-clr fw_700">
                                        Nuestras cuentas oficiales
                                    </h5>
                                </div>
                                <div class="col-12 col-lg-7">
                                    <div class="row">
                                        <div class="col-6 col-lg-6 p-3">
                                            <div class="form-cmn">
                                                <a target="_blank" href="https://www.instagram.com/ruletabiker/"
                                                    class="bg-instagram w-100 radius12 fw_600 d-flex align-items-center justify-content-between py-xxl-4 py-3 px-xxl-4 px-3">
                                                    Instagram
                                                    <i class="ph ph-instagram-logo"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-6 p-3">
                                            <div class="form-cmn">
                                                <a target="_blank" href="https://www.facebook.com/profile.php?id=61564022398175"
                                                    class=" bg-facebook w-100 radius12 s1-bg fw_600 nw1-clr d-flex align-items-center justify-content-between py-xxl-4 py-3 px-xxl-4 px-3">
                                                    Facebook
                                                    <i class="ph ph-facebook-logo"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-6 p-3">
                                            <div class="form-cmn">
                                                <a target="_blank" href="ttps://www.tiktok.com/@ruleta.biker"
                                                    class="bg-tiktok w-100 radius12 s1-bg fw_600 nw1-clr d-flex align-items-center justify-content-between py-xxl-4 py-3 px-xxl-4 px-3">
                                                    Tik tok
                                                    <img src="{{ asset('assets/images/global/tiktok.svg') }}" width="25px" alt="">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-6 col-lg-6 p-3">
                                            <div class="form-cmn">
                                                <a target="_blank" href="https://t.me/ruletabikerperu"
                                                    class="bg-telegram w-100 radius12 s1-bg fw_600 nw1-clr d-flex align-items-center justify-content-between py-xxl-4 py-3 px-xxl-4 px-3">
                                                    Telegram
                                                    <img src="{{ asset('assets/images/global/telegram.svg') }}" width="25px" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="contact-content">
                            <div class="row">
                                @foreach ($raffle->raffleCharasteristics as $characteristic)
                                    <div class="col-12 col-lg-6">
                                        <div class="contact-cont-items d-flex align-items-center gap-xxl-8 gap-xl-6 gap-lg-4 gap-3 mb-xxl-15 mb-xl-10 mb-lg-8 mb-sm-7 mb-6 aos-init aos-animate"
                                            data-aos="zoom-in-left" data-aos-duration="1400">
                                            <div class="icon d-center act2-border radius-circle">
                                                <img src="{{ URL::to('assets/images/icons-db/' . $characteristic->image_name) }}"
                                                    style="width: 35px" alt="">
                                            </div>
                                            <div class="cont">
                                                <h4 class="n1-clr mb-1">{{ $characteristic->title }}</h4>
                                                <span class="n3-clr">
                                                    {{ $characteristic->description }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5" data-aos="zoom-in" data-aos-duration="2000">
                        @if ($raffle->draw_date >= now())
                            <div class="competition-ending border radius24">
                                <div class="conpetition-title  py-xxl-5 py-xl-5 py-5 px-xxl-8 px-xl-6 px-4">
                                    <h3 class="act4-clr text-center">
                                        Este Actividad termina en:
                                    </h3>
                                </div>
                                <div class="py-xxl-5 py-xl-5 py-5 px-xxl-8 px-xl-6 px-4"">
                                    <div class="draw-timerwrap justify-content-center" id="timerDetailRaffle"
                                        data-draw_date_detail="{{ $raffle->draw_date }}">
                                        <div class="draw-timer-item">
                                            <span class="text-hed days" style="color: black">299</span>
                                            <div class="smalltext n4-clr" style="color: black">Dias</div>
                                        </div>
                                        <div class="lborder-dot">:</div>
                                        <div class="draw-timer-item">
                                            <span class="text-hed hours" style="color: black">23</span>
                                            <div class="smalltext" style="color: black">Horas</div>
                                        </div>
                                        <div class="lborder-dot">:</div>
                                        <div class="draw-timer-item">
                                            <span class="text-hed minutes" style="color: black">59</span>
                                            <div class="smalltext" style="color: black">Minutos</div>
                                        </div>
                                        <div class="lborder-dot">:</div>
                                        <div class="draw-timer-item">
                                            <span class="text-hed seconds" style="color: black">44</span>
                                            <div class="smalltext" style="color: black">Segundos</div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="d-flex gap-2 justify-content-center py-xxl-5 py-xl-5 py-5 px-xxl-8 px-xl-6 px-1"">
                                    <div class="quantity-basket d-inline">
                                        <div>
                                            <p class="qty">
                                                <button class="qtyminus" aria-hidden="true">-</button>
                                                <input type="number" name="qty" id="quantityRaffle" min="1"
                                                    max="10" step="1" class="qtyInput" value="1">
                                                <button class="qtyplus" aria-hidden="true">+</button>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-inline">
                                        {{-- <a href="#0" class="kewta-btn kewta-alt d-inline-flex align-items-center"
                                            onclick="addRaffleToShoppingCart()">
                                            <span class="kew-text s1-bg n0-clr">
                                                Agregar al carrito
                                            </span>
                                        </a> --}}

                                        <a target="_blank" href="https://www.instagram.com/ruletabiker/" class="kewta-btn kewta-alt d-inline-flex align-items-center"
                                            onclick="addRaffleToShoppingCart()">
                                            <span class="kew-text s1-bg n0-clr">
                                                Comprar tickets
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div>
                                <div class="conpetition-title  py-xxl-5 py-xl-5 py-5 px-xxl-8 px-xl-6 px-4">
                                    <h3 class="act4-clr text-center">
                                        Este actividad ha terminado
                                    </h3>
                                </div>
                                <div class="text-center">
                                    <a href="{{ route('webpage.raffles') }}"
                                        class="kewta-btn kewta-alt d-inline-flex align-items-center">
                                        <span class="kew-text s1-bg n0-clr">
                                            Ver mas actividades
                                        </span>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- ==== Contest Section ==== -->

    </div>
@endsection

@section('scripts')
    <script src="{{ URL::to('assets/libs/splide/dist/js/splide.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/raffles.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/products.js') }}"></script>
@endsection
