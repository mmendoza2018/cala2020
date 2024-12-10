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
                    <div class="w-full md:w-2/4 mx-auto">
                        <form id="formAddproductGeneral">
                            <label class="inline-block mb-2 text-base font-medium">Razon social de la tienda</label>
                            <x-input type="text" name="description" data-validate />

                            <label class="inline-block mb-2 text-base font-medium">Correo Electronico</label>
                            <x-input type="text" name="description" data-validate />

                            <label class="inline-block mb-2 text-base font-medium">Titulo de la tienda</label>
                            <x-input type="text" name="description" data-validate />

                            <label class="inline-block mb-2 text-base font-medium">Dirección (en caso no tener dirección fisica dejar vacio)</label>
                            <x-input type="text" name="description" data-validate />


                            <hr>

                            

                            <div class="text-right">
                                <x-button type="submit" color="primary" class="mt-3" description="Guardar"
                                    :outline="false" />
                            </div>
                        </form>
                        </class=>
                    </div>
                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    @endsection

    @section('script')
        <script src="{{ URL::to('assets/js/datatables/jquery-3.7.0.js') }}"></script>
        <script src="{{ URL::to('assets/js/datatables/data-tables.min.js') }}"></script>
        <script src="{{ URL::to('assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>
        <script src="{{ URL::to('assets/js/custom/productBrand.js') }}"></script>
    @endsection
