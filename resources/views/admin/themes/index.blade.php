@extends('layouts.master')

@section('content')
    <!-- Page-content -->
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Temas y colores</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboards</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Temas y colores
                    </li>
                </ul>
            </div>
            <div class="card bg-white">
                <form id="formThemesUpdate">
                    <div class="card-body">
                        <div class="flex flex-col md:flex-row justify-center md:w-3/4 w-full mx-auto">
                            <div class="w-full lg:w-2/4 mx-auto">
                                <label class="inline-block mb-2 text-base font-bold">Color primario</label>
                                <div class="flex items-center mt-5">
                                    <div class="color-selector primary">
                                        <label class="color-option blue">
                                            <input type="radio" value="#A7C7E7">
                                            <span style="background: #A7C7E7"></span>
                                        </label>
                                        <label class="color-option green">
                                            <input type="radio" value="#B5EAD7">
                                            <span style="background: #B5EAD7"></span>
                                        </label>
                                        <label class="color-option red">
                                            <input type="radio" value="#D4C1EC">
                                            <span style="background: #D4C1EC"></span>
                                        </label>
                                        <label class="color-option red">
                                            <input type="radio" value="#F4C2C2">
                                            <span style="background: #F4C2C2"></span>
                                        </label>
                                    </div>
                                    <div class="ms-20">
                                        <input type="color" class="h-12 w-12" name="primary_color" id="inputPrimaryColor">
                                    </div>
                                </div>
                            </div>
                            <div class="w-full lg:w-2/4 mx-auto">
                                <label class="inline-block mb-2 text-base font-bold">color secundario</label>
                                <div class="flex items-center mt-5">
                                    <div class="color-selector secondary">
                                        <label class="color-option blue">
                                            <input type="radio" value="#EAEAEA">
                                            <span style="background: #EAEAEA"></span>
                                        </label>
                                        <label class="color-option green">
                                            <input type="radio" value="#F3EACB">
                                            <span style="background: #F3EACB"></span>
                                        </label>
                                        <label class="color-option red">
                                            <input type="radio" value="#D9D9D9">
                                            <span style="background: #D9D9D9"></span>
                                        </label>
                                        <label class="color-option red">
                                            <input type="radio" value="#F7F5F2">
                                            <span style="background: #F7F5F2"></span>
                                        </label>
                                    </div>
                                    <div class="ms-20">
                                        <input type="color" class="h-12 w-12" name="secondary_color" id="inputSecondaryColor">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="flex flex-col md:flex-row justify-end md:w-3/4 w-full mx-auto pt-10">
                            <div class="text-right">
                                <x-button type="submit" color="primary" class="mt-3" description="Guardar"
                                    :outline="false" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    @endsection


    @section('script')
        <script src="{{ URL::to('assets/libs/dropzone/dropzone-min.js') }}"></script>
        <script src="{{ URL::to('assets/js/custom/themes.js') }}"></script>
    @endsection
