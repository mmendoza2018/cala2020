<div class="row g-6">
    @if (count($products))
        @foreach ($products as $product)
            <div class="col-12 col-md-6 col-lg-4">
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
</div>

<div class="txt-right">
    {{ $products->links('webpage.components.pagination') }}
</div>
