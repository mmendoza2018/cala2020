@extends('layouts.master')

@section('content')
    <!-- Page-content -->
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">General</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboards</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        General
                    </li>
                </ul>
            </div>
            <div class="card bg-white">
                <div class="card-body">
                    <div>
                        <ul
                            class="flex flex-wrap w-full text-sm font-medium text-center border-b border-slate-200 dark:border-zink-500 nav-tabs">
                            <li class="group active">
                                <a href="javascript:void(0);" data-tab-toggle="" data-target="homeIcon"
                                    class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border border-transparent group-[.active]:text-custom-500 group-[.active]:border-slate-200 dark:group-[.active]:border-zink-500 group-[.active]:border-b-white dark:group-[.active]:border-b-zink-700 hover:text-custom-500 active:text-custom-500 dark:hover:text-custom-500 dark:active:text-custom-500 -mb-[1px]">

                                    <i class="ri-home-5-line"></i>
                                    <span class="align-middle">General</span>
                                </a>
                            </li>
                            <li class="group">
                                <a href="javascript:void(0);" data-tab-toggle="" data-target="ProfileIcon"
                                    class="inline-block px-4 py-2 text-base transition-all duration-300 ease-linear rounded-t-md text-slate-500 dark:text-zink-200 border border-transparent group-[.active]:text-custom-500 group-[.active]:border-slate-200 dark:group-[.active]:border-zink-500 group-[.active]:border-b-white dark:group-[.active]:border-b-zink-700 hover:text-custom-500 active:text-custom-500 dark:hover:text-custom-500 dark:active:text-custom-500 -mb-[1px]">
                                    <i class="ri-settings-5-line"></i>
                                    <span class="align-middle">Tienda</span>
                                </a>
                            </li>
                        </ul>

                        <div class="mt-5 tab-content">
                            <div class="tab-pane block" id="homeIcon">
                                <div class="w-full md:w-3/4 mx-auto">
                                    <form id="formAddGeneralConfig">
                                        <div class="flex flex-col md:flex-row justify-center w-full gap-5">

                                            <div class="w-full md:w-2/4 mx-auto">
                                                <label class="inline-block mb-2 text-base font-medium">Razon social de la
                                                    tienda</label>
                                                <x-input type="text" name="business_name" id="business_name"
                                                    data-validate />

                                                <input type="hidden" name="id" id="id">

                                                <label class="inline-block mb-2 text-base font-medium">Correo
                                                    Electronico</label>
                                                <x-input type="text" name="email" id="email" data-validate />

                                                <label class="inline-block mb-2 text-base font-medium">RUC</label>
                                                <x-input type="text" name="ruc" id="ruc" data-validate />

                                                <label class="inline-block mb-2 text-base font-medium">Titulo de la
                                                    tienda</label>
                                                <x-input type="text" name="title" id="title" data-validate />

                                                <label class="inline-block mb-2 text-base font-medium">Dirección (en caso
                                                    no tener
                                                    dirección
                                                    fisica dejar vacio)</label>
                                                <x-input type="text" name="address" id="address" data-validate />

                                                <label class="inline-block mb-2 text-base font-medium">Descripción</label>
                                                <textarea
                                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                                    rows="3" name="description" id="description"></textarea>
                                            </div>

                                            <div class="w-full md:w-2/4 mx-auto">
                                                <label class="inline-block mb-2 text-base font-medium">Logo</label>

                                                <div class="dropzone-container">
                                                    <div class="dropzoneAdd">
                                                        Arrastra tus imágenes aquí.
                                                    </div>
                                                    <div id="dropzone-preview" class="dropzone-previews"></div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="text-right">
                                            <x-button type="submit" color="primary" class="mt-3" description="Guardar"
                                                :outline="false" />
                                        </div>

                                    </form>
                                    </class=>
                                </div>
                            </div>
                            <div class="tab-pane hidden" id="ProfileIcon">
                                <div class="w-full md:w-1/4 mx-auto shadow p-5">
                                    <form id="formAddproductConfigGeneral">
                                        <div class="flex flex-col gap-2">
                                            <hr>
                                            <div class="flex items-center gap-2">
                                                <input id="checkboxDefault1"
                                                    class="border rounded-sm appearance-none cursor-pointer size-4 bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500 dark:checked:bg-custom-500 dark:checked:border-custom-500 checked:disabled:bg-custom-400 checked:disabled:border-custom-400"
                                                    type="checkbox" value="1" checked="" name="subcategory_is_active">
                                                <label for="checkboxDefault1" class="align-middle" data-tooltip="default"
                                                    data-tooltip-content="Al activar la opción SUBCATEGORIA tendras la funcionalidad de añadir SUBCATEGORIAS a tus productos en todos los apartados del catalogo">
                                                    Subcategoria habilitada
                                                </label>
                                            </div>

                                            <hr>

                                            <div class="flex items-center gap-2">
                                                <input id="checkboxDefault2"
                                                    class="border rounded-sm appearance-none cursor-pointer size-4 bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-custom-500 checked:border-custom-500 dark:checked:bg-custom-500 dark:checked:border-custom-500 checked:disabled:bg-custom-400 checked:disabled:border-custom-400"
                                                    type="checkbox" value="1" checked="" name="brand_is_active">
                                                <label for="checkboxDefault2" class="align-middle" data-tooltip="default"
                                                    data-tooltip-content="Al activar la opción MARCA tendras la funcionalidad de añadir MARCAS a tus productos en todos los apartados del catalogo">
                                                    Marca habilitada
                                                </label>
                                            </div>
                                            <hr>

                                            <x-button type="submit" color="primary" class="mt-3" description="Guardar"
                                                :outline="false" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!-- Template de Previsualización -->
        <script type="text/template" id="preview-template">
            <div class="dz-preview dz-file-preview">
                <div class="dz-image">
                    <img data-dz-thumbnail />
                </div>
                <div class="dz-details">
                    <div class="dz-filename"><span data-dz-name></span></div>
                    <div class="dz-size" data-dz-size></div>
                </div>

                <!--  <input type="checkbox" class="primary-image-checkbox" data-tooltip="default" data-tooltip-content="test tooltip"/> -->
                <i class="ri-close-line dz-remove-button"></i>
                    
            </div>
        </script>
    @endsection


    @section('script')
        <script src="{{ URL::to('assets/libs/dropzone/dropzone-min.js') }}"></script>
        <script src="{{ URL::to('assets/js/custom/general.js') }}"></script>
    @endsection
