    @if (count($products))
        @foreach ($products as $product)
            {{-- <div class="col-12 col-md-6 col-lg-4">
                <div class="current-lottery-itemv9 cmn-cartborder position-relative radius24 n0-bg" style="height: 100%">
                    <div class="thumb cus-z1 position-relative">
                        <div class="thumb-in">
                            @php
                                $images = json_decode($product->images, true);
                                $image = $images[0];
                            @endphp
                            <img src="{{ asset('storage/uploads/' . $image['path']) }}" class="image-products"
                                alt="{{ $image['description'] }}">
                        </div>
                        <div class="current-hoberv9 d-center">
                            <a href="{{ route('webpage.product', ['product' => $product->slug]) }}"
                                class="kewta-btn kewta-alt d-inline-flex align-items-center">
                                <span class="kew-text w-100 text-capitalize fs-seven fw_500 n4-bg n0-clr">
                                    Ver detalles
                                </span>
                                <div class="kew-arrow n4-bg">
                                    <div class="kt-one">
                                        <i class="ti ti-arrow-right n0-clr"></i>
                                    </div>
                                    <div class="kt-two">
                                        <i class="ti ti-arrow-right n0-clr"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="content-middle">
                        <div
                            class="d-flex px-xxl-6 px-xl-5 px-lg-4 px-3 pt-xxl-2 pt-sm-2 pt-2 pb-xxl-3 pb-sm-3 pb-2 flex-wrap gap-3 align-items-center justify-content-between">
                            <h6>
                                @php
                                    $defaultAttribute = $product->productAttributes->firstWhere('is_default', true);

                                    $originalPrice = $defaultAttribute->default_price;
                                    $incrementPrice = $originalPrice * 1.2; // 20% más
                                @endphp
                                <a href="{{ route('webpage.product', ['product' => $product->slug]) }}"
                                    class="n4-clr fw_700">
                                    {{ $product->title . ' | ' . $product->productBrand->description }}
                                </a>
                            </h6>
                        </div>
                        <div
                            class="d-flex px-xxl-6 px-xl-5 px-lg-4 px-3 align-items-center justify-content-between pb-xxl-4 pb-3">
                            <div class="d-flex align-items-center gap-3 n4-clr">
                                <span class="pr fw_600 fs-eight text-custom-discount">S/{{ number_format($incrementPrice, 2) }}</span>
                                <span class="pr fw_700 fs-five">S/{{ number_format($originalPrice, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="card md:group-[.gridView]:flex relative">
                <div class="relative group-[.gridView]:static group-[.gridView]:p-5">
                    <a href="#!"
                        class="p-1 w-7 h-7 rounded-full bg-white absolute group/item toggle-button top-0 ltr:right-0 rtl:left-0 active border border_color_primary_global_page">
                        <i class="ri-heart-fill ri-lg color_primary_global_page" style="margin-top: 1px"></i>
                    </a>
                    <div
                        class="group-[.gridView]:p-3 group-[.gridView]:bg-slate-100 dark:group-[.gridView]:bg-zink-600 group-[.gridView]:inline-block rounded-md">
                        @foreach ($product->productImages as $image)
                            @if ($image->is_main)
                                <img src="{{ asset('storage/uploads/' . $image->image_name) }}"
                                    class="group-[.gridView]:h-16"
                                    style="aspect-ratio: 16/16; object-fit: cover; object-position: center">
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="card-body !pt-0 md:group-[.gridView]:flex group-[.gridView]:!p-5 group-[.gridView]:gap-3 group-[.gridView]:grow"
                    style="margin-top: 1rem">
                    <div class="group-[.gridView]:grow">
                        <h6 class="mb-1 truncate transition-all duration-200 ease-linear text-15 hover:text-custom-500">
                            <a href="{{ route('webpage.product', ['product' => $product->slug]) }}">{{ $product->title }}</a>
                        </h6>
                        @php
                            $defaultAttribute = $product->productAttributes->firstWhere('is_default', true);

                            $originalPrice = $defaultAttribute->default_price;
                            $incrementPrice = $originalPrice * 1.2; // 20% más
                        @endphp
                        <h5 class="mt-4 text-16">S/{{ number_format($originalPrice, 2) }}
                            <small class="font-normal line-through text-slate-500 dark:text-zink-200">S/{{ number_format($incrementPrice, 2) }}</small>
                        </h5>
                    </div>

                    <div class="flex items-center gap-2 mt-4 group-[.gridView]:mt-0 group-[.gridView]:self-end">
                        <button type="button"
                            class="w-full bg-white border-dashed color_primary_global_page btn border_color_primary_global_page">
                            <i data-lucide="shopping-cart" class="inline-block w-4 h-4 leading-none"></i>
                            <span class="align-middle color_primary_global_page">Agregar</span>
                        </button>
                        <div class="relative float-right dropdown">
                            <button
                                class="flex items-center border-dashed justify-center w-[38.39px] h-[38.39px] dropdown-toggle p-0 text-slate-500 btn focus:text-white active:ring border_color_whatsapp_global_page"
                                id="productList1" data-bs-toggle="dropdown">
                                <i class="ri-whatsapp-line ri-lg color_whatsapp_global_page"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="text-quote mt-xxl-10 mt-xl-8 mt-5 text-center cus-z1 fs-four fw_700 n1-clr position-relative py-xxl-10 py-xl-7 py-5 px-xxl-8 px-xl-7 px-5 aos-init aos-animate current-bg w-full"
            data-aos="zoom-in-left" data-aos-duration="1600">
            No hay Productos actualmente, intentelo más tarde!
            <span class="icon">
                <i class="ph ph-quotes act3-clr"></i>
            </span>
        </div>
    @endif

    <div class="txt-right">
        {{ $products->links('webpage.components.pagination') }}
    </div>
