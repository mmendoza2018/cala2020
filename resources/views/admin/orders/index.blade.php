@extends('layouts.master')

@section('content')
    <!-- Page-content -->
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Ordenes</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboards</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Ordenes
                    </li>
                </ul>
            </div>
            <div class="card bg-white">
                <div class="card-body">
                    <table id="tableOrders" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th>Codigo de transacción</th>
                                <th>Cantidad productos</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Fecha compra</th>
                                <th>Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->code }}</td>
                                    <td>{{ $order->details->count() }} </td>
                                    <td>{{ number_format($order->total, 2) }}</td>
                                    <td>{{ $order->status === "PAID" ? "Completado" : "Pendiente" }} </td>
                                    <td>{{ $order->created_at }}</td>
                                    <td class="text-center">
                                        <a href="#" data-modal-target="modalOrdersDetail" onclick="getOrdersDetail('{{ $order->id }}')">
                                            <i class="ri-edit-box-fill ri-xl cursor-pointer"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    <!-- Modal add cash register-->
    <div id="modalOrdersDetail" modal-center=""
        class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
        <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
            <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
                <h5 class="text-16">Detalles de la orden</h5>
                <button data-modal-close="modalOrdersDetail"
                    class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500"><i
                        data-lucide="x" class="size-5"></i></button>
            </div>
            <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">

                <table class="w-full">
                    <thead class="ltr:text-left rtl:text-right ">
                        <tr>
                            <th class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">#</th>
                            <th class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">Descripción</th>
                            <th class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">Precio</th>
                            <th class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">Cantidad</th>
                            <th class="px-3.5 py-2.5 font-semibold border border-slate-200 dark:border-zink-500">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="detailSaleEcommerce">
                        <tr>
                            <td class="px-3.5 py-2.5 border border-slate-200 dark:border-zink-500">Amezon</td>
                            <td class="px-3.5 py-2.5 border border-slate-200 dark:border-zink-500">Cleo Carson</td>
                            <td class="px-3.5 py-2.5 border border-slate-200 dark:border-zink-500">$4,521</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::to('assets/js/datatables/jquery-3.7.0.js') }}"></script>
    <script src="{{ URL::to('assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/ordersSale.js') }}"></script>
@endsection
