@extends('layouts.webpage.master')

@section('content')
    <!-- ==== Checkout Section ==== -->
    <section class="pt-120 pb-120 mt-50 n0-bg overflow-hidden p-3" style="margin-top: 75px; background-color: #f9fafb">
        <div  class="container 2xl:max-w-[87.5rem] px-4 mx-auto">
            <div class="relative min-h-screen group-data-[sidebar-size=sm]:min-h-sm">
                <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

                    <form id="formAddOrder">
                        <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5">
                            <div class="xl:col-span-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="mb-4 text-15">Información de Orden</h6>
                                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-12">
                                            <div class="xl:col-span-4">
                                                <label for="firstNameInput"
                                                    class="inline-block mb-2 text-base font-medium">Nombres</label>
                                                <input type="text" id="firstNameInput"
                                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-slate-300 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                                                    placeholder="Ingrese su Nombre..." name="first_name" data-validate>

                                            </div><!--end col-->
                                            <div class="xl:col-span-4">
                                                <label for="lastNameInput"
                                                    class="inline-block mb-2 text-base font-medium">Apellidos</label>
                                                <input type="text" id="lastNameInput"
                                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-slate-300 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                                                    placeholder="Ingrese su Apellido" name="last_name" data-validate>
                                            </div><!--end col-->
                                            <div class="xl:col-span-4">
                                                <label for="phoneNumberInput"
                                                    class="inline-block mb-2 text-base font-medium">Numero de
                                                    Celular</label>
                                                <input type="text" id="phoneNumberInput"
                                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-slate-300 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                                                    placeholder="936983256" name="phone_number" data-validate>
                                            </div><!--end col-->
                                            <div class="xl:col-span-4">
                                                <label for="alternativeNumberInput"
                                                    class="inline-block mb-2 text-base font-medium">Numero de Celular
                                                    (extra)</label>
                                                <input type="text" id="alternativeNumberInput"
                                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-slate-300 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                                                    placeholder="936113256" name="alternate_phone_number" data-validate>
                                            </div><!--end col-->
                                            <div class="xl:col-span-4">
                                                <label for="emailAddressInput"
                                                    class="inline-block mb-2 text-base font-medium">Correo Electronico
                                                    (alternativo)</label>
                                                <input type="email" id="emailAddressInput"
                                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-slate-300 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                                                    placeholder="test@gmail.com" name="email" data-validate>
                                            </div><!--end col-->
                                            <div class="xl:col-span-12">
                                                <label for="streetAddressInput"
                                                    class="inline-block mb-2 text-base font-medium">Dirección</label>
                                                <input type="text" id="streetAddressInput"
                                                    class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-slate-300 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300"
                                                    placeholder="Av. Arequipa 123, Miraflores, Lima" name="address"
                                                    data-validate>
                                            </div><!--end col-->
                                            <div class="xl:col-span-4">
                                                <label for="townCityInput"
                                                    class="inline-block mb-2 text-base font-medium">Departamento</label>
                                                <x-select data-custom_select2 name="state" data-validate
                                                    id="select-department">
                                                    <option value="">Selecciona una opción</option>
                                                </x-select>
                                            </div><!--end col-->
                                            <div class="xl:col-span-4">
                                                <label for="stateInput"
                                                    class="inline-block mb-2 text-base font-medium">Provincia</label>
                                                <x-select data-custom_select2 name="city" data-validate
                                                    id="select-province">
                                                    <option value="">Selecciona una opción</option>
                                                </x-select>
                                            </div><!--end col-->
                                            <div class="xl:col-span-4">
                                                <label for="zipcodeInput"
                                                    class="inline-block mb-2 text-base font-medium">Distrito</label>
                                                <x-select data-custom_select2 name="district" data-validate
                                                    id="select-district">
                                                    <option value="">Selecciona una opción</option>
                                                </x-select>
                                            </div><!--end col-->
                                        </div><!--end grid-->
                                    </div>
                                </div><!--end card-->

                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="mb-4 text-15">Metodos de Pago disponibles</h6>

                                        <div class="payment-methods">
                                            @php
                                                $contador = 0;
                                            @endphp
                                            @foreach ($paymentMethods as $payment)
                                                <div class="flex items-center gap-3">
                                                    <input id="deliveryOption{{ $contador }}"
                                                        class="border rounded-full appearance-none cursor-pointer size-4 bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-purple-500 checked:border-purple-500 dark:checked:bg-purple-500 dark:checked:border-purple-500 checked:disabled:bg-purple-400 checked:disabled:border-purple-400 peer"
                                                        type="radio" name="deliveryChoose" value="{{ $payment->description }}"
                                                        checked="">
                                                    <label for="deliveryOption{{ $contador }}"
                                                        class="flex flex-col gap-4 p-5 border rounded-md cursor-pointer md:flex-row border-slate-200 dark:border-zink-500 peer-checked:border-purple-500 dark:peer-checked:border-purple-700 grow">
                                                        <figure>
                                                            <img src="{{ asset('storage/uploads/' . getCompanyCode() . '/' . $payment->image) }}"
                                                                alt="">
                                                            <figcaption>
                                                                {{ $payment->description }}
                                                            </figcaption>
                                                        </figure>
                                                    </label>
                                                </div>
                                                @php
                                                    $contador++;
                                                @endphp
                                            @endforeach
                                            {{-- <div class="payment-methods">
                                            @foreach ($paymentMethods as $payment)
                                                <figure>
                                                    <img src="{{ asset('storage/uploads/' . getCompanyCode() . '/' . $payment->image) }}"
                                                        alt="">
                                                    <figcaption>
                                                        {{ $payment->description }}
                                                    </figcaption>
                                                </figure>
                                            @endforeach
                                        </div> --}}
                                        </div>
                                    </div>
                                </div><!--end card-->
                            </div><!--end col-->
                            <div class="xl:col-span-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="mb-4 text-15">Resumen de pedidos</h6>
                                        <div
                                            class="px-4 py-3 mb-4 text-sm text-green-500 border border-transparent rounded-md bg-green-50 dark:bg-green-400/20">
                                            ¡Aprovecha nuestros productos en oferta!
                                        </div>
                                        <div class="overflow-x-auto">
                                            <table class="w-full">
                                                <tbody id="containerShoppingCart">

                                                </tbody>
                                                <tfoot id="detailsContainerShoppingCart">
                                                    <tr class="font-semibold">
                                                        <td
                                                            class="px-3.5 pt-3 first:pl-0 last:pr-0 text-slate-500 dark:text-zink-200">
                                                            Total:
                                                        </td>
                                                        <td
                                                            class="px-3.5 pt-3 first:pl-0 last:pr-0 ltr:text-right rtl:text-left total">

                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit"
                                                class="text-white btn w-full bg-green-500 border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:ring-green-400/10">
                                                <span class="align-middle">Terminar Compra</span> <i
                                                    data-lucide="move-right"
                                                    class="inline-block align-middle size-4 ltr:ml-1 rtl:mr-1 rtl:rotate-180"></i></button>
                                        </div>
                                    </div>
                                </div>

                            </div><!--end col-->
                        </div><!--end grid-->
                    </form>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
        </div>
    </section>
    <!-- ==== end Checkout Section ==== -->

    <template id="templateProductShoppingCart">
        <tr>
            <td class="px-3.5 py-4 border-b border-dashed first:pl-0 last:pr-0 border-slate-200 dark:border-zink-500">
                <div class="flex items-center gap-3">
                    <div class="flex items-center justify-center rounded-md size-12 bg-slate-100 shrink-0">
                        <img src="assets/images/img-08.png" alt="" class="h-8">
                    </div>
                    <div class="grow">
                        <h6 class="mb-0 text-15"><a href="apps-ecommerce-product-overview.html"
                                class="transition-all duration-300 ease-linear hover:text-custom-500">Roar
                                Twill Blue Baseball Cap</a></h6>
                        <div class="fs-nine text-sm text-slate-500" style="line-height: 100%;"><strong
                                class="fs-nine fw_600" style="line-height: 110%">
                                Calidad:</strong> Importado
                        </div>
                        <div class="fs-nine text-sm text-slate-500 mb-1" style="line-height: 100%;"><strong
                                class="fs-nine fw_600" style="line-height: 110%">
                                Calidad:</strong> Importado
                        </div>
                        <p class="text-slate-500 dark:text-zink-200">$149.99 x
                            02</p>
                    </div>

                </div>

            </td>
            <td
                class="px-3.5 py-4 border-b border-dashed first:pl-0 last:pr-0 border-slate-200 dark:border-zink-500 ltr:text-right rtl:text-left">
                $299.98</td>
        </tr>
    </template>
@endsection

@section('scripts')
    <script src="{{ URL::to('assets/js/custom/webpage/checkout.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/webpage/products.js') }}"></script>
@endsection
