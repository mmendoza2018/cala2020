@extends('layouts.webpage.master')

@section('content')
    <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto" style="margin-top: 100px; background-color: #f9fafb">
        <div>
            <h5 class="title-page mb-16">Nuestros Productos</h5>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-5 " style="padding-bottom: 3rem;">
            <div class="hidden lg:col-span-3 lg:block">
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center gap-3">
                            <h6 class="text-15 grow">Filtros</h6>
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
                                            <input type="checkbox" class="checkbox-custom brand-checkbox"
                                                value="{{ $brand->id }}" id="mi-check-custom" />
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
                                            <input type="checkbox" class="checkbox-custom category-checkbox"
                                                value="{{ $category->id }}" id="mi-check-custom" />
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
                                            <input type="checkbox" class="checkbox-custom subcategory-checkbox"
                                                value="{{ $subCategory->id }}" id="mi-check-custom" />
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
            <div class="block md:col-span-6 lg:hidden">
                <button type="button" data-drawer-target="drawerFilters"
                    class="bg-white text_primary_global_page btn border_primary_global_page mb-3">
                    Filtros de Busqueda
                </button>
            </div>
            <div class="lg:col-span-9">
                <div class="flex flex-wrap items-center gap-2" style="justify-content: end">
                    <div class="flex gap-2 shrink-0 items-center">
                        <div class="custom-dropdown">
                            <input type="text" class="custom-dropdown__input" id="inputFiltersProduct"
                                placeholder="Selecciona un filtro" readonly>
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
                    {{ $products->appends(request()->query())->links('webpage.components.pagination') }}
                </div>

            </div><!--end col-->
        </div><!--end grid-->
    </div>

    {{-- drawer --}}
    <div id="drawerFilters" drawer-end=""
        class="fixed inset-y-0 flex flex-col w-full transition-transform duration-300 ease-in-out transform bg-white shadow ltr:right-0 rtl:left-0 md:w-80 z-drawer dark:bg-zink-600 hidden">
        <div class="flex items-center justify-between p-4 border-b card-body border-slate-200 dark:border-zink-500">
            <button data-drawer-close="drawerFilters"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" data-lucide="x"
                    class="lucide lucide-x transition-all duration-200 ease-linear size-4 text-slate-500 hover:text-slate-700 dark:text-zink-200 dark:hover:text-zink-50">
                    <path d="M18 6 6 18"></path>
                    <path d="m6 6 12 12"></path>
                </svg></button>
        </div>
        <div class="h-full px-4 overflow-y-auto">
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center gap-3">
                            <h6 class="text-15 grow">Filtros</h6>
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
                                            <input type="checkbox" class="checkbox-custom brand-checkbox"
                                                value="{{ $brand->id }}" id="mi-check-custom" />
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
                                            <input type="checkbox" class="checkbox-custom category-checkbox"
                                                value="{{ $category->id }}" id="mi-check-custom" />
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
                                            <input type="checkbox" class="checkbox-custom subcategory-checkbox"
                                                value="{{ $subCategory->id }}" id="mi-check-custom" />
                                            <span class="checkbox-wrapper-custom"></span>
                                            <span class="checkbox-label-custom">{{ $subCategory->description }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ URL::to('assets/js/custom/webpage/products.js') }}"></script>
@endsection
