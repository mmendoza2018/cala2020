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
                                    class="underline transition-all duration-200 ease-linear hover:text-custom-500">Limpiar
                                    Todo</a>
                            </div>
                        </div>
                        <hr style="margin: 1rem 0">
                        <div class="mt-4 collapsible">
                            <button class="flex items-center w-full text-left collapsible-header group">
                                <h6 class="underline grow">Marcas</h6>
                                <div class="shrink-0 text-slate-500 dark:text-zink-200">
                                    <i data-lucide="chevron-down" class="hidden size-4 group-[.show]:inline-block"></i>
                                    <i data-lucide="chevron-up" class="inline-block size-4 group-[.show]:hidden"></i>
                                </div>
                            </button>
                            <div class="mt-4 collapsible-content">
                                <div class="flex flex-col gap-2">
                                    @foreach ($brands as $brand)
                                        <label class="checkbox-container-custom">
                                            <input type="checkbox" class="checkbox-custom brand-checkbox" value="{{ $brand->id }}" id="mi-check-custom" />
                                            <span class="checkbox-wrapper-custom"></span>
                                            <span class="checkbox-label-custom">{{ $brand->description }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 collapsible">
                            <button class="flex items-center w-full text-left collapsible-header group">
                                <h6 class="underline grow">Categorias</h6>
                                <div class="shrink-0 text-slate-500 dark:text-zink-200">
                                    <i data-lucide="chevron-down" class="hidden size-4 group-[.show]:inline-block"></i>
                                    <i data-lucide="chevron-up" class="inline-block size-4 group-[.show]:hidden"></i>
                                </div>
                            </button>
                            <div class="mt-4 collapsible-content">
                                <div class="flex flex-col gap-2">
                                    @foreach ($categories as $category)
                                        <label class="checkbox-container-custom">
                                            <input type="checkbox" class="checkbox-custom category-checkbox" value="{{ $category->id }}" id="mi-check-custom" />
                                            <span class="checkbox-wrapper-custom"></span>
                                            <span class="checkbox-label-custom">{{ $category->description }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 collapsible">
                            <button class="flex items-center w-full text-left collapsible-header group">
                                <h6 class="underline grow">Sub-Categorias</h6>
                                <div class="shrink-0 text-slate-500 dark:text-zink-200">
                                    <i data-lucide="chevron-down" class="hidden size-4 group-[.show]:inline-block"></i>
                                    <i data-lucide="chevron-up" class="inline-block size-4 group-[.show]:hidden"></i>
                                </div>
                            </button>
                            <div class="mt-4 collapsible-content">
                                <div class="flex flex-col gap-2">
                                    @foreach ($subCategories as $subCategory)
                                        <label class="checkbox-container-custom">
                                            <input type="checkbox" class="checkbox-custom subcategory-checkbox" value="{{ $subCategory->id }}" id="mi-check-custom" />
                                            <span class="checkbox-wrapper-custom"></span>
                                            <span class="checkbox-label-custom">{{ $subCategory->description }}</span>
                                        </label>
                                    @endforeach
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
                            <input type="text" class="custom-dropdown__input" id="inputFiltersProduct" placeholder="Selecciona un filtro" readonly>
                            <ul class="custom-dropdown__list">
                                <li class="custom-dropdown__item" data-value="price_desc">Precio de mayor a menor</li>
                                <li class="custom-dropdown__item" data-value="price_asc">Precio de menor a mayor</li>
                                <li class="custom-dropdown__item" data-value="newest">Productos más nuevos</li>
                                <li class="custom-dropdown__item" data-value="oldest">Productos más antiguos</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="contenedor-productos-custom" id="cardGridView">
                    @include('webpage.components.products', ['products' => $products])
                </div>
                <div class="flex justify-center">
                    {{ $products->links('webpage.components.pagination') }}
                </div>

            </div><!--end col-->
        </div><!--end grid-->
    </div>
@endsection

@section('scripts')
    <script src="{{ URL::to('assets/js/custom/webpage/raffles.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/products.js') }}"></script>
@endsection
