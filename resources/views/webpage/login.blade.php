@extends('layouts.webpage.master')

@section('content')
    <div>
        <!-- ==== Login ==== -->
        <section class="position-relative pt-120 pb-120 n0-bg mt-120" id="loginSection">
            <div class="container">
                <div class="col-12 col-lg-8 mx-auto">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-5">
                            <div class="left-logwrap d-center">
                                <div class="authentication-cmn">
                                    <div class="log-title mb-xxl-10 mb-xl-7 mb-6">
                                        <h3 class="mb-xxl-6 mb-4">
                                            ¡Inicia sesión ahora!
                                        </h3>
                                        <span class="n3-clr">
                                            ¿Nuevo usuario? <a href="{{ route('webpage.register') . '#registerSection' }}"
                                                class="s1-clr s1-texthover">Create una cuenta</a>
                                        </span>
                                    </div>
                                    <form id="formLogin" class="form-cmn-action">
                                        <div class="row g-6">
                                            <div class="col-lg-12">
                                                <div class="form-cmn">
                                                    <input type="email" placeholder="Correo electronico" name="email" data-validate>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-cmn">
                                                    <div class="ps-grp position-relative">
                                                        <input type="password" id="password-field" name="password"
                                                            data-validate class="password-field"
                                                            placeholder="Contraseña">
                                                        <i class="ph ph-eye-slash toggle-password eye-icon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            {{--  <a href="javascript:void(0)"
                                                class="d-flex text-decoration-underline act4-texthover justify-content-end fw_600 n4-clr fs-eight mt-xxl-6 mt-3" data-validate>
                                                Recuperar contraseña
                                            </a> --}}
                                            <div class="col-lg-12">
                                                <button type="submit"
                                                    class="cmn-btn s1-bg radius12 w-100 fw_600 justify-content-center d-inline-flex align-items-center gap-2 py-xxl-4 py-3 px-xl-6 px-5 n0-clr mt-1">
                                                    <span class="fw_600 n0-clr">
                                                        Ingresar
                                                    </span>
                                                </button>
                                            </div>

                                            <div class="col-lg-12">
                                                <a href="/google-auth/redirect"
                                                style="background-color: #DB4437"
                                                    class="cmn-btn s1-bg radius12 w-100 fw_600 justify-content-center d-inline-flex align-items-center gap-2 py-xxl-4 py-3 px-xl-6 px-5 n0-clr mt-0">
                                                    <span class="fw_600 n0-clr d-flex align-items-center ">
                                                        Iniciar sesión con google <i class="ph ph-google-logo ms-2"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{--    <div class="col-lg-7">
                            <div class="log-thumbwrap">
                                <div class="thumb">
                                    <img src="{{ asset('assets/images/login.webp') }}" alt="img">
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
