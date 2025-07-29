@extends('layouts.master')

@section('content')
    <!-- Page-content -->
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Ventas</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboards</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Ventas
                    </li>
                </ul>
            </div>

            <div class="flex flex-col md:flex-row justify-center w-full gap-5">
                <div class="w-full md:w-1/4">
                    <label class="inline-block text-base font-medium">Fecha inicio</label>
                    <x-input type="date" name="stock" placeholder="2" id="startDate" onchange="getDataforCharts()" />
                </div>
                <div class="w-full md:w-1/4">
                    <label class="inline-block text-base font-medium">Fecha fin</label>
                    <x-input type="date" name="stock" placeholder="2" id="endDate" onchange="getDataforCharts()" />
                </div>
                <div class="w-full md:w-2/4 mt-3">
                   {{--  <x-button type="submit" color="success" class="mt-3" description="Generar excel (Transacciones)"
                        onclick="exportEcommerceSaleTransaction()" :outline="false" />
                    <x-button type="submit" color="success" class="mt-3"
                        description="Generar excel (Productos & categorias)" onclick="exportEcommerceSaleByProduct()"
                        :outline="false" /> --}}
                </div>
            </div>

            <div id="graficos" class="grid grid-cols-1 md:grid-cols-3 gap-x-5 mt-5">

                <div class="card p-3">
                    <div class="text-center card-body">
                        <div
                            class="flex items-center justify-center mx-auto rounded-full size-14 bg-custom-100 text-custom-500 dark:bg-custom-500/20">
                            <i data-lucide="badge-dollar-sign"></i>
                        </div>
                        <h5 class="mt-4 mb-2"><span class="counter-value" data-target="" id="totalEcommerceSales"></span>
                        </h5>
                        <p class="text-slate-500 dark:text-zink-200">Monto total de productos vendidos</p>
                    </div>
                </div><!--end col-->

                {{-- <div class="card p-3">
                    <div class="text-center card-body">
                        <div
                            class="flex items-center justify-center mx-auto rounded-full size-14 bg-green-100 text-green-500 dark:bg-green-500/20">
                            <i data-lucide="badge-dollar-sign"></i>
                        </div>
                        <h5 class="mt-4 mb-2"><span class="counter-value" data-target=""
                                id="totalWithCulqiCommission">0</span>
                        </h5>
                        <p class="text-slate-500 dark:text-zink-200">Monto total de productos vendidos (con comisión izipay)
                        </p>
                    </div>
                </div> --}}

                <div class="card p-3">
                    <div class="text-center card-body">
                        <div
                            class="flex items-center justify-center mx-auto rounded-full size-14 bg-custom-100 text-custom-500 dark:bg-custom-500/20">
                            <i data-lucide="shopping-cart"></i>
                        </div>
                        <h5 class="mt-4 mb-2"><span class="counter-value" data-target="" id="quantityEcommerceSale">0</span>
                        </h5>
                        <p class="text-slate-500 dark:text-zink-200">Productos vendidos</p>
                    </div>
                </div><!--end col-->

            </div>

            {{-- <div class="w-full card mt-5">
                <div id="departmentsChart"></div>
            </div> --}}

            <div id="graficos" class="grid grid-cols-1 md:grid-cols-2 gap-x-5 mt-5">
                {{-- <div class="w-full card ">
                    <div id="agePercentilesChart"></div>
                </div> --}}

                <div class="w-full card p-3">
                    <table id="tableCategory" class="w-full">
                        <thead>
                            <tr>
                                <th>Categoría</th>
                                <th>Cantidad Vendida</th>
                                <th>Total Ventas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Los datos serán cargados dinámicamente -->
                        </tbody>
                    </table>
                </div>

                 <div class="w-full card p-3">
                    <table id="tableProduct" class="w-full">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad Vendida</th>
                                <th>Total Ventas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Los datos serán cargados dinámicamente -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!--end grid-->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
@section('script')
    <script src="{{ URL::to('assets/js/datatables/jquery-3.7.0.js') }}"></script>
    <script src="{{ URL::to('assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>
    <script src="{{ URL::to('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/dashboard_sales.js') }}"></script>
@endsection
