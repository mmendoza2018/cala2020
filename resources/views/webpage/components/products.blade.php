@if ($products)
    @foreach ($products as $product)
        <div class="product-card tarjeta-producto-custom">
            <div class="product-image-container">
                @if ($product->featured)
                    <a href="#!" class="favorite-button">
                        <i class="ri-heart-fill ri-lg"></i>
                    </a>
                @endif

                @foreach ($product->productImages as $image)
                    @if ($image->is_main)
                     <div class="imagen-wrapper">
                        <a href="{{ route('webpage.product', ['product' => $product->slug]) }}" style="text-decoration: none">
                            <img src="{{ asset('storage/uploads/' . getCompanyCode() . '/' . $image->image_name) }}"
                                class="product-image" />
                        </a>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="product-info">
                <h6 class="product-title">
                    <a href="{{ route('webpage.product', ['product' => $product->slug]) }}">
                        {{ $product->title }}
                    </a>
                </h6>

                @php
                    $defaultAttribute = $product->productAttributes->firstWhere('is_default', true);
                    $originalPrice = $defaultAttribute->default_price;
                    $incrementPrice = $originalPrice * 1.2;
                @endphp

                <h5 class="product-price">
                    S/{{ number_format($originalPrice, 2) }}
                    <small class="product-price-old">S/{{ number_format($incrementPrice, 2) }}</small>
                </h5>

                <div class="product-buttons">
                    <a href="{{ route('webpage.product', ['product' => $product->slug]) }}" class="add-to-cart">
                        <i data-lucide="shopping-cart"></i>
                        <span>Agregar</span>
                    </a>
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
