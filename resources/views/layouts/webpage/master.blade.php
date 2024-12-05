<!DOCTYPE html>
<html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg"
    data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Ruleta biker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- Layout config Js -->
    <script src="{{ URL::to('assets/js/layout.js') }}"></script>
    <!-- StarCode CSS -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/starcode2.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/custom-style.css') }}">
    <!-- message toastr -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">
    <script src="{{ URL::to('assets/js/toastr_jquery.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="text-base bg-body-bg text-body font-public dark:text-zink-100 dark:bg-zink-800 group-data-[skin=bordered]:bg-body-bordered group-data-[skin=bordered]:dark:bg-zink-700">
    <div id="loaderGlobal" class="section_loader bg-body-bg dark:bg-zink-800 ">
        <div class="loader">
            <div class="loader_1"></div>
            <div class="loader_2"></div>
        </div>
    </div>

    <nav class="fixed inset-x-0 top-0 z-50 flex items-center justify-center h-20 py-3 [&amp;.is-sticky]:bg-white dark:[&amp;.is-sticky]:bg-zinc-900 border-b border-slate-200 dark:border-zinc-800 [&amp;.is-sticky]:shadow-lg [&amp;.is-sticky]:shadow-slate-200/25 dark:[&amp;.is-sticky]:shadow-zinc-700/30 navbar"
        id="navbar">
        <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto flex items-center self-center w-full">
            <div class="shrink-0">
                <a href="#!">
                    <img src="assets/images/logo-dark.png" alt="" class="block h-6 dark:hidden">
                    <img src="assets/images/logo-light.png" alt="" class="hidden h-6 dark:block">
                </a>
            </div>
            <div class="mx-auto">
                <ul id="navbar7"
                    class="absolute inset-x-0 z-20 items-center hidden py-3 mt-px bg-white shadow-lg md:mt-0 dark:bg-zinc-800 dark:md:bg-transparent md:z-0 navbar-menu rounded-b-md md:shadow-none md:flex top-full ltr:ml-auto rtl:mr-auto md:relative md:bg-transparent md:rounded-none md:top-auto md:py-0">
                    <li>
                        <a href="#home"
                            class="block md:inline-block px-4 md:px-3 py-2.5 md:py-0.5 text-15 font-medium text-slate-800 transition-all duration-300 ease-linear hover:text-custom-500 [&amp;.active]:text-custom-500 dark:text-zinc-200 dark:hover:text-custom-500 dark:[&amp;.active]:text-custom-500 active">Home</a>
                    </li>
                    <li>
                        <a href="#product"
                            class="block md:inline-block px-4 md:px-3 py-2.5 md:py-0.5 text-15 font-medium text-slate-800 transition-all duration-300 ease-linear hover:text-custom-500 [&amp;.active]:text-custom-500 dark:text-zinc-200 dark:hover:text-custom-500 dark:[&amp;.active]:text-custom-500">Our
                            Product</a>
                    </li>
                    <li>
                        <a href="#features"
                            class="block md:inline-block px-4 md:px-3 py-2.5 md:py-0.5 text-15 font-medium text-slate-800 transition-all duration-300 ease-linear hover:text-custom-500 [&amp;.active]:text-custom-500 dark:text-zinc-200 dark:hover:text-custom-500 dark:[&amp;.active]:text-custom-500">Features</a>
                    </li>
                    <li>
                        <a href="#about"
                            class="block md:inline-block px-4 md:px-3 py-2.5 md:py-0.5 text-15 font-medium text-slate-800 transition-all duration-300 ease-linear hover:text-custom-500 [&amp;.active]:text-custom-500 dark:text-zinc-200 dark:hover:text-custom-500 dark:[&amp;.active]:text-custom-500">About
                            Us</a>
                    </li>
                    <li>
                        <a href="#feedback"
                            class="block md:inline-block px-4 md:px-3 py-2.5 md:py-0.5 text-15 font-medium text-slate-800 transition-all duration-300 ease-linear hover:text-custom-500 [&amp;.active]:text-custom-500 dark:text-zinc-200 dark:hover:text-custom-500 dark:[&amp;.active]:text-custom-500">Feedback</a>
                    </li>
                </ul>
            </div>
            <div class="flex gap-2">
                <div class="ltr:ml-auto rtl:mr-auto md:hidden navbar-toggale-button">
                    <button type="button"
                        class="flex items-center  justify-center size-[37.5px] p-0 text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" data-lucide="menu" class="lucide lucide-menu">
                            <line x1="4" x2="20" y1="12" y2="12"></line>
                            <line x1="4" x2="20" y1="6" y2="6"></line>
                            <line x1="4" x2="20" y1="18" y2="18"></line>
                        </svg></button>
                </div>
                <button type="button"
                    class="text-slate-500 dark:text-zinc-300 hover:text-custom-500 dark:hover:text-custom-500 border-0 btn bg-gradient-to-r w-[36.39px] p-0 flex items-center justify-center"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" data-lucide="shopping-bag"
                        class="lucide lucide-shopping-bag inline-block size-4">
                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
                        <path d="M3 6h18"></path>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg></button>
                <button type="button"
                    class="text-white border-0 btn bg-gradient-to-r from-custom-500 to-purple-500 hover:text-white hover:from-purple-500 hover:to-custom-500"><span
                        class="align-middle">Sign In</span> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" data-lucide="log-in"
                        class="lucide lucide-log-in inline-block size-4 ltr:ml-1 rtl:mr-1">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                        <polyline points="10 17 15 12 10 7"></polyline>
                        <line x1="15" x2="3" y1="12" y2="12"></line>
                    </svg></button>
            </div>
        </div>
    </nav>

    <!-- Page-content -->
    @yield('content')
    <!-- End Page-content -->


    <script src="{{ URL::to('assets/js/custom/loader.js') }}"></script>
    <script src="{{ URL::to('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ URL::to('assets/libs/%40popperjs/core/umd/popper.min.js') }}"></script>
    <script src="{{ URL::to('assets/libs/tippy.js/tippy-bundle.umd.min.js') }}"></script>
    <script src="{{ URL::to('assets/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::to('assets/libs/lucide/umd/lucide.js') }}"></script>
    <script src="{{ URL::to('assets/js/starcode.bundle.js') }}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{ URL::to('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!--sweet alert init js-->
    <script src="{{ URL::to('assets/js/pages/sweetalert.init.js') }}"></script>
    <script src="{{ URL::to('assets/js/app.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/routes.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/global.js') }}"></script>

    @yield('script')
</body>

</html>
