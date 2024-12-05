@extends('layouts.webpage.master')

@section('content')
    <div>
        <div class="banner-bredcrumbs pt-70-fixed n4-bg position-relative overflow-hidden overflow-hidden">
            <div class="container">
                <div class="breadcrumbs-content position-relative cus-z1 pt-120 pb-120 text-center">
                    <span class="mb-xxl-8 mb-xl-6 mb-5 display-two nw1-clr" data-aos="zoom-in-left" data-aos-duration="2000">
                        Sobre Nosotros
                    </span>
                </div>
            </div>
        </div>


        <div class="about-section pt-120 pb-120 n0-bg overflow-hidden">
            <div class="container">
                <div class="about-wrapper-core">
                    <div class="row g-xxl-12 g-xl-6 g-5">
                        <div class="col-lg-6 order-2 order-lg-1">
                            <div class="about-thumb-core" data-aos="zoom-in" data-aos-duration="1600">
                                <img src="{{ asset('assets/images/general/quienes-somos.png') }}" alt="img">
                            </div>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2">
                            <div class="about-content-core">
                                <div class="mb-xxl-8 mb-6">
                                    <span class="display-four d-block n4-clr mb-xxl-4 mb-xl-3 mb-2">
                                        ¿Quienes <span class="act4-clr act4-underline aos-init aos-animate">somos </span> ?
                                    </span>
                                    <p class="fs20 n3-clr aos-init aos-animate">
                                        En Ruleta Biker, somos apasionados por el mundo de las motocicletas y el espíritu aventurero que las acompaña. Nuestra empresa se dedica a la venta de repuestos y accesorios para motocicletas, así como a la organización actividades benéficas al servicio de nuestra comunidad. Creemos que cada motocicleta cuenta una historia y queremos que nuestros clientes vivan la suya al máximo. Nos comprometemos a ofrecer productos de alta calidad y a crear experiencias únicas para toda nuestra comunidad motera, donde la calidad y la transparencia son nuestra prioridad.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center g-xxl-12 g-xl-6 g-5 mt-5">
                        <div class="col-lg-6 order-2 order-lg-2">
                            <div class="about-thumb-core" data-aos="zoom-in" data-aos-duration="1600">
                                <img src="assets/images/general/mision.png" alt="img">
                            </div>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-1">
                            <div class="about-content-core">
                                <span class="display-four d-block n4-clr mb-xxl-4 mb-xl-3 mb-2">
                                    Misión
                                </span>
                                <span class="fs20 n3-clr">
                                    Ofrecemos a los amantes de las motocicletas una plataforma confiable para adquirir repuestos y accesorios de calidad, así como participar de nuestras actividades y formar parte de nuestra comunidad, garantizando siempre un servicio excepcional y una experiencia transparente.
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center g-xxl-12 g-xl-6 g-5 mt-5">
                        <div class="col-lg-6 order-2 order-lg-1">
                            <div class="about-thumb-core" data-aos="zoom-in" data-aos-duration="1600">
                                <img src="assets/images/general/vision.png" alt="img">
                            </div>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2">
                            <span class="display-four d-block n4-clr mb-xxl-4 mb-xl-3 mb-2">
                                Visión
                            </span>
                            <div class="about-content-core">
                                <span class="fs20 n3-clr">
                                    Ser la plataforma líder en el mercado de repuestos y accesorios biker a nivel nacional, reconocida por nuestra calidad, transparencia y dedicación al cliente, creando una comunidad apasionada por el motociclismo.
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="{{ URL::to('assets/js/custom/webpage/raffles.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/products.js') }}"></script>
@endsection
