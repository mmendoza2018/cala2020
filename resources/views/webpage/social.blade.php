@extends('layouts.webpage.master')
@section('headers')
    <link rel="stylesheet" href="{{ URL::to('assets/libs/splide/dist/css/splide.min.css') }}">
@endsection
@section('content')
    <div>
        <div class="banner-bredcrumbs pt-70-fixed n4-bg position-relative overflow-hidden">
            <div class="container">
                <div class="breadcrumbs-content position-relative cus-z1 pt-120 pb-120 text-center">
                    <span class="mb-xxl-8 mb-xl-6 mb-5 display-two nw1-clr" data-aos="zoom-in-left" data-aos-duration="2400">
                        RUTA SOLIDARIA
                    </span>
                    <p class="nw1-clr fs20 max-630 m-auto mb-xxl-10 mb-lg-8 mb-5" data-aos="fade-down-right"
                        data-aos-duration="2400">
                        En Ruleta Biker, queremos ser un motor de cambio positivo en la vida de las personas apoyado a
                        sectores fundamentales como la salud, la educación y el cuidado del medio ambiente, entre otros.
                        ¡Juntos, hacemos la diferencia!
                    </p>
                </div>
            </div>
        </div>

        <div class="about-section pt-120 pb-100 n0-bg overflow-hidden winbg">
            <div class="container">
                <div>
                    <img src="{{ URL::to('assets/images/social.webp') }}" class="img-social" alt=""
                        data-aos="fade-down-right" data-aos-duration="2400">
                </div>
            </div>
            <div class="container text-center mt-120" data-aos="zoom-in-left" data-aos-duration="1000">
                <span class="display-four d-block n4-clr">
                    Nuestra <span class="act4-clr act4-underline">meta </span>
                </span>
            </div>
            <div class="container" data-aos="zoom-in-left" data-aos-duration="1000">
                <div class="mt-50 mb-50 border radius24 p-5" style="background-color: #0070ff21">
                    <h4 class="n4-clr mb-xxl-4 mb-3 fw_700 text-center" style="text-align: justify">
                        Transformar vidas a través de nuestras acciones sociales y solidarias.
                    </h4>
                </div>
            </div>


            <section class="howit-work-section position-relative n2-bg pt-120 pb-120">

                <!--Work Body-->
                <div class="container">
                    <div class="row g-6">
                        <div class="col-lg-4 col-md-6 " data-aos="zoom-in" data-aos-duration="1000">
                            <div class="work-item1 position-relative">
                                <h2 class="n0-clr mb-xxl-11 mb-xl-8 mb-lg-6 mb-5">
                                    <span class="d-block">
                                        Compromiso
                                    </span>
                                </h2>
                                <p class="fs18 nw4-clr" style="text-align: justify">
                                    En Ruleta Biker, apoyamos causas esenciales como la educación, la salud y el cuidado
                                    ambiental, promoviendo el bienestar de nuestra comunidad.
                                </p>
                                <span class="number-shadow">
                                    1
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 aos-init" data-aos="zoom-in" data-aos-duration="1000">
                            <div class="work-item1 position-relative">
                                <h2 class="n0-clr mb-xxl-11 mb-xl-8 mb-lg-6 mb-5">
                                    <span class="d-block">
                                        Apoyo
                                    </span>
                                </h2>
                                <p class="fs18 nw4-clr" style="text-align: justify">
                                    Nos dedicamos a brindar ayuda directa a quienes más lo necesitan, impulsando el cambio
                                    positivo que deseamos ver en el mundo.
                                </p>
                                <span class="number-shadow">
                                    2
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-duration="1000">
                            <div class="work-item1 position-relative">
                                <h2 class="n0-clr mb-xxl-11 mb-xl-8 mb-lg-6 mb-5">
                                    <span class="d-block">
                                        Comunicación
                                    </span>
                                </h2>
                                <p class="fs18 nw4-clr" style="text-align: justify">
                                    Mantente al tanto de nuestras iniciativas solidarias siguiendo nuestras redes sociales.
                                    ¡Gracias por ser parte de este viaje hacia un impacto positivo!
                                </p>
                                <span class="number-shadow">
                                    3
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Work Body-->
            </section>


            <footer class="footer-section4 n5-bg position-relative cus-z1 overflow-hidden mt-120">
                <div class="container">
                    <div class="row g-6 justify-content-between align-items-center mt-5">
                        <div class="col-lg-7 col-md-7" data-aos="zoom-in" data-aos-duration="1000">
                            <div class="destination-cont-left">
                                <div class="box mb-xxl-15 mb-xl-10 mb-md-8 mb-sm-4 mb-2">
                                    <h4 class="display-seven nw1-clr">
                                        ¿Deseas ayudar y ser parte del cambio?
                                    </h4>
                                </div>
                                <ul class="about-list d-grid gap-xxl-4 gap-3 mb-xxl-10 mb-xl-8 mb-7">
                                    <li class="d-flex align-items-center gap-xxl-4 gap-3 aos-init aos-animate"
                                        data-aos="zoom-in-up" data-aos-duration="1200">
                                        <span class="icon cmn-40 d-center p1-bg radius-circle">
                                            <i class="ph ph-check n4-clr"></i>
                                        </span>
                                        <span class="fs20 fw_600 nw1-clr">
                                            ¿Deseas proponer ideas de mejora?
                                        </span>
                                    </li>
                                    <li class="d-flex align-items-center gap-xxl-4 gap-3 aos-init aos-animate"
                                        data-aos="zoom-in-up" data-aos-duration="1200">
                                        <span class="icon cmn-40 d-center p1-bg radius-circle">
                                            <i class="ph ph-check n4-clr"></i>
                                        </span>
                                        <span class="fs20 fw_600 nw1-clr">
                                            ¿Tienes actividades de ayuda social en mente?
                                        </span>
                                    </li>
                                    <li class="d-flex align-items-center gap-xxl-4 gap-3 aos-init aos-animate"
                                        data-aos="zoom-in-up" data-aos-duration="1200">
                                        <span class="icon cmn-40 d-center p1-bg radius-circle">
                                            <i class="ph ph-check n4-clr"></i>
                                        </span>
                                        <span class="fs20 fw_600 nw1-clr">
                                            ¿Te interesa ser voluntario?
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 p-5" data-aos="zoom-in" data-aos-duration="1000">
                            <div class="footer-v4cont-info">
                                <div class="fv4-cont-item d-flex align-items-center gap-xxl-4 gap-lg-3 gap-2">
                                    <div class="icon cmn-60 radius-circle d-center">
                                        <i class="ph-bold ph-envelope-simple fs-four p1-clr"></i>
                                    </div>
                                    <div class="cont">
                                        <span class="nw1-clr d-block fs-seven mb-2">
                                            Contactanos
                                        </span>
                                        <a href="javascript:void(0)" class="nw1-clr fs20 fw_600">
                                            contacto.ruletabiker@gmail.com
                                        </a>
                                    </div>
                                </div>
                                <div class="fline aos-init aos-animate" data-aos="zoom-in-up" data-aos-duration="1200">
                                </div>
                            </div>
                        </div>
                    </div>
            </footer>

        </div>





    </div>
@endsection

@section('scripts')
    <script src="{{ URL::to('assets/js/custom/webpage/raffles.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/products.js') }}"></script>
@endsection
