@extends('layouts.webpage.master')

@section('content')
    <div>
        <section class="current-lottery current-lotteryv9 winbg pt-120 pb-120 mt-50">
            <div class="container">
                <!--Section Header-->
                <div class="row g-xl-4 g-3 align-items-center justify-content-between mb-xxl-15 mb-xl-10 mb-8">
                    <div class="col-lg-6 col-md-8 col-sm-8">
                        <div class="section__title text-sm-start text-center mb-lg-0 mb-4">
                            <div class="subtitle-head mb-xxl-4 mb-sm-4 mb-3 d-flex flex-wrap align-items-center justify-content-sm-start justify-content-center gap-3"
                                data-aos="zoom-in-down" data-aos-duration="1200">
                                <img src="assets/images/global/section-icon.png" width="50px" alt="img">
                                <h5 class="s1-clr fw_700">
                                    ¡Participa y se parte de nuestra comunidad!
                                </h5>
                            </div>
                            <span class="display-four d-block n4-clr">
                                Nuestras <span class="act4-clr act4-underline" data-aos="zoom-in-left"
                                    data-aos-duration="1000">Actividades </span>
                            </span>
                        </div>
                    </div>
                </div>
                <!--Section Header-->

                <!--win lottery body-->
                <div id="">
                    @include('webpage.components.raffles', ['raffles' => $raffles])
                </div>
                <!--win lottery body-->
            </div>
        </section>

    </div>
@endsection
@section('scripts')
    <script src="{{ URL::to('assets/js/custom/webpage/raffles.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/products.js') }}"></script>
@endsection
