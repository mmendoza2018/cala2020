@extends('layouts.webpage.master')
@section('headers')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
@endsection

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
@section('content')
    <!-- ==== User Panel Section ==== -->
    @php
        $userAutenticated = Auth::guard('web')->user();
    @endphp
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
                                        class="active py-xxl-3 py-2 px-xxl-5 px-xl-4 px-3 radius12 n4-clr fw_600 d-flex align-items-center gap-xxl-3 gap-2 user-text-inner">
                                        <i class="ph ph-bag"></i>
                                        Mis productos
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('webpage.user.ticketsView') }}"
                                        class="py-xxl-3 py-2 px-xxl-5 px-xl-4 px-3 radius12 n4-clr fw_600 d-flex align-items-center gap-xxl-3 gap-2 user-text-inner">
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
                            <h4 class="user-title n4-clr">
                                Productos
                            </h4>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table table-striped" id="tableProducts">
                                <thead>
                                    <tr>
                                        <th><span class="n4-clr fs20 fw_700">Codigo</span></th>
                                        <th> <span class="n4-clr fs20 fw_700">Productos</span></th>
                                        <th> <span class="n4-clr fs20 fw_700">Total</span></th>
                                        <th> <span class="n4-clr fs20 fw_700">Estado</span></th>
                                        <th> <span class="n4-clr fs20 fw_700">Fecha compra</span></th>
                                        <th> <span class="n4-clr fs20 fw_700">Detalle</span></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($orders as $order)
                                        <tr>
                                            <td><span class="n3-clr">{{ $order->code }}</span></td>
                                            <td><span class="n3-clr">{{ $order->details->count() }}</span></td>
                                            <td><span class="n3-clr">{{ number_format($order->total, 2) }}</span></td>
                                            <td><span class="n3-clr">{{ $order->status === "PAID" ? "Completado" : "Pendiente" }}</span></td>
                                            <td><span class="n3-clr">{{ $order->created_at }}</span></td>
                                            <td class="p-2 text-center">
                                                <i class="ph ph-list-dashes" style="cursor: pointer"
                                                    data-id_sale="{{ $order->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#modalDetailsSaleProduct" id="showDetailSale"></i>
                                            </td>
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

    <!-- Modal -->
    <div class="modal fade" id="modalDetailsSaleProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Detalles de la compra</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th><span class="n4-clr fs20 fw_700">#</span></th>
                                    <th> <span class="n4-clr fs20 fw_700">Producto</span></th>
                                    <th> <span class="n4-clr fs20 fw_700">Precio</span></th>
                                    <th> <span class="n4-clr fs20 fw_700">Cantidad</span></th>
                                    <th> <span class="n4-clr fs20 fw_700">Subtotal</span></th>
                                </tr>
                            </thead>
                            <tbody id="detailSaleEcommerce">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/user.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/raffles.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/products.js') }}"></script>
@endsection
