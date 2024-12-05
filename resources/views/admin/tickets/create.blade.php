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
                    <form id="formAddTickets">
                        <div class="flex flex-col md:flex-row justify-center w-full gap-5">
                            <div class="w-full md:w-1/4">

                                <label class="inline-block mb-2 text-base font-medium">Cliente</label>
                                <x-input type="text" data-validate name="full_name" />

                                <label class="inline-block mb-2 text-base font-medium">DNI</label>
                                <x-input type="number" data-validate name="dni" />

                                <label class="inline-block mb-2 text-base font-medium">Email</label>
                                <x-input type="email" data-validate name="email" />

                                <label class="inline-block text-base font-medium">Sorteo</label>
                                <x-select data-choices="" onchange="getRaffle(this)" name="raffle_id" data-validate>
                                    <option value="">Selecciona una opción</option>
                                    @foreach ($rafflesActive as $raffle)
                                        <option value="{{ $raffle->id }}">{{ $raffle->title }}</option>
                                    @endforeach
                                </x-select>
                              
                                <label class="inline-block mb-2 text-base font-medium">Precio por ticket</label>
                                <x-input type="number" step="0.01" readonly name="ticket_price" id="ticket_price" class="mb-3" data-validate />

                                <label class="inline-block mb-2 text-base font-medium">Cantidad de tickets</label>
                                <x-input type="number" data-validate name="quantity" />
                                
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
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection

@section('script')
    <script src="{{ URL::to('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/tickets.js') }}"></script>
@endsection
