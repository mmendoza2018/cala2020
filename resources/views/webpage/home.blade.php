@extends('layouts.webpage.master')

@section('css')
    <link rel="stylesheet" href="{{ URL::to('assets/css/webpage/home.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/libs/splide/dist/css/splide.min.css') }}">
@endsection

@section('content')
    <div data-page_active="home">
        <section class="splide full-screen-carousel" id="splidePrincipalBanner" aria-label="Splide Basic HTML Example">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($banners as $banner)
                        <li class="splide__slide">
                            <img src="{{ asset('storage/uploads/' . $banner->image_name) }}" class="slide-img">
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        <section class="container mt-14 mb-16">
            <div>
                <h5 class="title-page mb-16">Categorias</h5>
                <div>
                    <div class="splide" id="splideCategories" aria-label="Splide Basic HTML Example">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach ($categories as $category)
                                    <li class="splide__slide">
                                        <figure class="effect-apollo">
                                            <img src="{{ asset('storage/uploads/' . $category->imagen) }}" />
                                            <figcaption>
                                                <p>{{ $category->description }}</p>
                                            </figcaption>
                                        </figure>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section class="container mt-14 mb-16">
            <div>
                <h5 class="title-page mb-16">Productos</h5>
            </div>
            <div class="custom-tabs">
                <div class="custom-tabs__scroll-wrapper">
                    <button class="custom-tabs__arrow left" aria-label="Scroll left">
                        <i class="ri-arrow-left-s-line"></i>
                    </button>

                    <div class="custom-tabs__buttons">
                        <!-- Puedes tener hasta 20+ tabs aquí -->
                        <button class="custom-tabs__btn active" data-tab="tab1"
                            data-filter_category_name="favorite">Favoritos</button>
                        @foreach ($categories as $category)
                            <button class="custom-tabs__btn" data-filter_category_id="{{ $category->id }}"
                                data-filter_category_name="category" data-tab="tab1">
                                {{ $category->description }}
                            </button>
                        @endforeach
                        <!-- Agrega más tabs según necesites -->
                    </div>

                    <button class="custom-tabs__arrow right" aria-label="Scroll right">
                        <i class="ri-arrow-right-s-line"></i>
                    </button>
                </div>

                <!-- contenido como siempre -->
                <div class="custom-tabs__content active" id="tab1">
                    <div class="contenedor-productos-custom" id="cardGridView">
                        @include('webpage.components.products', ['products' => $products])
                    </div>
                    @if (!$products)
                        <div class="estado-vacio-productos-custom">
                            <i class="ri-box-3-line"></i>
                            <h2>No hay productos disponibles</h2>
                            <p>Intenta cambiar los filtros o vuelve más tarde.</p>
                        </div>
                    @endif
                </div>
                @foreach ($categories as $category)
                    <div class="custom-tabs__content" id="{{ $category->description . '-' . $category->id }}">
                        {{ $category->description }}
                    </div>
                @endforeach
            </div>
        </section>

        <section class="container mt-14 mb-16">
            <div>
                <h5 class="title-page mb-16">Ofertas</h5>
            </div>
            <div class="splide splide_offers" id="splideOffers">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($promotions as $promotion)
                            <li class="splide__slide">
                                <img src="{{ asset('storage/uploads/' . $promotion->image_name) }}" />
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

        <section class="container mt-14 mb-16 py-10">
            <div>
                <h5 class="title-page mb-16">Marcas</h5>
            </div>
            <div class="splide splide_brands" id="splideBrands">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($brands as $brand)
                            <li class="splide__slide">
                                <img src="{{ asset('storage/uploads/' . $brand->imagen) }}" />
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="{{ URL::to('assets/js/custom/webpage/products.js') }}"></script>
    <script src="{{ URL::to('assets/libs/splide/dist/js/splide.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/home.js') }}"></script>
@endsection
