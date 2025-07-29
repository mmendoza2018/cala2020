@extends('layouts.app')

@section('content')

    <div class="mb-0 border-none lg:w-[500px] card bg-white/70 shadow-none dark:bg-zink-500/70">
        <div class="!px-10 !py-12 card-body">
            <a href="index-1.html">
                <img src="{{ asset('storage/uploads/' . getCompanyCode() . '/' . $generalInfo->logo) }}" alt=""
                    class="hidden h-6 mx-auto">
            </a>

            <div class="mt-8 text-center">
                <h4 class="mb-2 text-custom-500 dark:text-custom-500">¿Has olvidado tu contraseña?</h4>
                <p class="mb-8 text-slate-500 dark:text-zink-200">Restablecer su contraseña</p>
            </div>

            <div
                class="px-4 py-3 mb-6 text-sm text-yellow-500 border border-transparent rounded-md bg-yellow-50 dark:bg-yellow-400/20">
                Proporcione su dirección de correo electrónico y se le enviarán instrucciones.
            </div>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div>
                    <label for="emailInput" class="inline-block mb-2 text-base font-medium">Correo</label>
                    <input type="email"
                        class="form-input dark:bg-zink-600/50 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        required="" placeholder="Enter email" id="email" name="email" autocomplete="email"
                        value="{{ old('email') }}" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mt-8">
                    <button type="submit"
                        class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Enviar
                        link para cambiar mi contraseña</button>
                </div>
                <div class="mt-4 text-center">
                    <p class="mb-0">Espera, Recorde mi contraseña... <a href="{{ route('login') }}"
                            class="underline fw-medium text-custom-500"> Click Aqui </a> </p>
                </div>
            </form>
        </div>
    </div>
@endsection
