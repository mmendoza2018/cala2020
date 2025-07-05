@extends('layouts.webpage.master')

@section('content')
    <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto"
        style="margin-top: 100px; min-height: 90vh; display: flex;flex-direction: column; justify-content: center;">
        <div class="profile-container-custom">
            <div class="profile-card-custom">
                <img src="{{ asset('storage/uploads/' . getCompanyCode() . '/' . $generalInfo->logo) }}"
                     class="profile-image-custom" />
                <h2 class="profile-name-custom">{{ $generalInfo->title }}</h2>
                <p class="profile-description-custom">
                    {{ $generalInfo->business_name }}
                </p>
                <div class="social-links-custom">
                    @foreach ($socialNetworks as $social)
                        <a href="{{ $social->link }}">{!! $social->icon_html !!}</a>
                    @endforeach
                </div>
            </div>
            <div class="profile-about-custom">
                <p>
                    {{ $generalInfo->description }}
                </p>
                <div class="detail-store">
                    <div class="item-detail-store">
                        <span>RUC:</span>
                        <span>{{ $generalInfo->ruc }}</span>
                    </div>
                    <div class="item-detail-store">
                        <span>Dirección :</span>
                        <span>{{ $generalInfo->address }}</span>
                    </div>
                    <div class="item-detail-store">
                        <span>Correo:</span>
                        <span>{{ $generalInfo->email }}</span>
                    </div>
                </div>
                <div class="payment-methods">
                    @foreach ($paymentMethods as $payment)
                    <figure>
                        <img src="{{ asset('storage/uploads/' . getCompanyCode() . '/' . $payment->image) }}" alt="">
                        <figcaption>
                            {{ $payment->description }}
                        </figcaption>
                    </figure>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ URL::to('assets/js/custom/webpage/raffles.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/products.js') }}"></script>
@endsection
