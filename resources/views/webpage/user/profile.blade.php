@extends('layouts.webpage.master')

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
                                        class=" active py-xxl-3 py-2 px-xxl-5 px-xl-4 px-3 radius12 n4-clr fw_600 d-flex align-items-center gap-xxl-3 gap-2 user-text-inner">
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
                    <div
                        class="cmn-box-addingbg win40-ragba border radius24 py-xxl-10 py-xl-8 py-lg-6 py-5 px-xxl-8 px-xl-6 px-sm-5 px-4">
                        <h4 class="user-title n4-clr mb-xxl-10 mb-xl-8 mb-lg-6 mb-5">
                            Informacion personal
                        </h4>

                        <form id="formUpdateUser" class="ch-form-one">
                            <div class="row g-6">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="ch-form-items">
                                        <label class="text-uppercase fs18 fw_600 n3-clr mb-xxl-4 mb-xl-3 mb-2">
                                            Nombres
                                        </label>
                                        <input name="names" type="text" value="{{ $userAutenticated->names }}"
                                            data-validate>
                                        <input type="hidden" name="id" value="{{ $userAutenticated->id }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="ch-form-items">
                                        <label class="text-uppercase fs18 fw_600 n3-clr mb-xxl-4 mb-xl-3 mb-2">
                                            Apellidos
                                        </label>
                                        <input name="surnames" type="text" value="{{ $userAutenticated->surnames }}"
                                            data-validate>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="ch-form-items">
                                        <label class="text-uppercase fs18 fw_600 n3-clr mb-xxl-4 mb-xl-3 mb-2">
                                            numero de celular
                                        </label>
                                        <input name="phone" type="text" value="{{ $userAutenticated->phone }}"
                                            data-validate>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="ch-form-items">
                                        <label class="text-uppercase fs18 fw_600 n3-clr mb-xxl-4 mb-xl-3 mb-2">
                                            Correo electronico
                                        </label>
                                        <input readonly type="email" value="{{ $userAutenticated->email }}"
                                            data-validate>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="ch-form-items">
                                        <label class="text-uppercase fs18 fw_600 n3-clr mb-xxl-4 mb-xl-3 mb-2">
                                            DNI
                                        </label>
                                        <input name="dni" type="text" value="{{ $userAutenticated->dni }}"
                                            data-validate>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="ch-form-items">
                                        <label class="text-uppercase fs18 fw_600 n3-clr mb-xxl-4 mb-xl-3 mb-2">
                                            fecha de nacimiento
                                        </label>
                                        <input type="date" name="date_of_birth" value="{{ $userAutenticated->date_of_birth }}"
                                            data-validate>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="ch-form-items">
                                        <label class="text-uppercase fs18 fw_600 n3-clr mb-xxl-4 mb-xl-3 mb-2">
                                            Género
                                        </label>
                                        <select name="gender" class="select-custom" data-validate>
                                            <option selected value="">Selecciona una opción</option>
                                            <option value="Femenino"
                                                {{ $userAutenticated->gender == 'Femenino' ? 'selected' : '' }}>
                                                Femenino
                                            </option>
                                            <option value="Masculino"
                                                {{ $userAutenticated->gender == 'Masculino' ? 'selected' : '' }}>
                                                Masculino
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="ch-form-items">
                                        <label for="eml"
                                            class="text-uppercase fs18 fw_600 n3-clr mb-xxl-4 mb-xl-3 mb-2">
                                            Ciudad o departamento
                                        </label>

                                        <select name="department" class="select-custom" data-validate>
                                            <option selected value="">Selecciona una opción</option>
                                            <option value="Amazonas"
                                                {{ $userAutenticated->department == 'Amazonas' ? 'selected' : '' }}>
                                                Amazonas</option>
                                            <option value="Áncash"
                                                {{ $userAutenticated->department == 'Áncash' ? 'selected' : '' }}>Áncash
                                            </option>
                                            <option value="Apurímac"
                                                {{ $userAutenticated->department == 'Apurímac' ? 'selected' : '' }}>
                                                Apurímac
                                            </option>
                                            <option value="Arequipa"
                                                {{ $userAutenticated->department == 'Arequipa' ? 'selected' : '' }}>
                                                Arequipa
                                            </option>
                                            <option value="Ayacucho"
                                                {{ $userAutenticated->department == 'Ayacucho' ? 'selected' : '' }}>
                                                Ayacucho</option>
                                            <option value="Cajamarca"
                                                {{ $userAutenticated->department == 'Cajamarca' ? 'selected' : '' }}>
                                                Cajamarca</option>
                                            <option value="Callao"
                                                {{ $userAutenticated->department == 'Callao' ? 'selected' : '' }}>Callao
                                            </option>
                                            <option value="Cusco"
                                                {{ $userAutenticated->department == 'Cusco' ? 'selected' : '' }}>Cusco
                                            </option>
                                            <option value="Huancavelica"
                                                {{ $userAutenticated->department == 'Huancavelica' ? 'selected' : '' }}>
                                                Huancavelica</option>
                                            <option value="Huánuco"
                                                {{ $userAutenticated->department == 'Huánuco' ? 'selected' : '' }}>Huánuco
                                            </option>
                                            <option value="Ica"
                                                {{ $userAutenticated->department == 'Ica' ? 'selected' : '' }}>Ica</option>
                                            <option value="Junín"
                                                {{ $userAutenticated->department == 'Junín' ? 'selected' : '' }}>Junín
                                            </option>
                                            <option value="La Libertad"
                                                {{ $userAutenticated->department == 'La Libertad' ? 'selected' : '' }}>La
                                                Libertad</option>
                                            <option value="Lambayeque"
                                                {{ $userAutenticated->department == 'Lambayeque' ? 'selected' : '' }}>
                                                Lambayeque</option>
                                            <option value="Lima"
                                                {{ $userAutenticated->department == 'Lima' ? 'selected' : '' }}>Lima
                                            </option>
                                            <option value="Loreto"
                                                {{ $userAutenticated->department == 'Loreto' ? 'selected' : '' }}>Loreto
                                            </option>
                                            <option value="Madre de Dios"
                                                {{ $userAutenticated->department == 'Madre de Dios' ? 'selected' : '' }}>
                                                Madre de Dios</option>
                                            <option value="Moquegua"
                                                {{ $userAutenticated->department == 'Moquegua' ? 'selected' : '' }}>
                                                Moquegua</option>
                                            <option value="Pasco"
                                                {{ $userAutenticated->department == 'Pasco' ? 'selected' : '' }}>Pasco
                                            </option>
                                            <option value="Piura"
                                                {{ $userAutenticated->department == 'Piura' ? 'selected' : '' }}>Piura
                                            </option>
                                            <option value="Puno"
                                                {{ $userAutenticated->department == 'Puno' ? 'selected' : '' }}>Puno
                                            </option>
                                            <option value="San Martín"
                                                {{ $userAutenticated->department == 'San Martín' ? 'selected' : '' }}>San
                                                Martín</option>
                                            <option value="Tacna"
                                                {{ $userAutenticated->department == 'Tacna' ? 'selected' : '' }}>Tacna
                                            </option>
                                            <option value="Tumbes"
                                                {{ $userAutenticated->department == 'Tumbes' ? 'selected' : '' }}>Tumbes
                                            </option>
                                            <option value="Ucayali"
                                                {{ $userAutenticated->department == 'Ucayali' ? 'selected' : '' }}>Ucayali
                                            </option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div
                                class="border-top d-flex align-items-center justify-content-end pt-xxl-8 pt-6 mt-xxl-8 mt-6">
                                <button type="submit" class="kewta-btn kewta-alt d-inline-flex align-items-center "
                                    data-aos="zoom-in-right" data-aos-duration="1000">
                                    <span class="kew-text act4-bg nw1-clr act3-bg">
                                        Actualizar
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==== User Panel Section ==== -->
@endsection

@section('scripts')
    <script src="{{ URL::to('assets/js/custom/webpage/user.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/raffles.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/products.js') }}"></script>
@endsection
