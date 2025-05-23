<div class="row g-6">
    @if (count($raffles))
        @foreach ($raffles as $raffle)
            <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-duration="1000">
                <div class="current-lottery-itemv9 cmn-cartborder position-relative radius24 n0-bg">
                    <div class="thumb cus-z1 position-relative">
                        <div
                            class="current-l-badge cus-z1 d-flex align-items-center {{ $raffle->is_today ? 'justify-content-between' : 'justify-content-end' }}  pt-xxl-5 pt-4 pe-xxl-5 pe-4">
                            @if ($raffle->is_today)
                                <span class="draw-badge n0-clr ">
                                    <span class="n0-clr position-relative fw_700 fs-eight">
                                        Sorteo hoy
                                    </span>
                                </span>
                            @endif
                            {{-- <a href="basket.html" class="cmn-40 n0-bg radius-circle n0-hover">
                                <i class="ph ph-bold ph-shopping-cart n4-clr fs-five"></i>
                            </a> --}}
                        </div>
                        <div class="thumb-in">
                            @php
                                $images = json_decode($raffle->images, true);
                                $image = $images[0];
                            @endphp
                            <img src="{{ asset('storage/uploads/' . getCompanyCode() . '/' . $image['path']) }}" class="image-raffles"
                                alt="{{ $image['description'] }}">
                        </div>
                        <div class="current-hoberv9 d-center">
                            <a href="{{ route('webpage.raffle', ['raffle' => $raffle->slug]) }}"
                                class="kewta-btn kewta-alt d-inline-flex align-items-center">
                                <span class="kew-text w-100 text-capitalize fs-seven fw_500 n4-bg n0-clr">
                                    Ver detalles
                                </span>
                                <div class="kew-arrow n4-bg">
                                    <div class="kt-one">
                                        <i class="ti ti-arrow-right n0-clr"></i>
                                    </div>
                                    <div class="kt-two">
                                        <i class="ti ti-arrow-right n0-clr"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="content-middle">
                        <ul
                            class="remaining-info px-xxl-6 px-xl-5 px-lg-4 px-3 pt-xxl-6 pt-4 d-flex align-items-center justify-content-between gap-xxl-5 gap-lg-3 gap-2">
                            <li class="d-flex align-items-center gap-2">
                                <i class="ph ph-clock fs-five n3-clr"></i>
                                <span class="n3-clr fw_600"
                                    @if (!$raffle->is_expired) data-draw_date="{{ $raffle->draw_date }}" @endif>
                                </span>
                            </li>
                            @if ($raffle->draw_date >= now())
                                <li>
                                    <span class="badge rounded-pill bg-success">Activo</span>
                                </li>
                            @else
                                <li>
                                    <span class="badge rounded-pill bg-warning">Culminado</span>
                                </li>
                            @endif
                        </ul>
                        <div
                            class="d-flex px-xxl-6 px-xl-5 px-lg-4 px-3 pt-xxl-5 pt-sm-4 pt-4 pb-xxl-3 pb-sm-3 pb-2 flex-wrap gap-3 align-items-center justify-content-between">
                            <h4>
                                <a href="{{ route('webpage.raffle', ['raffle' => $raffle->slug]) }}"
                                    class="n4-clr fw_700">
                                    {{ $raffle->title }}
                                </a>
                            </h4>
                        </div>
                        <div
                            class="d-flex px-xxl-6 px-xl-5 px-lg-4 px-3 align-items-center justify-content-between pb-xxl-6 pb-4">
                            <h3 class="d-flex align-items-center gap-3 n4-clr">
                                <span class="pr fw_700">S/{{ $raffle->ticket_price }} </span>
                                <span class="fs-six text-uppercase">Por ticket </span>
                            </h3>
                        </div>
                        <div class="border-top"></div>
                        <div
                            class="cmn-prrice-range px-xxl-6 px-xl-5 px-lg-4 px-3 d-grid align-items-center gap-2 py-xxl-6 py-4">
                            <span class="n4-clr soldout fw_700 fs-eight mb-1">
                                Fecha de sorteo:
                                <span
                                    class="n3-clr fs-eight">{{ \Carbon\Carbon::parse($raffle->draw_date)->translatedFormat('d \d\e F \d\e Y') }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="text-quote mt-xxl-10 mt-xl-8 mt-5 text-center cus-z1 fs-four fw_700 n1-clr position-relative py-xxl-10 py-xl-7 py-5 px-xxl-8 px-xl-7 px-5 aos-init aos-animate current-bg"
            data-aos="zoom-in-left" data-aos-duration="1600">
            No hay sorteos actualmente, intentelo más tarde!
            <span class="icon">
                <i class="ph ph-quotes act3-clr"></i>
            </span>
        </div>
    @endif
</div>

<div class="text-right pagination">
    {{ $raffles->links('pagination::bootstrap-4') }}
</div>
