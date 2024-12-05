@extends('layouts.master')

@section('content')
    <!-- Page-content -->
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Tickets</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboards</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Tickets
                    </li>
                </ul>
            </div>
            <div class="card bg-white">
                <div class="card-body">
                    <table id="tableTickets" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Comprador</th>
                                <th>Correo</th>
                                <th>DNI</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ticketSales as $sale)
                                <tr data-table={{ $sale->id }}>
                                    <td>{{ $sale->id }}</td>
                                    <td>{{ $sale->user->names . ' ' . $sale->user->surnames }}</td>
                                    <td>{{ $sale->user->email }}</td>
                                    <td>{{ $sale->user->dni }}</td>
                                    <td>{{ $sale->quantity }}</td>
                                    <td>{{ $sale->total }}</td>
                                    <td>
                                        <x-badge color="{{ $sale->status ? 'success' : 'danger' }}"
                                            description="{{ $sale->status ? 'Activo' : 'Inactivo' }}" :outline="false" />
                                    </td>
                                    <td>{{ $sale->created_at }}</td>
                                    <td class="text-center">
                                        @if ($sale->status == 1)
                                            <a>
                                                <i class="ri-mail-send-fill ri-xl cursor-pointer" id="btnSendEmail"
                                                    onclick="getRaffleToSendEmail('{{ $sale->id }}')"></i>
                                            </a>
                                        @endif
                                        <a>
                                            <i class="ri-bank-card-2-fill ri-xl cursor-pointer" id="btnDetail"
                                                onclick="getTicketSaleDetails('{{ $sale->id }}')"></i>
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

    <!-- Modal details -->
    <div id="modalDetailTicketSale" modal-center=""
        class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
        <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
            <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
                <h5 class="text-16">Detalle</h5>
                <button data-modal-close="modalDetailTicketSale"
                    class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500"><i
                        data-lucide="x" class="size-5"></i></button>
            </div>
            <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                <table id="tableTicketsDetails" class="display stripe group" style="width:100%">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Sorteo</th>
                            <th>Precio</th>
                            <th>Fecha de creación</th>
                        </tr>
                    </thead>
                    <tbody id="containerTickets">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end Modal details -->

    <!-- Modal forwarding -->
    <div id="modalSendEmail" modal-center=""
        class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
        <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
            <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
                <h5 class="text-16">Reenvio de tickets</h5>
                <button data-modal-close="modalSendEmail"
                    class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500"><i
                        data-lucide="x" class="size-5"></i></button>
            </div>
            <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                <form id="formSendEmail" onsubmit="sendEmailForwarding(this)">
                    <label class="inline-block mb-2 text-base font-medium">Cliente</label>
                    <x-input type="text" disabled id="customer"/>
                    <x-input type="hidden" data-validate name="idTicketSale" id="idTicketSale"/>

                    <label class="inline-block mb-2 text-base font-medium">DNI</label>
                    <x-input type="text" disabled id="dni"/>

                    <label class="inline-block mb-2 text-base font-medium">Cantidad</label>
                    <x-input type="number" step="0.01" id="quantity" disabled/>

                    <label class="inline-block mb-2 text-base font-medium">Total</label>
                    <x-input type="number" step="0.01" id="total" disabled />

                    <label class="inline-block mb-2 text-base font-medium">Correo de envio</label>
                    <x-input type="email" data-validate name="email" id="email" />

                    <div class="text-right">
                        <x-button type="submit" color="primary" class="mt-3" description="Enviar correo"
                            :outline="false" />
                    </div>  
                </form>
            </div>
        </div>
    </div>
    <!-- end Modal forwarding -->

    <!-- container-fluid -->
@endsection

@section('script')
    <script src="{{ URL::to('assets/js/datatables/jquery-3.7.0.js') }}"></script>
    <script src="{{ URL::to('assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/tickets.js') }}"></script>
@endsection
