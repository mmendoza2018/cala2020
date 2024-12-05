@extends('layouts.webpage.master')
@section('headers')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    @php
        $userAutenticated = Auth::guard('web')->user();
    @endphp

    <style>
        .pagination .page-item .page-link {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center !important;
            width: auto !important;
            padding: 1rem !important;
        }
    </style>
    <!-- ==== User Panel Section ==== -->
    <section class="userpanel-section pt-120 pb-120 mt-50">
        <div class="container">
            <div class="row g-6 justify-content-center">
                <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-8">
                    <div class="user-panel-sidebarwrap">
                        <div
                            class="user-panel-sideinner win40-ragba border radius24 py-xxl-10 py-xl-8 py-lg-6 py-5 px-xxl-8 px-xl-6 px-5">
                            <div
                                class="user-profile-thumb position-relative text-center border-bottom pb-xxl-5 pb-4 mb-xxl-6 mb-5">
                                <div class="content">
                                    <span class="fs20 fw_700 n4-clr d-block mb-1">
                                        {{ $userAutenticated->names . ' ' . $userAutenticated->surnames }}
                                    </span>
                                    <span class="n3-clr">
                                        {{ $userAutenticated->email }}
                                    </span>
                                </div>
                            </div>
                            <ul class="user-sidebar d-grid gap-2">
                                <li>
                                    <a href="{{ route('webpage.user.profileView') }}"
                                        class="py-xxl-3 py-2 px-xxl-5 px-xl-4 px-3 radius12 n4-clr fw_600 d-flex align-items-center gap-xxl-3 gap-2 user-text-inner">
                                        <i class="ph-bold ph-info fs-five"></i>
                                        información personal
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('webpage.user.productsView') }}"
                                        class=" py-xxl-3 py-2 px-xxl-5 px-xl-4 px-3 radius12 n4-clr fw_600 d-flex align-items-center gap-xxl-3 gap-2 user-text-inner">
                                        <i class="ph ph-bag"></i>
                                        Mis productos
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('webpage.user.ticketsView') }}"
                                        class="active py-xxl-3 py-2 px-xxl-5 px-xl-4 px-3 radius12 n4-clr fw_600 d-flex align-items-center gap-xxl-3 gap-2 user-text-inner">
                                        <i class="ph-bold ph-ticket fs-five"></i>
                                        Mis tickets
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('page.logout') }}"
                                        class="py-xxl-3 py-2 px-xxl-5 px-xl-4 px-3 radius12 n4-clr fw_600 d-flex align-items-center gap-xxl-3 gap-2 user-text-inner">
                                        <span class="icon-rotate"><i class="ph-bold ph-upload fs-five"></i></span>
                                        Cerrar sesión
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-9 col-xl-8 col-lg-8">
                    <div class="cmn-box-addingbg win40-ragba border radius24 pt-xxl-10 pt-xl-8 pt-lg-6 pt-5 pb-5">
                        <div
                            class="mb-xxl-10 mb-xl-8 mb-lg-6 mb-5 d-flex align-items-center justify-content-between flex-wrap gap-3 px-xxl-10 px-xl-8 px-5">
                            <h3 class="user-title n4-clr">
                                Tickets
                            </h3>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table table-striped" id="tableTickets">
                                <thead>
                                    <tr>
                                        <th><span class="n4-clr fs20 fw_700">Código</span></th>
                                        <th> <span class="n4-clr fs20 fw_700">Producto digital</span></th>
                                        <th> <span class="n4-clr fs20 fw_700">Precio</span></th>
                                        <th> <span class="n4-clr fs20 fw_700">Fecha de creacion</span></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($tickets as $ticket)
                                        <tr>
                                            <td><span class="n3-clr">{{ $ticket->ticket_code }}</span></td>
                                            <td><span class="n3-clr">{{ $ticket->raffle->title }}</span></td>
                                            <td><span class="n3-clr">{{ number_format($ticket->ticket_price, 2) }}</span>
                                            </td>
                                            <td><span class="n3-clr">{{ $ticket->created_at }}</span></td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==== User Panel Section ==== -->
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/user.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/raffles.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/products.js') }}"></script>
@endsection
