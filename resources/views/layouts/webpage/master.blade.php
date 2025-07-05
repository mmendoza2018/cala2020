<!DOCTYPE html>
<html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg"
    data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>{{ $generalInfo->title . ' | ' . $generalInfo->description }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- Layout config Js -->
    <script src="{{ URL::to('assets/js/layout.js') }}"></script>
    <!-- StarCode CSS -->
    {{-- <link rel="stylesheet" type="text/css" href="{{ URL::to('assets/libs/animsition/css/animsition.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ URL::to('assets/css/starcode2.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/custom-style.css') }}">
    {{-- <link rel="stylesheet" href="{{ URL::to('assets/css/webpage/style.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ URL::to('assets/libs/select2/select2.min.css') }}">
    <!-- message toastr -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">
    <script src="{{ URL::to('assets/js/toastr_jquery.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('css')
</head>

<style>
    :root {
        --custom-primary-color: {{ $themes->primary_color ?? '#3498db' }};
        --custom-secondary-color: {{ $themes->secondary_color ?? '#2ecc71' }};
    }
</style>

<body
    class="text-base text-body font-public dark:text-zink-100 dark:bg-zink-800 group-data-[skin=bordered]:bg-body-bordered group-data-[skin=bordered]:dark:bg-zink-700"
    data-base_url="{{ url('/') }}" data-code_company="{{ getCompanyCode() }}">
    <div id="loaderGlobal" class="section_loader bg-body-bg dark:bg-zink-800 ">
        <div class="loader">
            <div class="loader_1"></div>
            <div class="loader_2"></div>
        </div>
    </div>
    @php
        $totalProductoSesion = 0;
        if (session()->has('shoppingCartProducts') && count(session('shoppingCartProducts')) > 0) {
            $totalProductoSesion = count(session('shoppingCartProducts'));
        }
    @endphp
    <!-- NAV BAR -->

    <nav class="navbar-custom" id="navbar">
        <div class="navbar-container container">
            <div class="navbar-column navbar-logo">
                <img src="{{ asset('storage/uploads/' . getCompanyCode() . '/' . $generalInfo->logo) }}"
                    alt="Logo">
            </div>
            <div class="navbar-column navbar-links">
                <a href="{{ route('webpage.home') }}" class="effect-link-nav">Inicio</a>
                <a href="{{ route('webpage.store') }}" class="effect-link-nav">Catalogo</a>
                <a href="{{ route('webpage.categories') }}" class="effect-link-nav">Categorias</a>
                <a href="{{ route('webpage.about') }}" class="effect-link-nav">Nosotros</a>
            </div>
            <div class="navbar-column navbar-actions">

                <div action="#!" class="relative aos-init aos-animate hidden md:block" data-aos="fade-left">
                    <div class="col-12 px-0 pos-relative">
                        <input type="text" class="form-control custom-form-search-products"
                            placeholder="Busca tu producto..."
                            oninput="searchProducts(this, 'containerSearchProducts')">
                        <div class="container-search-products" id="containerSearchProducts">
                            <div href="javascript:void(0);" class="d-flex p-2">
                                <div class="col-12 text-center">
                                    No se econtraron productos, vuelva a intentarlo
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" data-drawer-target="cartSidePenal"
                    class="inline-flex relative justify-center items-center p-0 text-topbar-item transition-all w-10 duration-200 ease-linear bg-topbar rounded-md btn hover:bg-topbar-item-bg-hover hover:text-topbar-item-hover hidden md:block"
                    style="height: auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" data-lucide="shopping-cart"
                        class="lucide lucide-shopping-cart inline-block w-6 h-6 stroke-1 fill-slate-100 group-data-[topbar=dark]:fill-topbar-item-bg-hover-dark group-data-[topbar=brand]:fill-topbar-item-bg-hover-brand">
                        <circle cx="8" cy="21" r="1"></circle>
                        <circle cx="19" cy="21" r="1"></circle>
                        <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12">
                        </path>
                    </svg>
                    <span
                        class="absolute flex items-center justify-center w-[16px] h-[16px] text-xs text-white bg-red-400 border-white rounded-full -top-1 -right-1 numProductsShoppingCart">
                        {{ $totalProductoSesion }}
                    </span>
                </button>
                <button class="navbar-toggle" onclick="toggleMenuCustom()">☰</button>
            </div>
        </div>

        <div id="navbar-dropdown" class="navbar-dropdown">
            <a href="{{ route('webpage.home') }}" class="effect-link-nav">Inicio</a>
            <a href="{{ route('webpage.store') }}" class="effect-link-nav">Catalogo</a>
            <a href="{{ route('webpage.categories') }}" class="effect-link-nav">Categorias</a>
            <a href="{{ route('webpage.about') }}" class="effect-link-nav">Nosotros</a>
        </div>

    </nav>
    <!-- END NAV BAR -->

    <div id="cartSidePenal" drawer-end=""
        class="fixed inset-y-0 flex flex-col w-full transition-transform duration-300 ease-in-out transform bg-white shadow dark:bg-zink-600 ltr:right-0 rtl:left-0 md:w-96 show hidden" style="z-index: 99999">
        <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
            <div class="grow">
                <h5 class="mb-0 text-16">Carrito de Compras<span
                        class="inline-flex items-center justify-center w-5 h-5 ml-1 text-[11px] font-medium border rounded-full text-white bg-custom-500 border-custom-500  numProductsShoppingCart"
                        id="numProductsShoppingCart">{{ $totalProductoSesion }}</span>
                </h5>
            </div>
            <div class="shrink-0">
                <button data-drawer-close="cartSidePenal"
                    class="transition-all duration-150 ease-linear text-slate-500 hover:text-slate-800">
                    <i class="ri-close-line" style="font-size: 20px"></i>
                </button>
            </div>
        </div>
        <div>
            <div class="h-[calc(100vh_-_370px)] p-4 overflow-y-auto product-list">
                <div class="flex flex-col gap-4" id="containerShoppingCartModal">

                    @php
                        $total = 0;
                    @endphp

                    @if (session()->has('shoppingCartProducts') && count(session('shoppingCartProducts')) > 0)
                        @foreach (session('shoppingCartProducts') as $product)
                            @php
                                $subtotal = $product['price'] * $product['quantity'];
                                $total += $subtotal;
                            @endphp

                            <div class="flex gap-2 product mb-4">
                                <!-- Imagen del producto -->
                                <div
                                    class="flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 shrink-0 dark:bg-zink-500">
                                    <img src="{{ asset('storage/uploads/' . getCompanyCode() . '/' . $product['image']) }}"
                                        class="imgShoppingCartModal h-8 object-cover">
                                </div>

                                <!-- Detalles del producto -->
                                <div class="overflow-hidden grow">
                                    <!-- Botón de eliminar -->
                                    <div class="ltr:float-right rtl:float-left">
                                        <button type="button"
                                            class="transition-all duration-150 ease-linear text-slate-500 hover:text-red-500 removeBtnShoppingCartModal"
                                            data-product_attribute_id="{{ $product['productAttribute'] }}"
                                            onclick="removeProductShoppingCart(this)">
                                            <i class="ri-close-line"></i>
                                        </button>
                                    </div>

                                    <!-- Título del producto -->
                                    <a href="{{ route('webpage.product', ['product' => $product['slug']]) }}"
                                        class="transition-all duration-200 ease-linear hover:text-custom-500">
                                        <h6 class="mb-1 text-15 descriptionShoppingCartModal">
                                            {{ $product['title'] . ' | ' . $product['brand'] }}
                                        </h6>
                                    </a>
                                    <!-- Atributos combinados -->
                                    <div
                                        class="attributesShoppingCartModal text-sm text-slate-500 dark:text-zink-300 mb-2">
                                        @foreach ($product['attributes_combination'] as $combinacion)
                                            <div>
                                                <strong>{{ $combinacion->attribute->attributeGroup->description }}:</strong>
                                                {{ $combinacion->attribute->description }}
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="flex items-center mb-2">
                                        <h5 class="text-base priceShoppingCartModal">
                                            $<span>{{ number_format($product['price'], 2) }}</span></h5>
                                    </div>

                                    <!-- Precio y cantidad -->
                                    <div class="flex items-center justify-between gap-3">
                                        <!-- Controles de cantidad -->
                                        <div
                                            class="inline-flex p-2 text-center border rounded input-step border-slate-200 dark:border-zink-500 containerMinusPlus">
                                            <button type="button"
                                                class="border w-7 leading-[15px] minusBtn minusBtnShoppingCartModal border_color_primary_global_page rounded transition-all duration-200 ease-linear"
                                                data-product_attribute_id="{{ $product['productAttribute'] }}"
                                                onclick="addRemoveProductToShoppingCart(this, 'minus')">
                                                <i class="ri-subtract-line"></i>
                                            </button>
                                            <input type="number"
                                                class="text-center ltr:pl-2 rtl:pr-2 w-15 h-7 inputMinusPlus product-quantity dark:bg-zink-700 focus:shadow-none quantityShoppingCartModal"
                                                value="{{ $product['quantity'] }}" min="0" max="500"
                                                readonly>
                                            <button type="button"
                                                class="transition-all plusBtnShoppingCartModal duration-200 ease-linear border rounded border_color_primary_global_page w-7 plusBtn"
                                                data-product_attribute_id="{{ $product['productAttribute'] }}"
                                                onclick="addRemoveProductToShoppingCart(this, 'plus')">
                                                <i class="ri-add-line"></i>
                                            </button>
                                        </div>

                                        <!-- Subtotal del producto -->
                                        <h6 class="product-line-price subtotalShoppingCartModal font-semibold text-sm">
                                            S/{{ number_format($subtotal, 2) }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div
                            class="p-10 text-sm border text-center rounded-md text-slate-500 border-slate-200 bg-slate-50 dark:bg-zink-500/30 dark:border-zink-500 dark:text-zink-200">
                            <span class="font-bold">Aún no se añadieron productos a la orden</span>
                        </div>
                    @endif


                </div>
            </div>
            <div class="p-4 border-t border-slate-200 dark:border-zink-500" id="detailsContainerShoppingCartModal">
                <table class="w-full mb-3 ">
                    <tbody class="table-total">
                        <tr class="font-semibold">
                            <td class="py-2">Total : </td>
                            <td class="text-right cart-total totalShoppingCartModal">S/{{ number_format($total, 2) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex items-center justify-between gap-3">
                    <a href="apps-ecommerce-product-grid.html"
                        class="w-full text-white btn bg-slate-500 border-slate-500 hover:text-white hover:bg-slate-600 hover:border-slate-600 focus:text-white focus:bg-slate-600 focus:border-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:border-slate-600 active:ring active:ring-slate-100 dark:ring-slate-400/10">Seguir
                        Comprando</a>
                    <a href="{{ route('web_page.checkoutProducts') }}"
                        class="text-white btn w-full bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">Finalizar
                        Compra</a>
                </div>
            </div>
        </div>
    </div>

    <template id="templateProductShoppingCartModal">
        <div class="flex gap-2 product">
            <div class="flex items-center justify-center w-12 h-12 rounded-md bg-slate-100 shrink-0 dark:bg-zink-500">
                <img src="" alt="" class="imgShoppingCartModal h-8">
            </div>
            <div class="overflow-hidden grow">
                <div class="ltr:float-right rtl:float-left">
                    <button
                        class="transition-all duration-150 ease-linear text-slate-500 hover:text-red-500 removeBtnShoppingCartModal"
                        onclick="removeProductShoppingCart(this)">
                        <i class="ri-close-line"></i>
                    </button>
                </div>

                <a href="#!" class="transition-all duration-200 ease-linear hover:text-custom-500">
                    <h6 class="mb-1 text-15 descriptionShoppingCartModal">Descripcion</h6>
                </a>

                <div class="attributesShoppingCartModal  text-sm text-slate-500 dark:text-zink-300 mb-2">
                </div>
                <div class="flex items-center mb-2">
                    <h5 class="text-base priceShoppingCartModal"> $<span>155.32</span></h5>
                </div>
                <div class="flex items-center justify-between gap-3">
                    <div
                        class="inline-flex p-2 text-center border rounded input-step border-slate-200 dark:border-zink-500 containerMinusPlus">
                        <button type="button"
                            class="border w-7 leading-[15px] minusBtn minus minusBtnShoppingCartModal border_color_primary_global_page rounded transition-all duration-200 ease-linear "
                            onclick="addRemoveProductToShoppingCart(this, 'minus')">
                            <i class="ri-subtract-line"></i>
                        </button>
                        <input type="number"
                            class="text-center ltr:pl-2 rtl:pr-2 w-15 h-7 inputMinusPlus product-quantity dark:bg-zink-700 focus:shadow-none quantityShoppingCartModal"
                            value="1" min="0" max="500" readonly="">
                        <button type="button"
                            class="transition-all plusBtnShoppingCartModal duration-200 ease-linear border rounded border_color_primary_global_page w-7 plus plusBtn"
                            onclick="addRemoveProductToShoppingCart(this, 'plus')">
                            <i class="ri-add-line"></i>
                        </button>
                    </div>
                    <h6 class="product-line-price subtotalShoppingCartModal">subTotal</h6>
                </div>
            </div>
        </div>
    </template>
    <!-- Page-content -->
    @yield('content')
    <!-- End Page-content -->

    <div class="footer">
        <div class="inner-footer">

            <!--  for company name and description -->
            {{--      <div class="footer-items">
                <h1>Company Name</h1>
                <p>Description of any product or motto of the company.</p>
            </div> --}}

            <!--  for quick links  -->
            <div class="footer-items">
                <h3>Páginas</h3>
                <div class="border1"></div> <!--for the underline -->
                <ul>
                    <a href="{{ route('webpage.home') }}">
                        <li>Inicio</li>
                    </a>
                    <a href="{{ route('webpage.store') }}">
                        <li>Catalogo</li>
                    </a>
                    <a href="{{ route('webpage.categories') }}">
                        <li>Categorias</li>
                    </a>
                    <a href="{{ route('webpage.about') }}">
                        <li>Nosotros</li>
                    </a>
                </ul>
            </div>

            <!--  for some other links -->
            <div class="footer-items">
                <h3>Legal</h3>
                <div class="border1"></div> <!--for the underline -->
                <ul>
                    <a href="#">
                        <li>Libro de reclamaciones</li>
                    </a>
                    <a href="#">
                        <li>terminos y condiciones</li>
                    </a>
                    <a href="#">
                        <li>Politicas de reembolso</li>
                    </a>
                </ul>
            </div>

            <!--  for contact us info -->
            <div class="footer-items">
                <h3>Contacto</h3>
                <div class="border1"></div>
                <ul>
                    <li><i class="ri-map-pin-line"></i> {{ $generalInfo->address }} </li>
                    <li><i class="ri-mail-unread-line"></i> {{ $generalInfo->email }}</li>
                </ul>

                <!--   for social links -->
                <div class="social-media">
                    @foreach ($socialNetworks as $social)
                        <a href="{{ $social->link }}">{!! $social->icon_html !!}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <hr>
        <!--   Footer Bottom start  -->
        <div class="footer-bottom">
            Derechos reservados &copy; MimeSoft 2020
        </div>
    </div>

    <div class="container-whatsapp">
        <a href="javascript:void(0);" id="btnWhatsappNumbers">
            <img src="{{ URL::to('assets/images/general/whatsapp.png') }}" class="img-whatsapp" alt="">
        </a>

        <span class="notificacion-whatsapp">1</span>

        <div class="message-whatsapp">
            !Hola, estamos para atenderte 😊!
        </div>

        <div class="box-whatsapp-agentes hidden_box">
            <strong>Comunicate con nuestros asesores:</strong>
            @foreach ($attentionNumbers as $number)
                <div class="asesor">
                    <div class="info">
                        <p class="nombre">{{ $number->name }}</p>
                        <p class="numero">📱 {{ $number->phone_number }}</p>
                    </div>
                    <a href="https://wa.me/{{ $number->phone_number }}" target="_blank"
                        class="btn-contactar">Contactar</a>
                </div>
            @endforeach
        </div>

    </div>

    <!-- Bottom custom Nav -->
    <div class="bottom-nav" id="mobileBottomNav">
        <a href="{{ route('webpage.home') }}" class="nav-item active">
            <i class="ri-home-5-line"></i>
            <span>Inicio</span>
        </a>
        <a href="{{ route('webpage.store') }}" class="nav-item">
            <i class="ri-store-3-fill"></i>
            <span>Catalogo</span>
        </a>
        <a href="#" class="nav-item" data-drawer-target="cartSidePenal">
            <i class="ri-shopping-cart-line"></i>
            <span>Carrito</span>
        </a>
        <a href="#" class="nav-item" data-modal-target="fullScreenModal">
            <i class="ri-search-line"></i>
            <span>Buscar</span>
        </a>
        <a href="{{ route('webpage.about') }}" class="nav-item">
            <i class="ri-heart-line"></i>
            <span>Nosotros</span>
        </a>
    </div>

    {{-- Modal search   --}}
    <div id="fullScreenModal" modal-center=""
        class="fixed inset-0 flex flex-col transition-all duration-300 ease-in-out z-drawer hidden">
        <div class="flex flex-col w-full h-full bg-white dark:bg-zink-600">
            <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
                <h5 class="text-16">¡Encuentras tus productos favoritos!</h5>
                <button data-modal-close="fullScreenModal"
                    class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" data-lucide="x" class="lucide lucide-x size-5">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg></button>
            </div>
            <div class="p-4">
                <div class="d-flex">
                    <div class="col-12 px-0 pos-relative">
                        <input type="text"
                            class="px-5 py-3 text-15 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-zink-700 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 "
                            placeholder="Digite el nombre de su producto..."
                            oninput="searchProducts(this, 'containerSearchProductsMobile')"
                            id="customFormSearchProductsMobile">
                        <div style="overflow: auto; height: 80vh; margin-top: .5rem"
                            id="containerSearchProductsMobile">
                            <div class="d-flex p-2">
                                <div class="col-12 text-center">
                                    No se econtraron productos, vuelva a intentarlo
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between p-4 mt-auto border-t border-slate-200 dark:border-zink-500">
                <h5 class="text-16">Modal Footer</h5>
            </div>
        </div>
    </div>


    <script src="{{ URL::to('assets/js/custom/loader.js') }}"></script>
    <script src="{{ URL::to('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ URL::to('assets/libs/%40popperjs/core/umd/popper.min.js') }}"></script>
    <script src="{{ URL::to('assets/libs/tippy.js/tippy-bundle.umd.min.js') }}"></script>
    <script src="{{ URL::to('assets/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::to('assets/libs/lucide/umd/lucide.js') }}"></script>
    <script src="{{ URL::to('assets/js/starcode.bundle.js') }}"></script>
    <script src="{{ URL::to('assets/libs/animsition/js/animsition.min.js') }}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{ URL::to('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
     <script src="{{ URL::to('assets/libs/select2/select2.min.js') }}"></script>

    <!--sweet alert init js-->
    <script src="{{ URL::to('assets/js/pages/sweetalert.init.js') }}"></script>
    <script src="{{ URL::to('assets/js/app.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/routes.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/global.js') }}"></script>

    @yield('scripts')
</body>

</html>
