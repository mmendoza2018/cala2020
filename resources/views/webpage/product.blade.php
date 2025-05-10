@extends('layouts.webpage.master')

@section('css')
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
        <section class="pt-120 pb-120 mt-50 n0-bg overflow-hidden" style="margin-top: 100px; background-color: #f9fafb">
            <div class="container">
                <div class="flex flex-col md:flex-row justify-center w-full gap-5">
                    <div class="w-full md:w-2/4 p-10">
                        <div class="w-full md:w-3/4" style="margin: auto">
                            <section id="main-carousel" class="splide splideProducts"
                                aria-label="The carousel with thumbnails. Selecting a thumbnail will change the Beautiful Gallery carousel.">
                                <div class="splide__track">
                                    <ul class="splide__list">
                                        @foreach ($product->productImages as $image)
                                            <li class="splide__slide">
                                                <img src="{{ asset('storage/uploads/' . $image->image_name) }}"
                                                    class="w-full">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </section>

                            <section id="thumbnail-carousel" class="splide mt-5"
                                aria-label="The carousel with thumbnails. Selecting a thumbnail will change the Beautiful Gallery carousel.">
                                <div class="splide__track">
                                    <ul class="splide__list">
                                        @foreach ($product->productImages as $image)
                                            <li class="splide__slide">
                                                <img src="{{ asset('storage/uploads/' . $image->image_name) }}">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="w-full md:w-2/4 p-10">
                        <h4 class="n1-clr mb-xxl-8 mb-xl-4 mb-5">
                            {{ $product->title }}
                        </h4>
                        @php
                            $defaultAttribute = $product->productAttributes->firstWhere('is_default', true);
                            $originalPrice = number_format($defaultAttribute->default_price, 2);
                            $incrementPrice = number_format($originalPrice * 1.2, 2); // 20% de descuento
                        @endphp

                        <div class="mb-4">
                            <p class="mb-1 text-green-500">Precio Especial</p>
                            <h4>
                                S/{{ $originalPrice }}
                                <small
                                    class="font-normal line-through align-middle text-slate-500 dark:text-zink-200">S/{{ $incrementPrice }}</small>
                            </h4>
                        </div>

                        <div class="description-body mb-xxl-8 mb-xl-4 mb-5 ck-content">
                            {!! $product->description !!}
                        </div>
                        <div data-product_id="{{ $product->id }}"></div>
                        <div data-default_product_attribute_id="{{ $defaultProductAttribute->id }}"></div>

                        <div class="flex flex-col md:flex-row justify-center w-full gap-5">

                            @php
                                $count = count($finalGroupedAttributes);
                            @endphp

                            @for ($i = 0; $i < $count; $i++)
                                <div class="w-full md:w-2/4">
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
                        <div class="d-flex gap-5 mt-5">
                            <div
                                class="inline-flex p-2 text-center border rounded input-step border-slate-200 dark:border-zink-500">
                                <button type="button"
                                    class="border w-7 leading-[15px] minusBtn border_color_primary_global_page rounded transition-all duration-200 ease-linear "><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" data-lucide="minus"
                                        class="lucide lucide-minus inline-block size-4 color_primary_global_page">
                                        <path d="M5 12h14"></path>
                                    </svg></button>
                                <input type="number"
                                    class="text-center ltr:pl-2 rtl:pr-2 w-15 h-7 product-quantity dark:bg-zink-700 focus:shadow-none"
                                    value="19" min="0" max="100" readonly="">
                                <button type="button"
                                    class="transition-all duration-200 ease-linear border rounded border_color_primary_global_page w-7 plusBtn "><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" data-lucide="plus"
                                        class="lucide lucide-plus inline-block size-4 color_primary_global_page">
                                        <path d="M5 12h14"></path>
                                        <path d="M12 5v14"></path>
                                    </svg></button>
                            </div>
                            <div class="inline-flex mr-5">
                                <button type="button" class="text-white bg_primary_global_page btn p-3">Agregar a Carrito</button>
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
    <script src="{{ URL::to('assets/js/custom/webpage/products.js') }}"></script>
@endsection
