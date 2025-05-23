    @if (count($products))
        @foreach ($products as $product)
            <div class="card md:group-[.gridView]:flex relative tarjeta-producto-custom">
                <div class="relative group-[.gridView]:static group-[.gridView]:p-5">
                    @if ($product->featured)
                        <a href="#!"
                            class="p-1 w-7 h-7 rounded-full bg-white absolute group/item toggle-button top-0 ltr:right-0 rtl:left-0 active border border_color_primary_global_page">
                            <i class="ri-heart-fill ri-lg color_primary_global_page" style="margin-top: 1px"></i>
                        </a>
                    @endif
                    <div
                        class="group-[.gridView]:p-3 group-[.gridView]:bg-slate-100 dark:group-[.gridView]:bg-zink-600 group-[.gridView]:inline-block rounded-md">
                        @foreach ($product->productImages as $image)
                            @if ($image->is_main)
                                <img src="{{ asset('storage/uploads/' . getCompanyCode() . '/' . $image->image_name) }}"
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
                            <a
                                href="{{ route('webpage.product', ['product' => $product->slug]) }}">{{ $product->title }}</a>
                        </h6>
                        @php
                            $defaultAttribute = $product->productAttributes->firstWhere('is_default', true);

                            $originalPrice = $defaultAttribute->default_price;
                            $incrementPrice = $originalPrice * 1.2; // 20% más
                        @endphp
                        <h5 class="mt-4 text-16">S/{{ number_format($originalPrice, 2) }}
                            <small
                                class="font-normal line-through text-slate-500 dark:text-zink-200">S/{{ number_format($incrementPrice, 2) }}</small>
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
        <div class="estado-vacio-productos-custom">
            <i class="ri-box-3-line"></i>
            <h2>No hay productos disponibles</h2>
            <p>Intenta cambiar los filtros o vuelve más tarde.</p>
        </div>
    @endif
