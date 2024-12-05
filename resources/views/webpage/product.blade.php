@extends('layouts.webpage.master')
@section('headers')
    <link rel="stylesheet" href="{{ URL::to('assets/libs/splide/dist/css/splide.min.css') }}">
@endsection
@section('content')
    <style>
        .splide__slide img {
            width: 100%;
            height: auto;
            aspect-ratio: 1 / 1;
            object-fit: cover;
        }
    </style>
    <div>
        <section class="pt-120 pb-120 mt-50 n0-bg overflow-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 p-3">
                        <div class="col-12 col-lg-9">
                            <section id="main-carousel" class="splide splideProducts"
                                aria-label="The carousel with thumbnails. Selecting a thumbnail will change the Beautiful Gallery carousel.">
                                <div class="splide__track">
                                    <ul class="splide__list">
                                        @php
                                            $images = json_decode($product->images, true);
                                        @endphp

                                        @foreach ($images as $image)
                                            <li class="splide__slide">
                                                <img src="{{ asset('storage/uploads/' . $image['path']) }}"
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
                                        @php
                                            $images = json_decode($product->images, true);
                                        @endphp

                                        @foreach ($images as $image)
                                            <li class="splide__slide">
                                                <img src="{{ asset('storage/uploads/' . $image['path']) }}"
                                                    alt="{{ $image['description'] }}">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 p-3">

                        <h4 class="n1-clr mb-xxl-8 mb-xl-4 mb-5">
                            {{ $product->title . ' | ' . $product->productBrand->description }}
                        </h4>
                        @php
                            $defaultAttribute = $product->productAttributes->firstWhere('is_default', true);
                            $originalPrice = number_format($defaultAttribute->default_price, 2);
                            $incrementPrice = number_format($originalPrice * 1.2, 2); // 20% de descuento
                        @endphp
                        <div class="mb-xxl-8 mb-xl-4 mb-5">
                            <span class="aos-init aos-animate fw_800 n3-clr text-custom-discount" data-aos="zoom-in-left"
                                data-aos-duration="1000" id="incrementedPrice">S/{{ $incrementPrice }}</span>
                            <span class="act4-clr aos-init aos-animate display-seven fw_800 n4-clr" data-aos="zoom-in-left"
                                data-aos-duration="1000" id="originalPrice">S/{{ $originalPrice }}</span>
                        </div>

                        <div class="description-body mb-xxl-8 mb-xl-4 mb-5 ck-content">
                            {!! $product->description !!}
                        </div>
                        <div data-product_id="{{ $product->id }}"></div>
                        <div data-default_product_attribute_id="{{ $defaultProductAttribute->id }}"></div>

                        <div class="row">

                            @php
                                $count = count($finalGroupedAttributes);
                            @endphp

                            @for ($i = 0; $i < $count; $i++)
                                <div class="col-12 col-lg-6 mb-xxl-8 mb-xl-4 mb-5">
                                    <div class="form-group">
                                        <label
                                            for="attribute-{{ $i }}">{{ $finalGroupedAttributes[$i]['description'] }}</label>
                                        <select id="attribute-{{ $i }}" class="form-select attributesProduct">
                                            <option value="">Seleccionar
                                                {{ $finalGroupedAttributes[$i]['description'] }}</option>
                                            @foreach ($finalGroupedAttributes[$i]['attributes'] as $attribute)
                                                <option value="{{ $attribute['id'] }}"
                                                    @if (isset($defaultAttributes[$finalGroupedAttributes[$i]['description']]) &&
                                                            $defaultAttributes[$finalGroupedAttributes[$i]['description']] == $attribute['id']
                                                    ) selected @endif>
                                                    {{ $attribute['value'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endfor
                        </div>
                        <div class="d-flex gap-4">
                            <div class="quantity-basket d-inline">
                                <div>
                                    <p class="qty">
                                        <button class="qtyminus" aria-hidden="true">-</button>
                                        <input type="number" name="qty" id="quantityProductCombination" min="1"
                                            max="10" step="1" value="1" class="qtyInput">
                                        <button class="qtyplus" aria-hidden="true">+</button>
                                    </p>
                                </div>
                            </div>
                            <div class="d-inline">
                                <a href="javascript:void(0);" class="kewta-btn kewta-alt d-inline-flex align-items-center"
                                    onclick="addProductToShoppingCart()">
                                    <span class="kew-text s1-bg n0-clr">
                                        Agregar al carrito
                                    </span>
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </section>

    </div>
@endsection

@section('scripts')
    <script src="{{ URL::to('assets/libs/splide/dist/js/splide.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/raffles.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/products.js') }}"></script>
@endsection
