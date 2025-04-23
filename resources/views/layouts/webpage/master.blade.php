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
    class="text-base text-body font-public dark:text-zink-100 dark:bg-zink-800 group-data-[skin=bordered]:bg-body-bordered group-data-[skin=bordered]:dark:bg-zink-700">
    <div id="loaderGlobal" class="section_loader bg-body-bg dark:bg-zink-800 ">
        <div class="loader">
            <div class="loader_1"></div>
            <div class="loader_2"></div>
        </div>
    </div>

    <nav class="fixed inset-x-0 top-0 z-50 flex items-center justify-center h-20 py-3 [&amp;.is-sticky]:bg-white dark:[&amp;.is-sticky]:bg-zinc-900 border-b border-slate-200 [&amp;.is-sticky]:shadow-lg [&amp;.is-sticky]:shadow-slate-200/25 navbar bg_primary_global_page"
        id="navbar">
        <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto flex items-center self-center w-full">
            <div class="shrink-0">
                <a href="#!">
                    <img src="{{ asset('storage/uploads/' . $generalInfo->logo) }}" alt=""
                        class="block h-10 dark:hidden">
                </a>
            </div>
            <div class="mx-auto">
                <ul id="navbar7"
                    class="absolute inset-x-0 z-20 items-center hidden py-3 mt-px bg-white shadow-lg md:mt-0 dark:bg-zinc-800 dark:md:bg-transparent md:z-0 navbar-menu rounded-b-md md:shadow-none md:flex top-full ltr:ml-auto rtl:mr-auto md:relative md:bg-transparent md:rounded-none md:top-auto md:py-0">
                    <li>
                        {{-- <form action="#!" class="relative aos-init aos-animate" data-aos="fade-left">
                            <input type="email" id="subscribeInput"
                                class="py-3 ltr:pr-40 rtl:pl-40 bg-slate-100 dark:bg-zinc-800/40 form-input color_primary_global_pageborder dark:border-zinc-800 focus:outline-none border_secondary_global_page backdrop-blur-md"
                                autocomplete="off" placeholder="Busca un producto" required="">
                            <button type="submit"
                                class="absolute px-6 py-2 text-base transition-all duration-200 ease-linear border-0 ltr:right-1 rtl:left-1 text-custom-50 btn top-1 bottom-1 from-custom-500 hover:text-white hover:from-purple-500 hover:to-custom-500"><i
                                    class="ri-arrow-right-line color_primary_global_page"></i></button>
                        </form> --}}
                    </li>
                    <li class="flex justify-center gap-5">
                        <a href="#" class="effect-link-nav">Categorias</a>
                        <a href="#" class="effect-link-nav">Marcas</a>
                        <a href="#" class="effect-link-nav">Nuestros Productos</a>
                    </li>
                </ul>
            </div>
            <div class="flex gap-2">
                <div class="ltr:ml-auto rtl:mr-auto md:hidden navbar-toggale-button">
                    <button type="button"
                        class="flex items-center  justify-center size-[37.5px] p-0 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"><i
                            class="ri-list-unordered"></i></button>
                </div>
                {{-- <button type="button"
                    class="text-white border-0 text-15 btn btn_whatsapp from-custom-500 to-purple-500 hover:text-white hover:from-purple-500 hover:to-custom-500">Contactanos
                    <i class="ri-whatsapp-line"></i></button> --}}
                <di action="#!" class="relative aos-init aos-animate" data-aos="fade-left">
                    <input type="email" id="subscribeInput"
                        class="py-3 ltr:pr-40 rtl:pl-40 bg-slate-100 dark:bg-zinc-800/40 form-input color_primary_global_pageborder dark:border-zinc-800 focus:outline-none border_secondary_global_page backdrop-blur-md"
                        autocomplete="off" placeholder="Busca un producto" required="">
                    <button type="submit"
                        class="absolute px-6 py-2 text-base transition-all duration-200 ease-linear border-0 ltr:right-1 rtl:left-1 text-custom-50 btn top-1 bottom-1 from-custom-500 hover:text-white hover:from-purple-500 hover:to-custom-500"><i
                            class="ri-arrow-right-line color_primary_global_page"></i></button>
                </di>
            </div>
        </div>
    </nav>

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
                <h3>Quick Links</h3>
                <div class="border1"></div> <!--for the underline -->
                <ul>
                    <a href="#">
                        <li>Home</li>
                    </a>
                    <a href="#">
                        <li>Search</li>
                    </a>
                    <a href="#">
                        <li>Contact</li>
                    </a>
                    <a href="#">
                        <li>About</li>
                    </a>
                </ul>
            </div>

            <!--  for some other links -->
            <div class="footer-items">
                <h3>Recipes</h3>
                <div class="border1"></div> <!--for the underline -->
                <ul>
                    <a href="#">
                        <li>Indian</li>
                    </a>
                    <a href="#">
                        <li>Chinese</li>
                    </a>
                    <a href="#">
                        <li>Mexican</li>
                    </a>
                    <a href="#">
                        <li>Italian</li>
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
