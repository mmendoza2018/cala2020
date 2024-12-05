@extends('layouts.master')

@section('content')
    <!-- Page-content -->
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">sorteos</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboards</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        sorteos
                    </li>
                </ul>
            </div>
            <div class="card bg-white">
                <div class="card-body">
                    <table id="tableProducts" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Imagen</th>
                                <th>Titulo</th>
                                <th>Precio</th>
                                <th>Fecha de sorteo</th>
                                <th>Fecha limite</th>
                                <th>Visible</th>
                                <th>Tickets comprados</th>
                                <th>Ganador</th>
                                <th>Imagen</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($raffles as $raffle)
                                <tr data-table={{ $raffle->id }}>
                                    <td>{{ $raffle->id }}</td>
                                    <td>
                                        @php
                                            $images = json_decode($raffle->images, true);
                                            $imageUrl = asset('storage/uploads/' . $images[0]['path']);
                                        @endphp
                                        <img src="{{ $imageUrl }}" alt="" class="rounded-md"
                                            style="width: 4rem">
                                    </td>
                                    <td>{{ $raffle->title }}</td>
                                    <td>{{ $raffle->ticket_price }}</td>
                                    <td>{{ $raffle->draw_date->format('Y-m-d') }}</td>
                                    <td>{{ $raffle->end_date->format('Y-m-d') }}</td>
                                    <td>
                                        <x-badge color="{{ $raffle->is_visible ? 'success' : 'warning' }}"
                                            description="{{ $raffle->is_visible ? 'Visible' : 'No visible' }}"
                                            :outline="false" />
                                    </td>
                                    <td>{{ $raffle->tickets_sold }}</td>
                                    <td>
                                        @php
                                            $winnerFullName = '';
                                            if ($raffle->winner_id) {
                                                $winnerFullName =
                                                    $raffle->winner->names . ' ' . $raffle->winner->surnames;
                                            }
                                        @endphp
                                        {{ $winnerFullName }}
                                    </td>
                                    <td>
                                        @if ($raffle->winner_image)
                                            @php
                                                $imageUrl = asset('storage/uploads/' . $raffle->winner_image);
                                            @endphp
                                            <img src="{{ $imageUrl }}" alt="" class="h-10 h-16 rounded-md"
                                                style="width: 4rem">
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('raffles.edit', $raffle->id) }}">
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
@endsection

@section('script')
    <script src="{{ URL::to('assets/js/datatables/jquery-3.7.0.js') }}"></script>
    <script src="{{ URL::to('assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/products.js') }}"></script>
@endsection
