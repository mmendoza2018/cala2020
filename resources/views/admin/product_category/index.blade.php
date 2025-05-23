@extends('layouts.master')

@section('content')
    <!-- Page-content -->
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Categoria productos</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboards</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Categoria productos
                    </li>
                </ul>
            </div>
            <div class="card bg-white">
                <div class="card-body">
                    <div class="flex flex-wrap gap-2">
                        <button onclick="openModalAdd()" type="button"
                            class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20 mb-3">Registrar
                            Categoría</button>
                        <div id="modalAddCategoryProduct" modal-center=""
                            class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
                            <div
                                class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
                                <div
                                    class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
                                    <h5 class="text-16">Registro</h5>
                                    <button data-modal-close="modalAddCategoryProduct"
                                        class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500">
                                        <i data-lucide="x" class="size-5"></i>
                                    </button>
                                </div>
                                <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                                    <form id="formAddproductCategory">
                                        <label class="inline-block mb-2 text-base font-medium">descripcion</label>
                                        <x-input type="text" name="description" data-validate />

                                        <label class="inline-block mb-2 text-base font-medium">Código</label>
                                        <x-input type="text" name="code" data-validate />

                                        <div class="w-full mx-auto">
                                            <label class="inline-block mb-2 text-base font-medium">Imagen</label>
                                            <div id="dropzoneContainerAdd" class="dropzone-container">
                                                <div id="dropzoneAdd">
                                                    Arrastra tus imágenes aquí.
                                                </div>
                                                <div id="dropzonePreviewAdd" class="dropzone-previews"></div>
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <x-button type="submit" color="primary" class="mt-3" description="Guardar"
                                                :outline="false" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full md:w-2/4 mx-auto">
                        <table id="tableCategoryProduct" class="display stripe group" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Imagen</th>
                                    <th>Descripción</th>
                                    <th>Código</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr data-table={{ $category->id }}>
                                        <td>{{ $category->id }}</td>
                                        <td>
                                            <img src="{{ asset('storage/uploads/' . getCompanyCode() . '/' . $category->imagen) }}" alt=""
                                                class="h-10 h-16 rounded-md" style="width: 4rem">
                                        </td>
                                        <td>{{ $category->description }}</td>
                                        <td>{{ $category->code }}</td>
                                        <td class="text-center">
                                            <i class="ri-edit-box-fill ri-xl cursor-pointer"
                                                onclick="getProductCategory('{{ $category->id }}')"></i>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="modalActCategoryProduct" modal-center=""
            class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
            <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
                <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
                    <h5 class="text-16">Actualizar</h5>
                    <button data-modal-close="modalActCategoryProduct"
                        class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500"><i
                            data-lucide="x" class="size-5"></i></button>
                </div>
                <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                    <form id="formActproductCategory">
                        <label class="inline-block mb-2 text-base font-medium">descripcion</label>
                        <x-input type="text" name="description" id="description" data-validate />
                        <input type="hidden" name="id" id="id">

                        <label class="inline-block mb-2 text-base font-medium">Código</label>
                        <x-input type="text" name="code" id="code" data-validate />

                        <div class="w-full mx-auto">
                            <label class="inline-block mb-2 text-base font-medium">Imagen</label>
                            <div id="dropzoneContainerAct" class="dropzone-container">
                                <div id="dropzoneAct">
                                    Arrastra tus imágenes aquí.
                                </div>
                                <div id="dropzonePreviewAct" class="dropzone-previews"></div>
                            </div>
                        </div>

                        <label class="inline-block mb-2 text-base font-medium">Estado</label>
                        <x-select name="status" id="status">
                            <option selected disabled>Selecciona una opción</option>
                            <option value="1">Habilitado</option>
                            <option value="0">inhabilitar</option>
                        </x-select>

                        <div class="text-right">
                            <x-button type="submit" color="primary" class="mt-3" description="Guardar"
                                :outline="false" />
                        </div>
                    </form>
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
    <script src="{{ URL::to('assets/js/datatables/jquery-3.7.0.js') }}"></script>
    <script src="{{ URL::to('assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/productCategory.js') }}"></script>
@endsection
