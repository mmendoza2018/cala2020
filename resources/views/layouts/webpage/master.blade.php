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
    <link rel="stylesheet" type="text/css" href="{{ URL::to('assets/libs/animsition/css/animsition.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/starcode2.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/custom-style.css') }}">
    {{-- <link rel="stylesheet" href="{{ URL::to('assets/css/webpage/style.css') }}"> --}}
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
    data-base_url="{{ url('/') }}">
    <div id="loaderGlobal" class="section_loader bg-body-bg dark:bg-zink-800 ">
        <div class="loader">
            <div class="loader_1"></div>
            <div class="loader_2"></div>
        </div>
    </div>

    <!-- NAV BAR -->

    <nav class="navbar-custom" id="navbar">
        <div class="navbar-container container">
            <div class="navbar-column navbar-logo">
                <img src="{{ asset('storage/uploads/' . getCompanyCode() . '/' . $generalInfo->logo) }}" alt="Logo">
            </div>
            <div class="navbar-column navbar-links">
                <a href="{{ route('webpage.home') }}" class="effect-link-nav">Inicio</a>
                <a href="{{ route('webpage.store') }}" class="effect-link-nav">Catalogo</a>
                <a href="{{ route('webpage.categories') }}" class="effect-link-nav">Categorias</a>
                <a href="#" class="effect-link-nav">Sub categorias</a>
            </div>
            <div class="navbar-column navbar-actions">

                <div action="#!" class="relative aos-init aos-animate hidden md:block" data-aos="fade-left">
                    <input type="email" id="subscribeInput"
                        class="py-3 ltr:pr-40 rtl:pl-40 bg-slate-100 dark:bg-zinc-800/40 form-input color_primary_global_pageborder dark:border-zinc-800 focus:outline-none border_secondary_global_page backdrop-blur-md"
                        autocomplete="off" placeholder="Busca un producto" required="">
                    <button type="submit"
                        class="absolute px-6 py-2 text-base transition-all duration-200 ease-linear border-0 ltr:right-1 rtl:left-1 text-custom-50 btn top-1 bottom-1 from-custom-500 hover:text-white hover:from-purple-500 hover:to-custom-500"><i
                            class="ri-arrow-right-line color_primary_global_page"></i></button>
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
                        class="absolute flex items-center justify-center w-[16px] h-[16px] text-xs text-white bg-red-400 border-white rounded-full -top-1 -right-1">3</span>
                </button>
                <button class="navbar-toggle" onclick="toggleMenuCustom()">☰</button>
            </div>
        </div>

        <div id="navbar-dropdown" class="navbar-dropdown">
            <a href="{{ route('webpage.home') }}" class="effect-link-nav">Inicio</a>
            <a href="{{ route('webpage.store') }}" class="effect-link-nav">Catalogo</a>
            <a href="{{ route('webpage.categories') }}" class="effect-link-nav">Categorias</a>
            <a href="#" class="effect-link-nav">Sub categorias</a>
        </div>

    </nav>


    <!-- END NAV BAR -->

    <div id="cartSidePenal" drawer-end=""
        class="fixed inset-y-0 flex flex-col w-full transition-transform duration-300 ease-in-out transform bg-white shadow dark:bg-zink-600 ltr:right-0 rtl:left-0 md:w-96 z-drawer show hidden">
        <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
            <div class="grow">
                <h5 class="mb-0 text-16">Shopping Cart <span
                        class="inline-flex items-center justify-center w-5 h-5 ml-1 text-[11px] font-medium border rounded-full text-white bg-custom-500 border-custom-500 "
                        id="numProductsShoppingCart">3</span>
                </h5>
            </div>
            <div class="shrink-0">
                <button data-drawer-close="cartSidePenal"
                    class="transition-all duration-150 ease-linear text-slate-500 hover:text-slate-800"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" data-lucide="x" class="lucide lucide-x size-4">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg></button>
            </div>
        </div>
        <div class="px-4 py-3 text-sm text-green-500 border border-transparent bg-green-50 dark:bg-green-400/20">
            <span class="font-bold underline">starcode50</span> Coupon code applied successfully.
        </div>
        <div>
            <div class="h-[calc(100vh_-_370px)] p-4 overflow-y-auto product-list">
                <div class="flex flex-col gap-4" id="containerShoppingCartModal">


                </div>
            </div>
            <div class="p-4 border-t border-slate-200 dark:border-zink-500" id="detailsContainerShoppingCartModal">

                <table class="w-full mb-3 ">
                    <tbody class="table-total">
                        <tr>
                            <td class="py-2">Sub Total :</td>
                            <td class="text-right cart-subtotal totalShoppingCartModal">$2,847.55</td>
                        </tr>
                        <tr>
                            <td class="py-2">Discount <span class="text-muted">(starcode50)</span>:</td>
                            <td class="text-right cart-discount">-$476.00</td>
                        </tr>
                        <tr>
                            <td class="py-2">Shipping Charge :</td>
                            <td class="text-right cart-shipping">$89.00</td>
                        </tr>
                        <tr>
                            <td class="py-2">Estimated Tax (12.5%) : </td>
                            <td class="text-right cart-tax">$70.62</td>
                        </tr>
                        <tr class="font-semibold">
                            <td class="py-2">Total : </td>
                            <td class="text-right cart-total">$2,531.17</td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex items-center justify-between gap-3">
                    <a href="apps-ecommerce-product-grid.html"
                        class="w-full text-white btn bg-slate-500 border-slate-500 hover:text-white hover:bg-slate-600 hover:border-slate-600 focus:text-white focus:bg-slate-600 focus:border-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:border-slate-600 active:ring active:ring-slate-100 dark:ring-slate-400/10">Continue
                        Shopping</a>
                    <a href="apps-ecommerce-checkout.html"
                        class="w-full text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20">Checkout</a>
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
                        class="transition-all duration-150 ease-linear text-slate-500 hover:text-red-500 removeBtnShoppingCartModal"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" data-lucide="x" class="lucide lucide-x size-4">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg></button>
                </div>
                <a href="#!" class="transition-all duration-200 ease-linear hover:text-custom-500">
                    <h6 class="mb-1 text-15 descriptionShoppingCartModal">Descripcion</h6>
                    <div class="attributesShoppingCartModal">

                    </div>
                </a>
                <div class="flex items-center mb-3">
                    <h5 class="text-base product-price priceShoppingCartModal"> $<span>155.32</span></h5>
                    {{-- <div class="font-normal rtl:mr-1 ltr:ml-1 text-slate-500 dark:text-zink-200">(Fashion)
                    </div> --}}
                </div>
                <div class="flex items-center justify-between gap-3">
                    <div class="inline-flex text-center input-step">
                        <button type="button"
                            class="border w-9 leading-[15px] minus bg-white ltr:rounded-l rtl:rounded-r transition-all duration-200 ease-linear border-slate-200 text-slate-500 minusBtnShoppingCartModal"><svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" data-lucide="minus"
                                class="lucide lucide-minus inline-block size-4">
                                <path d="M5 12h14"></path>
                            </svg></button>
                        <input type="number"
                            class="w-12 text-center h-9 border-y product-quantity focus:shadow-none  quantityShoppingCartModal"
                            value="2" min="0" max="100" readonly="">
                        <button type="button"
                            class="transition-all duration-200 ease-linear bg-white border ltr:rounded-r rtl:rounded-l w-9 h-9 border-slate-200 plus text-slate-500 plusBtnShoppingCartModal"><svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" data-lucide="plus"
                                class="lucide lucide-plus inline-block size-4">
                                <path d="M5 12h14"></path>
                                <path d="M12 5v14"></path>
                            </svg></button>
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
                    <a href="#">
                        <li>Inicio</li>
                    </a>
                    <a href="#">
                        <li>Catalogo</li>
                    </a>
                    <a href="#">
                        <li>Categorias</li>
                    </a>
                    <a href="#">
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
                <h3>Contact us</h3>
                <div class="border1"></div>
                <ul>
                    <li><i class="fa fa-map-marker" aria-hidden="true"></i>XYZ, abc</li>
                    <li><i class="fa fa-phone" aria-hidden="true"></i>123456789</li>
                    <li><i class="fa fa-envelope" aria-hidden="true"></i>xyz@gmail.com</li>
                </ul>

                <!--   for social links -->
                <div class="social-media">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-google-plus-square"></i></a>
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
            <div class="asesor">
                <div class="info">
                    <p class="nombre">Juan Pérez</p>
                    <p class="numero">📱 937351597</p>
                </div>
                <a href="https://wa.me/937351597" target="_blank" class="btn-contactar">Contactar</a>
            </div>
            <div class="asesor">
                <div class="info">
                    <p class="nombre">Carla Ruiz</p>
                    <p class="numero">📱 912345678</p>
                </div>
                <a href="https://wa.me/912345678" target="_blank" class="btn-contactar">Contactar</a>
            </div>
        </div>

    </div>

    <!-- Bottom custom Nav -->
    <div class="bottom-nav" id="mobileBottomNav">
        <a href="#" class="nav-item active">
            <i class="ri-home-5-line"></i>
            <span>Inicio</span>
        </a>
        <a href="#" class="nav-item">
            <i class="ri-store-3-fill"></i>
            <span>Catalogo</span>
        </a>
        <a href="#" class="nav-item">
            <i class="ri-shopping-cart-line"></i>
            <span>Carrito</span>
        </a>
        <a href="#" class="nav-item">
            <i class="ri-search-line"></i>
            <span>Buscar</span>
        </a>
        <a href="#" class="nav-item">
            <i class="ri-heart-line"></i>
            <span>Nosotros</span>
        </a>
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

    <!--sweet alert init js-->
    <script src="{{ URL::to('assets/js/pages/sweetalert.init.js') }}"></script>
    <script src="{{ URL::to('assets/js/app.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/routes.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/global.js') }}"></script>

    @yield('scripts')
</body>

</html>
