@extends('layouts.webpage.master')

@section('content')
    <div>
        <!-- ==== Login ==== -->
        <section class="position-relative pt-120 pb-120 mt-120 n0-bg" id="registerSection">
            <div class="container">
                <div class="col-12 col-lg-9 mx-auto">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-8">
                            <div class="left-logwrap d-center">
                                <div class="authentication-cmn">
                                    <div class="log-title mb-xxl-10 mb-xl-7 mb-6">
                                        <h3 class="mb-xxl-6 mb-4">
                                            ¡Empieza totalmente gratis!
                                        </h3>
                                        <span class="n3-clr">
                                            ¿Ya tienes cuenta? <a href="{{ route('webpage.login') . '#loginSection' }}"
                                                class="s1-clr s1-texthover">Ingresa ahora</a>
                                        </span>
                                    </div>
                                    <form id="formRegister" class="form-cmn-action">
                                        <div class="row g-6">
                                            <div class="col-lg-6">
                                                <div class="form-cmn">
                                                    <input type="text" placeholder="Nombres" name="names" data-validate>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-cmn">
                                                    <input type="text" placeholder="Apellidos" name="surnames" data-validate>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-cmn">
                                                    <input type="email" placeholder="Correo electronico" name="email" data-validate>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-cmn">
                                                    <input type="text" placeholder="Numero de celular" name="phone" data-validate>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-cmn">
                                                    <div class="ps-grp position-relative">
                                                        <input type="password" name="password" class="password-field"
                                                            placeholder="Ingresa tu contraseña" id="password"
                                                            onpaste="return false;" data-validate>
                                                        <i class="ph ph-eye-slash toggle-password eye-icon"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-cmn">
                                                    <div class="ps-grp position-relative">
                                                        <input type="password" name="password_confirmation"
                                                            class="password-field" id="confirmPassword"
                                                            placeholder="Repite tu contraseña" onpaste="return false;"
                                                            data-validate>
                                                        <i class="ph ph-eye-slash toggle-password eye-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="{{ route('webpage.termsAndConditions') }}" target="_blank" class="n3-clr">
                                                <i class="ph ph-check-circle"></i> Al registrarme, acepto los Términos y condiciones
                                            </a>
                                            <div class="col-lg-12">
                                                <div class="form-cmn">
                                                    <button type="submit"
                                                        class="w-100 radius12 s1-bg fw_600 nw1-clr d-flex align-items-center justify-content-between py-xxl-4 py-3 px-xxl-4 px-3">
                                                        Crear cuenta
                                                        <i class="ph ph-caret-right nw1-clr"></i>
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{--   <div class="col-lg-7">
                            <div class="log-thumbwrap">
                                <div class="thumb">
                                    <img src="{{ asset('assets/images/register.webp') }}" alt="img">
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </section>
        <!-- ==== Login ==== -->

    </div>
@endsection

@section('scripts')
    <script src="{{ URL::to('assets/js/custom/webpage/user.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/raffles.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/products.js') }}"></script>
@endsection
