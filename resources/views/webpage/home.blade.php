@extends('layouts.webpage.master')

@section('css')
    <link rel="stylesheet" href="{{ URL::to('assets/css/webpage/home.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/libs/splide/dist/css/splide.min.css') }}">
@endsection

@section('content')
    <div>
        <section class="splide full-screen-carousel" id="splidePrincipalBanner" aria-label="Splide Basic HTML Example">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($banners as $banner)
                        <li class="splide__slide">
                            <img src="{{ asset('storage/uploads/' . $banner->image_name) }}" class="slide-img">
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        <section class="container mt-14 mb-16">
            <div>
                <h5 class="title-page mb-16">Categorias</h5>
                <div>
                    <div class="splide" id="splideCategories" aria-label="Splide Basic HTML Example">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach ($categories as $category)
                                    <li class="splide__slide">
                                        <figure class="effect-apollo">
                                            <img src="{{ asset('storage/uploads/' . $category->imagen) }}" />
                                            <figcaption>
                                                <p>{{ $category->description }}</p>
                                            </figcaption>
                                        </figure>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section class="container mt-14 mb-16">
            <div>
                <h5 class="title-page mb-16">Productos</h5>
            </div>
            <div class="custom-tabs">
                <div class="custom-tabs__scroll-wrapper">
                    <button class="custom-tabs__arrow left" aria-label="Scroll left">
                        <i class="ri-arrow-left-s-line"></i>
                    </button>

                    <div class="custom-tabs__buttons">
                        <!-- Puedes tener hasta 20+ tabs aquí -->
                        <button class="custom-tabs__btn active" data-tab="tab1">Overview</button>
                        <button class="custom-tabs__btn" data-tab="tab2">Details</button>
                        <button class="custom-tabs__btn" data-tab="tab3">Contact</button>
                        <!-- Agrega más tabs según necesites -->
                    </div>

                    <button class="custom-tabs__arrow right" aria-label="Scroll right">
                        <i class="ri-arrow-right-s-line"></i>
                    </button>
                </div>

                <!-- contenido como siempre -->
                <div class="custom-tabs__content active" id="tab1">
                    <div class="grid grid-cols-1 mt-5 md:grid-cols-2 [&.gridView]:grid-cols-1 xl:grid-cols-4 group [&.gridView]:xl:grid-cols-1 gap-x-5"
                        id="cardGridView">
                        <div class="card md:group-[.gridView]:flex relative">
                            <div class="relative group-[.gridView]:static p-8 group-[.gridView]:p-5">
                                <a href="#!"
                                    class="absolute group/item toggle-button top-6 ltr:right-6 rtl:left-6 active"><i
                                        data-lucide="heart"
                                        class="size-5 text-slate-400 fill-slate-200 transition-all duration-150 ease-linear dark:text-zink-200 dark:fill-zink-600 group-[.active]/item:text-red-500 dark:group-[.active]/item:text-red-500 group-[.active]/item:fill-red-200 dark:group-[.active]/item:fill-red-500/20 group-hover/item:text-red-500 dark:group-hover/item:text-red-500 group-hover/item:fill-red-200 dark:group-hover/item:fill-red-500/20"></i></a>
                                <div
                                    class="group-[.gridView]:p-3 group-[.gridView]:bg-slate-100 dark:group-[.gridView]:bg-zink-600 group-[.gridView]:inline-block rounded-md">
                                    <img src="assets/images/img-02.png" alt="" class="group-[.gridView]:h-16">
                                </div>
                            </div>
                            <div
                                class="card-body !pt-0 md:group-[.gridView]:flex group-[.gridView]:!p-5 group-[.gridView]:gap-3 group-[.gridView]:grow">
                                <div class="group-[.gridView]:grow">
                                    <h6
                                        class="mb-1 truncate transition-all duration-200 ease-linear text-15 hover:text-custom-500">
                                        <a href="apps-ecommerce-product-overview.html">Mesh Ergonomic Black Chair</a>
                                    </h6>

                                    <div class="flex items-center text-slate-500 dark:text-zink-200">
                                        <div class="mr-1 text-yellow-500 shrink-0 text-15">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-half-line"></i>
                                        </div>
                                        (198)
                                    </div>
                                    <h5 class="mt-4 text-16">$674.12 <small
                                            class="font-normal line-through text-slate-500 dark:text-zink-200">784.99</small>
                                    </h5>
                                </div>

                                <div class="flex items-center gap-2 mt-4 group-[.gridView]:mt-0 group-[.gridView]:self-end">
                                    <button type="button"
                                        class="w-full bg-white border-dashed text-slate-500 btn border-slate-500 hover:text-slate-500 hover:bg-slate-50 hover:border-slate-600 focus:text-slate-600 focus:bg-slate-50 focus:border-slate-600 active:text-slate-600 active:bg-slate-50 active:border-slate-600 dark:bg-zink-700 dark:text-zink-200 dark:border-zink-400 dark:ring-zink-400/20 dark:hover:bg-zink-600 dark:hover:text-zink-100 dark:focus:bg-zink-600 dark:focus:text-zink-100 dark:active:bg-zink-600 dark:active:text-zink-100"><i
                                            data-lucide="shopping-cart" class="inline-block w-3 h-3 leading-none"></i> <span
                                            class="align-middle">Add to Cart</span></button>
                                    <div class="relative float-right dropdown">
                                        <button
                                            class="flex items-center justify-center w-[38.39px] h-[38.39px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20"
                                            id="productList1" data-bs-toggle="dropdown"><i data-lucide="more-horizontal"
                                                class="w-3 h-3"></i></button>
                                        <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600"
                                            aria-labelledby="productList1">
                                            <li>
                                                <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="apps-ecommerce-product-overview.html"><i data-lucide="eye"
                                                        class="inline-block w-3 h-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                        class="align-middle">Overview</span></a>
                                            </li>
                                            <li>
                                                <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="apps-ecommerce-product-create.html"><i data-lucide="file-edit"
                                                        class="inline-block w-3 h-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                        class="align-middle">Edit</span></a>
                                            </li>
                                            <li>
                                                <a data-modal-target="deleteModal"
                                                    class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="#!"><i data-lucide="trash-2"
                                                        class="inline-block w-3 h-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                        class="align-middle">Delete</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col & card-->
                        <div class="card md:group-[.gridView]:flex relative">
                            <div class="relative group-[.gridView]:static p-8 group-[.gridView]:p-5">
                                <a href="#!" class="absolute group/item toggle-button top-6 ltr:right-6 rtl:left-6"><i
                                        data-lucide="heart"
                                        class="size-5 text-slate-400 fill-slate-200 transition-all duration-150 ease-linear dark:text-zink-200 dark:fill-zink-600 group-[.active]/item:text-red-500 dark:group-[.active]/item:text-red-500 group-[.active]/item:fill-red-200 dark:group-[.active]/item:fill-red-500/20 group-hover/item:text-red-500 dark:group-hover/item:text-red-500 group-hover/item:fill-red-200 dark:group-hover/item:fill-red-500/20"></i></a>
                                <div
                                    class="group-[.gridView]:p-3 group-[.gridView]:bg-slate-100 dark:group-[.gridView]:bg-zink-600 group-[.gridView]:inline-block rounded-md">
                                    <img src="assets/images/img-03.png" alt="" class="group-[.gridView]:h-16">
                                </div>
                            </div>
                            <div
                                class="card-body !pt-0 md:group-[.gridView]:flex group-[.gridView]:!p-5 group-[.gridView]:gap-3 group-[.gridView]:grow">
                                <div class="group-[.gridView]:grow">
                                    <h6
                                        class="mb-1 truncate transition-all duration-200 ease-linear text-15 hover:text-custom-500">
                                        <a href="apps-ecommerce-product-overview.html">Fastcolors Typography Men</a>
                                    </h6>

                                    <div class="flex items-center text-slate-500 dark:text-zink-200">
                                        <div class="mr-1 text-yellow-500 shrink-0 text-15">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-half-line"></i>
                                        </div>
                                        (1,150)
                                    </div>
                                    <h5 class="mt-4 text-16">$341.99 <small
                                            class="font-normal line-through text-slate-500 dark:text-zink-200">784.99</small>
                                    </h5>
                                </div>

                                <div
                                    class="flex items-center gap-2 mt-4 group-[.gridView]:mt-0 group-[.gridView]:self-end">
                                    <button type="button"
                                        class="w-full bg-white border-dashed text-slate-500 btn border-slate-500 hover:text-slate-500 hover:bg-slate-50 hover:border-slate-600 focus:text-slate-600 focus:bg-slate-50 focus:border-slate-600 active:text-slate-600 active:bg-slate-50 active:border-slate-600 dark:bg-zink-700 dark:text-zink-200 dark:border-zink-400 dark:ring-zink-400/20 dark:hover:bg-zink-600 dark:hover:text-zink-100 dark:focus:bg-zink-600 dark:focus:text-zink-100 dark:active:bg-zink-600 dark:active:text-zink-100"><i
                                            data-lucide="shopping-cart" class="inline-block w-3 h-3 leading-none"></i>
                                        <span class="align-middle">Add to Cart</span></button>
                                    <div class="relative float-right dropdown">
                                        <button
                                            class="flex items-center justify-center w-[38.39px] h-[38.39px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20"
                                            id="productList2" data-bs-toggle="dropdown"><i data-lucide="more-horizontal"
                                                class="w-3 h-3"></i></button>
                                        <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600"
                                            aria-labelledby="productList2">
                                            <li>
                                                <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="apps-ecommerce-product-overview.html"><i data-lucide="eye"
                                                        class="inline-block w-3 h-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                        class="align-middle">Overview</span></a>
                                            </li>
                                            <li>
                                                <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="apps-ecommerce-product-create.html"><i data-lucide="file-edit"
                                                        class="inline-block w-3 h-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                        class="align-middle">Edit</span></a>
                                            </li>
                                            <li>
                                                <a data-modal-target="deleteModal"
                                                    class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="#!"><i data-lucide="trash-2"
                                                        class="inline-block w-3 h-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                        class="align-middle">Delete</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col & card-->
                        <div class="card md:group-[.gridView]:flex relative">
                            <div class="relative group-[.gridView]:static p-8 group-[.gridView]:p-5">
                                <a href="#!"
                                    class="absolute group/item toggle-button top-6 ltr:right-6 rtl:left-6"><i
                                        data-lucide="heart"
                                        class="size-5 text-slate-400 fill-slate-200 transition-all duration-150 ease-linear dark:text-zink-200 dark:fill-zink-600 group-[.active]/item:text-red-500 dark:group-[.active]/item:text-red-500 group-[.active]/item:fill-red-200 dark:group-[.active]/item:fill-red-500/20 group-hover/item:text-red-500 dark:group-hover/item:text-red-500 group-hover/item:fill-red-200 dark:group-hover/item:fill-red-500/20"></i></a>
                                <div
                                    class="group-[.gridView]:p-3 group-[.gridView]:bg-slate-100 dark:group-[.gridView]:bg-zink-600 group-[.gridView]:inline-block rounded-md">
                                    <img src="assets/images/img-04.png" alt="" class="group-[.gridView]:h-16">
                                </div>
                            </div>
                            <div
                                class="card-body !pt-0 md:group-[.gridView]:flex group-[.gridView]:!p-5 group-[.gridView]:gap-3 group-[.gridView]:grow">
                                <div class="group-[.gridView]:grow">
                                    <h6
                                        class="mb-1 truncate transition-all duration-200 ease-linear text-15 hover:text-custom-500">
                                        <a href="apps-ecommerce-product-overview.html">Mesh Ergonomic Green Chair</a>
                                    </h6>

                                    <div class="flex items-center text-slate-500 dark:text-zink-200">
                                        <div class="mr-1 text-yellow-500 shrink-0 text-15">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-half-line"></i>
                                            <i class="ri-star-line"></i>
                                        </div>
                                        (29)
                                    </div>
                                    <h5 class="mt-4 text-16">$362.21 <small
                                            class="font-normal line-through text-slate-500 dark:text-zink-200">599.99</small>
                                    </h5>
                                </div>

                                <div
                                    class="flex items-center gap-2 mt-4 group-[.gridView]:mt-0 group-[.gridView]:self-end">
                                    <button type="button"
                                        class="w-full bg-white border-dashed text-slate-500 btn border-slate-500 hover:text-slate-500 hover:bg-slate-50 hover:border-slate-600 focus:text-slate-600 focus:bg-slate-50 focus:border-slate-600 active:text-slate-600 active:bg-slate-50 active:border-slate-600 dark:bg-zink-700 dark:text-zink-200 dark:border-zink-400 dark:ring-zink-400/20 dark:hover:bg-zink-600 dark:hover:text-zink-100 dark:focus:bg-zink-600 dark:focus:text-zink-100 dark:active:bg-zink-600 dark:active:text-zink-100"><i
                                            data-lucide="shopping-cart" class="inline-block w-3 h-3 leading-none"></i>
                                        <span class="align-middle">Add to Cart</span></button>
                                    <div class="relative float-right dropdown">
                                        <button
                                            class="flex items-center justify-center w-[38.39px] h-[38.39px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20"
                                            id="productList3" data-bs-toggle="dropdown"><i data-lucide="more-horizontal"
                                                class="w-3 h-3"></i></button>
                                        <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600"
                                            aria-labelledby="productList3">
                                            <li>
                                                <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="apps-ecommerce-product-overview.html"><i data-lucide="eye"
                                                        class="inline-block w-3 h-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                        class="align-middle">Overview</span></a>
                                            </li>
                                            <li>
                                                <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="apps-ecommerce-product-create.html"><i data-lucide="file-edit"
                                                        class="inline-block w-3 h-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                        class="align-middle">Edit</span></a>
                                            </li>
                                            <li>
                                                <a data-modal-target="deleteModal"
                                                    class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="#!"><i data-lucide="trash-2"
                                                        class="inline-block w-3 h-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                        class="align-middle">Delete</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col & card-->
                        <div class="card md:group-[.gridView]:flex relative">
                            <div class="relative group-[.gridView]:static p-8 group-[.gridView]:p-5">
                                <a href="#!"
                                    class="absolute group/item toggle-button top-6 ltr:right-6 rtl:left-6 active"><i
                                        data-lucide="heart"
                                        class="size-5 text-slate-400 fill-slate-200 transition-all duration-150 ease-linear dark:text-zink-200 dark:fill-zink-600 group-[.active]/item:text-red-500 dark:group-[.active]/item:text-red-500 group-[.active]/item:fill-red-200 dark:group-[.active]/item:fill-red-500/20 group-hover/item:text-red-500 dark:group-hover/item:text-red-500 group-hover/item:fill-red-200 dark:group-hover/item:fill-red-500/20"></i></a>
                                <div
                                    class="group-[.gridView]:p-3 group-[.gridView]:bg-slate-100 dark:group-[.gridView]:bg-zink-600 group-[.gridView]:inline-block rounded-md">
                                    <img src="assets/images/img-05.png" alt="" class="group-[.gridView]:h-16">
                                </div>
                            </div>
                            <div
                                class="card-body !pt-0 md:group-[.gridView]:flex group-[.gridView]:!p-5 group-[.gridView]:gap-3 group-[.gridView]:grow">
                                <div class="group-[.gridView]:grow">
                                    <h6
                                        class="mb-1 truncate transition-all duration-200 ease-linear text-15 hover:text-custom-500">
                                        <a href="apps-ecommerce-product-overview.html">Techel Black Bluetooth Soundbar</a>
                                    </h6>

                                    <div class="flex items-center text-slate-500 dark:text-zink-200">
                                        <div class="mr-1 text-yellow-500 shrink-0 text-15">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-half-line"></i>
                                        </div>
                                        (1,324)
                                    </div>
                                    <h5 class="mt-4 text-16">$249.99 <small
                                            class="font-normal line-through text-slate-500 dark:text-zink-200">399.99</small>
                                    </h5>
                                </div>

                                <div
                                    class="flex items-center gap-2 mt-4 group-[.gridView]:mt-0 group-[.gridView]:self-end">
                                    <button type="button"
                                        class="w-full bg-white border-dashed text-slate-500 btn border-slate-500 hover:text-slate-500 hover:bg-slate-50 hover:border-slate-600 focus:text-slate-600 focus:bg-slate-50 focus:border-slate-600 active:text-slate-600 active:bg-slate-50 active:border-slate-600 dark:bg-zink-700 dark:text-zink-200 dark:border-zink-400 dark:ring-zink-400/20 dark:hover:bg-zink-600 dark:hover:text-zink-100 dark:focus:bg-zink-600 dark:focus:text-zink-100 dark:active:bg-zink-600 dark:active:text-zink-100"><i
                                            data-lucide="shopping-cart" class="inline-block w-3 h-3 leading-none"></i>
                                        <span class="align-middle">Add to Cart</span></button>
                                    <div class="relative float-right dropdown">
                                        <button
                                            class="flex items-center justify-center w-[38.39px] h-[38.39px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20"
                                            id="productList4" data-bs-toggle="dropdown"><i data-lucide="more-horizontal"
                                                class="w-3 h-3"></i></button>
                                        <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600"
                                            aria-labelledby="productList4">
                                            <li>
                                                <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="apps-ecommerce-product-overview.html"><i data-lucide="eye"
                                                        class="inline-block w-3 h-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                        class="align-middle">Overview</span></a>
                                            </li>
                                            <li>
                                                <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="apps-ecommerce-product-create.html"><i data-lucide="file-edit"
                                                        class="inline-block w-3 h-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                        class="align-middle">Edit</span></a>
                                            </li>
                                            <li>
                                                <a data-modal-target="deleteModal"
                                                    class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="#!"><i data-lucide="trash-2"
                                                        class="inline-block w-3 h-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                        class="align-middle">Delete</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col & card-->
                        <div class="card md:group-[.gridView]:flex relative">
                            <div class="relative group-[.gridView]:static p-8 group-[.gridView]:p-5">
                                <a href="#!"
                                    class="absolute group/item toggle-button top-6 ltr:right-6 rtl:left-6"><i
                                        data-lucide="heart"
                                        class="size-5 text-slate-400 fill-slate-200 transition-all duration-150 ease-linear dark:text-zink-200 dark:fill-zink-600 group-[.active]/item:text-red-500 dark:group-[.active]/item:text-red-500 group-[.active]/item:fill-red-200 dark:group-[.active]/item:fill-red-500/20 group-hover/item:text-red-500 dark:group-hover/item:text-red-500 group-hover/item:fill-red-200 dark:group-hover/item:fill-red-500/20"></i></a>
                                <div
                                    class="group-[.gridView]:p-3 group-[.gridView]:bg-slate-100 dark:group-[.gridView]:bg-zink-600 group-[.gridView]:inline-block rounded-md">
                                    <img src="assets/images/img-06.png" alt="" class="group-[.gridView]:h-16">
                                </div>
                            </div>
                            <div
                                class="card-body !pt-0 md:group-[.gridView]:flex group-[.gridView]:!p-5 group-[.gridView]:gap-3 group-[.gridView]:grow">
                                <div class="group-[.gridView]:grow">
                                    <h6
                                        class="mb-1 truncate transition-all duration-200 ease-linear text-15 hover:text-custom-500">
                                        <a href="apps-ecommerce-product-overview.html">Bovet Fleurier AIFSQ029</a>
                                    </h6>

                                    <div class="flex items-center text-slate-500 dark:text-zink-200">
                                        <div class="mr-1 text-yellow-500 shrink-0 text-15">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-half-line"></i>
                                        </div>
                                        (2,195)
                                    </div>
                                    <h5 class="mt-4 text-16">$496.16</h5>
                                </div>

                                <div
                                    class="flex items-center gap-2 mt-4 group-[.gridView]:mt-0 group-[.gridView]:self-end">
                                    <button type="button"
                                        class="w-full bg-white border-dashed text-slate-500 btn border-slate-500 hover:text-slate-500 hover:bg-slate-50 hover:border-slate-600 focus:text-slate-600 focus:bg-slate-50 focus:border-slate-600 active:text-slate-600 active:bg-slate-50 active:border-slate-600 dark:bg-zink-700 dark:text-zink-200 dark:border-zink-400 dark:ring-zink-400/20 dark:hover:bg-zink-600 dark:hover:text-zink-100 dark:focus:bg-zink-600 dark:focus:text-zink-100 dark:active:bg-zink-600 dark:active:text-zink-100"><i
                                            data-lucide="shopping-cart" class="inline-block w-3 h-3 leading-none"></i>
                                        <span class="align-middle">Add to Cart</span></button>
                                    <div class="relative float-right dropdown">
                                        <button
                                            class="flex items-center justify-center w-[38.39px] h-[38.39px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20"
                                            id="productList5" data-bs-toggle="dropdown"><i data-lucide="more-horizontal"
                                                class="w-3 h-3"></i></button>
                                        <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600"
                                            aria-labelledby="productList5">
                                            <li>
                                                <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="apps-ecommerce-product-overview.html"><i data-lucide="eye"
                                                        class="inline-block w-3 h-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                        class="align-middle">Overview</span></a>
                                            </li>
                                            <li>
                                                <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="apps-ecommerce-product-create.html"><i data-lucide="file-edit"
                                                        class="inline-block w-3 h-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                        class="align-middle">Edit</span></a>
                                            </li>
                                            <li>
                                                <a data-modal-target="deleteModal"
                                                    class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="#!"><i data-lucide="trash-2"
                                                        class="inline-block w-3 h-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                        class="align-middle">Delete</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col & card-->
                        <div class="card md:group-[.gridView]:flex relative">
                            <div class="relative group-[.gridView]:static p-8 group-[.gridView]:p-5">
                                <a href="#!"
                                    class="absolute group/item toggle-button top-6 ltr:right-6 rtl:left-6 active"><i
                                        data-lucide="heart"
                                        class="size-5 text-slate-400 fill-slate-200 transition-all duration-150 ease-linear dark:text-zink-200 dark:fill-zink-600 group-[.active]/item:text-red-500 dark:group-[.active]/item:text-red-500 group-[.active]/item:fill-red-200 dark:group-[.active]/item:fill-red-500/20 group-hover/item:text-red-500 dark:group-hover/item:text-red-500 group-hover/item:fill-red-200 dark:group-hover/item:fill-red-500/20"></i></a>
                                <div
                                    class="group-[.gridView]:p-3 group-[.gridView]:bg-slate-100 dark:group-[.gridView]:bg-zink-600 group-[.gridView]:inline-block rounded-md">
                                    <img src="assets/images/img-08.png" alt="" class="group-[.gridView]:h-16">
                                </div>
                            </div>
                            <div
                                class="card-body !pt-0 md:group-[.gridView]:flex group-[.gridView]:!p-5 group-[.gridView]:gap-3 group-[.gridView]:grow">
                                <div class="group-[.gridView]:grow">
                                    <h6
                                        class="mb-1 truncate transition-all duration-200 ease-linear text-15 hover:text-custom-500">
                                        <a href="apps-ecommerce-product-overview.html">Roar Twill Blue Baseball Cap</a>
                                    </h6>

                                    <div class="flex items-center text-slate-500 dark:text-zink-200">
                                        <div class="mr-1 text-yellow-500 shrink-0 text-15">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-half-line"></i>
                                            <i class="ri-star-line"></i>
                                            <i class="ri-star-line"></i>
                                        </div>
                                        (485)
                                    </div>
                                    <h5 class="mt-4 text-16">$674.12 <small
                                            class="font-normal line-through text-slate-500 dark:text-zink-200">784.99</small>
                                    </h5>
                                </div>

                                <div
                                    class="flex items-center gap-2 mt-4 group-[.gridView]:mt-0 group-[.gridView]:self-end">
                                    <button type="button"
                                        class="w-full bg-white border-dashed text-slate-500 btn border-slate-500 hover:text-slate-500 hover:bg-slate-50 hover:border-slate-600 focus:text-slate-600 focus:bg-slate-50 focus:border-slate-600 active:text-slate-600 active:bg-slate-50 active:border-slate-600 dark:bg-zink-700 dark:text-zink-200 dark:border-zink-400 dark:ring-zink-400/20 dark:hover:bg-zink-600 dark:hover:text-zink-100 dark:focus:bg-zink-600 dark:focus:text-zink-100 dark:active:bg-zink-600 dark:active:text-zink-100"><i
                                            data-lucide="shopping-cart" class="inline-block w-3 h-3 leading-none"></i>
                                        <span class="align-middle">Add to Cart</span></button>
                                    <div class="relative float-right dropdown">
                                        <button
                                            class="flex items-center justify-center w-[38.39px] h-[38.39px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20"
                                            id="productList6" data-bs-toggle="dropdown"><i data-lucide="more-horizontal"
                                                class="w-3 h-3"></i></button>
                                        <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600"
                                            aria-labelledby="productList6">
                                            <li>
                                                <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="apps-ecommerce-product-overview.html"><i data-lucide="eye"
                                                        class="inline-block w-3 h-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                        class="align-middle">Overview</span></a>
                                            </li>
                                            <li>
                                                <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="apps-ecommerce-product-create.html"><i data-lucide="file-edit"
                                                        class="inline-block w-3 h-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                        class="align-middle">Edit</span></a>
                                            </li>
                                            <li>
                                                <a data-modal-target="deleteModal"
                                                    class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="#!"><i data-lucide="trash-2"
                                                        class="inline-block w-3 h-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                        class="align-middle">Delete</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col & card-->
                        <div class="card md:group-[.gridView]:flex relative">
                            <div class="relative group-[.gridView]:static p-8 group-[.gridView]:p-5">
                                <a href="#!"
                                    class="absolute group/item toggle-button top-6 ltr:right-6 rtl:left-6"><i
                                        data-lucide="heart"
                                        class="size-5 text-slate-400 fill-slate-200 transition-all duration-150 ease-linear dark:text-zink-200 dark:fill-zink-600 group-[.active]/item:text-red-500 dark:group-[.active]/item:text-red-500 group-[.active]/item:fill-red-200 dark:group-[.active]/item:fill-red-500/20 group-hover/item:text-red-500 dark:group-hover/item:text-red-500 group-hover/item:fill-red-200 dark:group-hover/item:fill-red-500/20"></i></a>
                                <div
                                    class="group-[.gridView]:p-3 group-[.gridView]:bg-slate-100 dark:group-[.gridView]:bg-zink-600 group-[.gridView]:inline-block rounded-md">
                                    <img src="assets/images/img-012.png" alt="" class="group-[.gridView]:h-16">
                                </div>
                            </div>
                            <div
                                class="card-body !pt-0 md:group-[.gridView]:flex group-[.gridView]:!p-5 group-[.gridView]:gap-3 group-[.gridView]:grow">
                                <div class="group-[.gridView]:grow">
                                    <h6
                                        class="mb-1 truncate transition-all duration-200 ease-linear text-15 hover:text-custom-500">
                                        <a href="apps-ecommerce-product-overview.html">Smartest Printed T-shirt</a>
                                    </h6>

                                    <div class="flex items-center text-slate-500 dark:text-zink-200">
                                        <div class="mr-1 text-yellow-500 shrink-0 text-15">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-half-line"></i>
                                            <i class="ri-star-line"></i>
                                        </div>
                                        (5,321)
                                    </div>
                                    <h5 class="mt-4 text-16">$89.99</h5>
                                </div>

                                <div
                                    class="flex items-center gap-2 mt-4 group-[.gridView]:mt-0 group-[.gridView]:self-end">
                                    <button type="button"
                                        class="w-full bg-white border-dashed text-slate-500 btn border-slate-500 hover:text-slate-500 hover:bg-slate-50 hover:border-slate-600 focus:text-slate-600 focus:bg-slate-50 focus:border-slate-600 active:text-slate-600 active:bg-slate-50 active:border-slate-600 dark:bg-zink-700 dark:text-zink-200 dark:border-zink-400 dark:ring-zink-400/20 dark:hover:bg-zink-600 dark:hover:text-zink-100 dark:focus:bg-zink-600 dark:focus:text-zink-100 dark:active:bg-zink-600 dark:active:text-zink-100"><i
                                            data-lucide="shopping-cart" class="inline-block w-3 h-3 leading-none"></i>
                                        <span class="align-middle">Add to Cart</span></button>
                                    <div class="relative float-right dropdown">
                                        <button
                                            class="flex items-center justify-center w-[38.39px] h-[38.39px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20"
                                            id="productList7" data-bs-toggle="dropdown"><i data-lucide="more-horizontal"
                                                class="w-3 h-3"></i></button>
                                        <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600"
                                            aria-labelledby="productList7">
                                            <li>
                                                <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="apps-ecommerce-product-overview.html"><i data-lucide="eye"
                                                        class="inline-block w-3 h-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                        class="align-middle">Overview</span></a>
                                            </li>
                                            <li>
                                                <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="apps-ecommerce-product-create.html"><i data-lucide="file-edit"
                                                        class="inline-block w-3 h-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                        class="align-middle">Edit</span></a>
                                            </li>
                                            <li>
                                                <a data-modal-target="deleteModal"
                                                    class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="#!"><i data-lucide="trash-2"
                                                        class="inline-block w-3 h-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                        class="align-middle">Delete</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col & card-->
                        <div class="card md:group-[.gridView]:flex relative">
                            <div class="relative group-[.gridView]:static p-8 group-[.gridView]:p-5">
                                <a href="#!"
                                    class="absolute group/item toggle-button top-6 ltr:right-6 rtl:left-6 active"><i
                                        data-lucide="heart"
                                        class="size-5 text-slate-400 fill-slate-200 transition-all duration-150 ease-linear dark:text-zink-200 dark:fill-zink-600 group-[.active]/item:text-red-500 dark:group-[.active]/item:text-red-500 group-[.active]/item:fill-red-200 dark:group-[.active]/item:fill-red-500/20 group-hover/item:text-red-500 dark:group-hover/item:text-red-500 group-hover/item:fill-red-200 dark:group-hover/item:fill-red-500/20"></i></a>
                                <div
                                    class="group-[.gridView]:p-3 group-[.gridView]:bg-slate-100 dark:group-[.gridView]:bg-zink-600 group-[.gridView]:inline-block rounded-md">
                                    <img src="assets/images/img-10.png" alt="" class="group-[.gridView]:h-16">
                                </div>
                            </div>
                            <div
                                class="card-body !pt-0 md:group-[.gridView]:flex group-[.gridView]:!p-5 group-[.gridView]:gap-3 group-[.gridView]:grow">
                                <div class="group-[.gridView]:grow">
                                    <h6
                                        class="mb-1 truncate transition-all duration-200 ease-linear text-15 hover:text-custom-500">
                                        <a href="apps-ecommerce-product-overview.html">Crop tops for Women western wear</a>
                                    </h6>

                                    <div class="flex items-center text-slate-500 dark:text-zink-200">
                                        <div class="mr-1 text-yellow-500 shrink-0 text-15">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-half-line"></i>
                                        </div>
                                        (1551)
                                    </div>
                                    <h5 class="mt-4 text-16">$145 <small
                                            class="font-normal line-through text-slate-500 dark:text-zink-200">299.99</small>
                                    </h5>
                                </div>

                                <div
                                    class="flex items-center gap-2 mt-4 group-[.gridView]:mt-0 group-[.gridView]:self-end">
                                    <button type="button"
                                        class="w-full bg-white border-dashed text-slate-500 btn border-slate-500 hover:text-slate-500 hover:bg-slate-50 hover:border-slate-600 focus:text-slate-600 focus:bg-slate-50 focus:border-slate-600 active:text-slate-600 active:bg-slate-50 active:border-slate-600 dark:bg-zink-700 dark:text-zink-200 dark:border-zink-400 dark:ring-zink-400/20 dark:hover:bg-zink-600 dark:hover:text-zink-100 dark:focus:bg-zink-600 dark:focus:text-zink-100 dark:active:bg-zink-600 dark:active:text-zink-100"><i
                                            data-lucide="shopping-cart" class="inline-block w-3 h-3 leading-none"></i>
                                        <span class="align-middle">Add to Cart</span></button>
                                    <div class="relative float-right dropdown">
                                        <button
                                            class="flex items-center justify-center w-[38.39px] h-[38.39px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20"
                                            id="productList8" data-bs-toggle="dropdown"><i data-lucide="more-horizontal"
                                                class="w-3 h-3"></i></button>
                                        <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600"
                                            aria-labelledby="productList8">
                                            <li>
                                                <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="apps-ecommerce-product-overview.html"><i data-lucide="eye"
                                                        class="inline-block w-3 h-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                        class="align-middle">Overview</span></a>
                                            </li>
                                            <li>
                                                <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="apps-ecommerce-product-create.html"><i data-lucide="file-edit"
                                                        class="inline-block w-3 h-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                        class="align-middle">Edit</span></a>
                                            </li>
                                            <li>
                                                <a data-modal-target="deleteModal"
                                                    class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                                    href="#!"><i data-lucide="trash-2"
                                                        class="inline-block w-3 h-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                        class="align-middle">Delete</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col & card-->
                    </div><!--end grid-->
                </div>
                <div class="custom-tabs__content" id="tab2">...</div>
                <div class="custom-tabs__content" id="tab3">...</div>
            </div>

        </section>
        <section class="container mt-14 mb-16">
            <div>
                <h5 class="title-page mb-16">Ofertas</h5>
            </div>
            <div class="splide splide_offers" id="splideOffers">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($promotions as $promotion)
                            <li class="splide__slide">
                                <img src="{{ asset('storage/uploads/' . $promotion->image_name) }}" />
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

        <section class="container mt-14 mb-16 py-10">
            <div>
                <h5 class="title-page mb-16">Marcas</h5>
            </div>
            <div class="splide splide_brands" id="splideBrands">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($brands as $brand)
                            <li class="splide__slide">
                                <img src="{{ asset('storage/uploads/' . $brand->imagen) }}" />
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="{{ URL::to('assets/libs/splide/dist/js/splide.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/home.js') }}"></script>
    {{-- <script src="{{ URL::to('assets/js/custom/webpage/products.js') }}"></script> --}}
@endsection
