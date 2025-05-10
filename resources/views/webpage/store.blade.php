@extends('layouts.webpage.master')

@section('content')
    {{-- <div>
        <section class="current-lottery current-lotteryv9 winbg pt-120 pb-120 mt-50">
            <div class="container">
                <!--Section Header-->
                <div class="row g-xl-4 g-3 align-items-center justify-content-between mb-xxl-15 mb-xl-10 mb-8">
                    <div class="col-lg-6 col-md-8 col-sm-8">
                        <div class="section__title text-sm-start text-center mb-lg-0 mb-4">
                            <div class="subtitle-head mb-xxl-4 mb-sm-4 mb-3 d-flex flex-wrap align-items-center justify-content-sm-start justify-content-center gap-3"
                                data-aos="zoom-in-down" data-aos-duration="1200">
                                <img src="assets/images/global/section-icon.png" width="50px" alt="img">
                            </div>
                            <span class="display-four d-block n4-clr">
                                Nuestros <span class="act4-clr act4-underline" data-aos="zoom-in-left"
                                    data-aos-duration="1000">Productos </span>
                            </span>
                        </div>
                    </div>
                </div>
                <!--Section Header-->

                <div class="row justify-content-end mb-5 pb-5">
                    <div class="col-12 col-md-6 col-lg-3 p-2">
                        <div class="input-group">
                            <input type="text" class="form-control"
                                aria-label="Dollar amount (with dot and two decimal places)" id="searchInputQuery">
                            <span class="input-group-text" style="cursor: pointer" id="searchBtnQuery">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search"
                                    width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                    <path d="M21 21l-6 -6" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 p-2">
                        <select class="form-select" id="selectOrderQuery">
                            <option>Elige una opción</option>
                            <option value="price_desc">Precio de mayor a menor</option>
                            <option value="price_asc">Precio de menor a mayor</option>
                            <option value="newest">Productos más nuevos</option>
                            <option value="oldest">Productos más antiguos</option>
                        </select>
                    </div>
                </div>

                <!--win lottery body-->
                <div class="row g-10">
                    <div class="col-12 col-lg-3 bg-white p-4" data-aos="zoom-in" data-aos-duration="1000">

                        <div class="mb-4">
                            <h5 class="mb-2">CATEGORIAS</h5>
                            <div>
                                @foreach ($categories as $category)
                                    <a href="{{ route('webpage.products_category', $category->id) }}"
                                        class="nw2-bg fs-eight fw_600 n3-clr d-inline-block py-xxl-2 py-2 px-xxl-4 px-3 radius100 mb-2">
                                        {{ $category->description }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="mb-3">MARCAS</h5>
                            <div id="productBrandsQuery">
                                @foreach ($brands as $brand)
                                    <div class="ch-condition">
                                        <label class="checkbox-single">
                                            <input type="checkbox" value="{{ $brand->id }}" name="checkbox"
                                                class="d-none brand-checkbox">
                                            <span class="checkmark d-center"></span>
                                            <span class="fs-seven fw_600 title-item">{{ $brand->description }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-9" data-aos="zoom-in" data-aos-duration="1000" id="productList">
                        @include('webpage.components.products', ['products' => $products])
                    </div>
                    <!--win lottery body-->
                </div>
        </section>


    </div> --}}
    <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto" style="margin-top: 100px; background-color: #f9fafb">
        <div>
            <h5 class="title-page mb-16">Nuestros Productos</h5>
        </div>
        <div class="grid grid-cols-1 2xl:grid-cols-12 gap-x-5 ">
            <div class="hidden 2xl:col-span-3 2xl:block">
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center gap-3">
                            <h6 class="text-15 grow">Filtros</h6>
                            <div class="shrink-0">
                                <a href="#!"
                                    class="underline transition-all duration-200 ease-linear hover:text-custom-500">Limpiar Todo</a>
                            </div>
                        </div>

                        <div class="relative mt-4">
                            <input type="text"
                                class="ltr:pl-8 rtl:pr-8 search form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Buscar..." autocomplete="off">
                            <i data-lucide="search"
                                class="inline-block size-4 absolute ltr:left-2.5 rtl:right-2.5 top-2.5 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-600"></i>
                        </div>
                       
                        <div class="mt-4 collapsible">
                            <button class="flex items-center w-full text-left collapsible-header group">
                                <h6 class="underline grow">Product Category</h6>
                                <div class="shrink-0 text-slate-500 dark:text-zink-200">
                                    <i data-lucide="chevron-down" class="hidden size-4 group-[.show]:inline-block"></i>
                                    <i data-lucide="chevron-up" class="inline-block size-4 group-[.show]:hidden"></i>
                                </div>
                            </button>
                            <div class="mt-4 collapsible-content">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center gap-2">
                                        <input id="categoryAll"
                                            class="size-4 cursor-pointer bg-white border border-slate-200 checked:bg-none dark:bg-zink-700 dark:border-zink-500 rounded-sm appearance-none arrow-none relative after:absolute after:content-['\eb7b'] after:top-0 after:left-0 after:font-remix after:leading-none after:opacity-0 checked:after:opacity-100 after:text-custom-500 checked:border-custom-500 dark:after:text-custom-500 dark:checked:border-custom-800"
                                            type="checkbox" value="">
                                        <label for="categoryAll" class="align-middle cursor-pointer">
                                            All
                                        </label>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <input id="category1"
                                            class="size-4 cursor-pointer bg-white border border-slate-200 checked:bg-none dark:bg-zink-700 dark:border-zink-500 rounded-sm appearance-none arrow-none relative after:absolute after:content-['\eb7b'] after:top-0 after:left-0 after:font-remix after:leading-none after:opacity-0 checked:after:opacity-100 after:text-custom-500 checked:border-custom-500 dark:after:text-custom-500 dark:checked:border-custom-800"
                                            type="checkbox" value="">
                                        <label for="category1" class="align-middle cursor-pointer">
                                            Mobiles, Computers
                                        </label>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <input id="category2"
                                            class="size-4 cursor-pointer bg-white border border-slate-200 checked:bg-none dark:bg-zink-700 dark:border-zink-500 rounded-sm appearance-none arrow-none relative after:absolute after:content-['\eb7b'] after:top-0 after:left-0 after:font-remix after:leading-none after:opacity-0 checked:after:opacity-100 after:text-custom-500 checked:border-custom-500 dark:after:text-custom-500 dark:checked:border-custom-800"
                                            type="checkbox" value="">
                                        <label for="category2" class="align-middle cursor-pointer">
                                            TV, Appliances, Electronics
                                        </label>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <input id="category3"
                                            class="size-4 cursor-pointer bg-white border border-slate-200 checked:bg-none dark:bg-zink-700 dark:border-zink-500 rounded-sm appearance-none arrow-none relative after:absolute after:content-['\eb7b'] after:top-0 after:left-0 after:font-remix after:leading-none after:opacity-0 checked:after:opacity-100 after:text-custom-500 checked:border-custom-500 dark:after:text-custom-500 dark:checked:border-custom-800"
                                            type="checkbox" value="">
                                        <label for="category3" class="align-middle cursor-pointer">
                                            Men's Fashion
                                        </label>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <input id="category4"
                                            class="size-4 cursor-pointer bg-white border border-slate-200 checked:bg-none dark:bg-zink-700 dark:border-zink-500 rounded-sm appearance-none arrow-none relative after:absolute after:content-['\eb7b'] after:top-0 after:left-0 after:font-remix after:leading-none after:opacity-0 checked:after:opacity-100 after:text-custom-500 checked:border-custom-500 dark:after:text-custom-500 dark:checked:border-custom-800"
                                            type="checkbox" value="">
                                        <label for="category4" class="align-middle cursor-pointer">
                                            Women's Fashion
                                        </label>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <input id="category5"
                                            class="size-4 cursor-pointer bg-white border border-slate-200 checked:bg-none dark:bg-zink-700 dark:border-zink-500 rounded-sm appearance-none arrow-none relative after:absolute after:content-['\eb7b'] after:top-0 after:left-0 after:font-remix after:leading-none after:opacity-0 checked:after:opacity-100 after:text-custom-500 checked:border-custom-500 dark:after:text-custom-500 dark:checked:border-custom-800"
                                            type="checkbox" value="">
                                        <label for="category5" class="align-middle cursor-pointer">
                                            Home, Kitchen, Pets
                                        </label>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <input id="category6"
                                            class="size-4 cursor-pointer bg-white border border-slate-200 checked:bg-none dark:bg-zink-700 dark:border-zink-500 rounded-sm appearance-none arrow-none relative after:absolute after:content-['\eb7b'] after:top-0 after:left-0 after:font-remix after:leading-none after:opacity-0 checked:after:opacity-100 after:text-custom-500 checked:border-custom-500 dark:after:text-custom-500 dark:checked:border-custom-800"
                                            type="checkbox" value="">
                                        <label for="category6" class="align-middle cursor-pointer">
                                            Beauty, Health, Grocery
                                        </label>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <input id="category7"
                                            class="size-4 cursor-pointer bg-white border border-slate-200 checked:bg-none dark:bg-zink-700 dark:border-zink-500 rounded-sm appearance-none arrow-none relative after:absolute after:content-['\eb7b'] after:top-0 after:left-0 after:font-remix after:leading-none after:opacity-0 checked:after:opacity-100 after:text-custom-500 checked:border-custom-500 dark:after:text-custom-500 dark:checked:border-custom-800"
                                            type="checkbox" value="">
                                        <label for="category7" class="align-middle cursor-pointer">
                                            Books
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end col-->
            <div class="2xl:col-span-9">
                <div class="flex flex-wrap items-center gap-2" style="justify-content: end">
                    <div class="flex gap-2 shrink-0 items-cente">
                        <div class="custom-dropdown">
                            <input type="text" class="custom-dropdown__input" placeholder="Select option" readonly>
                            <ul class="custom-dropdown__list">
                              <li class="custom-dropdown__item">Option 1</li>
                              <li class="custom-dropdown__item">Option 2</li>
                              <li class="custom-dropdown__item">Option 3</li>
                              <li class="custom-dropdown__item">Option 4</li>
                            </ul>
                          </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-5 md:grid-cols-2 [&.gridView]:grid-cols-1 xl:grid-cols-4 group [&.gridView]:xl:grid-cols-1 gap-x-5"
                    id="cardGridView">
                    @include('webpage.components.products', ['products' => $products])
                </div>

                <div class="flex flex-col items-center mb-5 md:flex-row">
                    <div class="mb-4 grow md:mb-0">
                        <p class="text-slate-500 dark:text-zink-200">Showing <b>12</b> of <b>44</b> Results</p>
                    </div>
                    <ul class="flex flex-wrap items-center gap-2 shrink-0">
                        <li>
                            <a href="#!"
                                class="inline-flex items-center justify-center bg-white dark:bg-zink-700 h-8 px-3 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-100 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-white dark:[&.active]:text-white [&.active]:bg-custom-500 dark:[&.active]:bg-custom-500 [&.active]:border-custom-500 dark:[&.active]:border-custom-500 [&.active]:hover:text-custom-700 dark:[&.active]:hover:text-custom-700 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto"><i
                                    class="mr-1 size-4 rtl:rotate-180" data-lucide="chevron-left"></i> Prev</a>
                        </li>
                        <li>
                            <a href="#!"
                                class="inline-flex items-center justify-center bg-white dark:bg-zink-700 w-8 h-8 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-100 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-white dark:[&.active]:text-white [&.active]:bg-custom-500 dark:[&.active]:bg-custom-500 [&.active]:border-custom-500 dark:[&.active]:border-custom-500 [&.active]:hover:text-custom-700 dark:[&.active]:hover:text-custom-700 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto">1</a>
                        </li>
                        <li>
                            <a href="#!"
                                class="inline-flex items-center justify-center bg-white dark:bg-zink-700 w-8 h-8 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-100 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-white dark:[&.active]:text-white [&.active]:bg-custom-500 dark:[&.active]:bg-custom-500 [&.active]:border-custom-500 dark:[&.active]:border-custom-500 [&.active]:hover:text-custom-700 dark:[&.active]:hover:text-custom-700 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto active">2</a>
                        </li>
                        <li>
                            <a href="#!"
                                class="inline-flex items-center justify-center bg-white dark:bg-zink-700 w-8 h-8 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-100 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-white dark:[&.active]:text-white [&.active]:bg-custom-500 dark:[&.active]:bg-custom-500 [&.active]:border-custom-500 dark:[&.active]:border-custom-500 [&.active]:hover:text-custom-700 dark:[&.active]:hover:text-custom-700 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto">3</a>
                        </li>
                        <li>
                            <a href="#!"
                                class="inline-flex items-center justify-center bg-white dark:bg-zink-700 w-8 h-8 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-100 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-white dark:[&.active]:text-white [&.active]:bg-custom-500 dark:[&.active]:bg-custom-500 [&.active]:border-custom-500 dark:[&.active]:border-custom-500 [&.active]:hover:text-custom-700 dark:[&.active]:hover:text-custom-700 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto">4</a>
                        </li>
                        <li>
                            <a href="#!"
                                class="inline-flex items-center justify-center bg-white dark:bg-zink-700 w-8 h-8 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-100 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-white dark:[&.active]:text-white [&.active]:bg-custom-500 dark:[&.active]:bg-custom-500 [&.active]:border-custom-500 dark:[&.active]:border-custom-500 [&.active]:hover:text-custom-700 dark:[&.active]:hover:text-custom-700 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto">5</a>
                        </li>
                        <li>
                            <a href="#!"
                                class="inline-flex items-center justify-center bg-white dark:bg-zink-700 h-8 px-3 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-100 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-white dark:[&.active]:text-white [&.active]:bg-custom-500 dark:[&.active]:bg-custom-500 [&.active]:border-custom-500 dark:[&.active]:border-custom-500 [&.active]:hover:text-custom-700 dark:[&.active]:hover:text-custom-700 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto">Next
                                <i class="ml-1 size-4 rtl:rotate-180" data-lucide="chevron-right"></i></a>
                        </li>
                    </ul>
                </div>
            </div><!--end col-->
        </div><!--end grid-->
    </div>
@endsection

@section('scripts')
    <script src="{{ URL::to('assets/js/custom/webpage/raffles.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/products.js') }}"></script>
@endsection
