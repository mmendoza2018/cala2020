@extends('layouts.master')

@section('content')
    <!-- Page-content -->
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Redes sociales</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboards</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Redes sociales
                    </li>
                </ul>
            </div>
            <div class="card bg-white">
                <div class="card-body">
                    <div class="w-full md:w-2/4 mx-auto">
                        <form id="formActSocialNetwork">

                            <div class="w-full mx-auto">
                                <div class="text-end">
                                    <x-button type="button" color="warning" class="my-3" description="Añadir otro número"
                                        :outline="false" id="btnAddAttencionNumber" />
                                </div>
                                <div class="table-responsive">
                                    <table class="w-full">
                                        <thead class="ltr:text-left rtl:text-right">
                                            <tr>
                                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500"
                                                    style="min-width: 250px">
                                                    Icono</th>
                                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500"
                                                    style="min-width: 250px">
                                                    Link</th>
                                                <th
                                                    class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">
                                                    -</th>
                                            </tr>
                                        </thead>
                                        <tbody id="containerSocialNetwork">
                                            {{-- INNER HTML --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="text-right">
                                <x-button type="submit" color="primary" class="mt-3" description="Guardar"
                                    :outline="false" />
                            </div>

                        </form>
                    </div>
                </div>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <template id="templateSocialNetwork">
            <tr>
                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                    <div class="flex justify-center items-center">
                        <select id="icon-select" class="socialSelect" style="width: 100%">
                            <option></option>
                            <option value="Facebook" data-icon="<i class='ri-facebook-circle-fill ri-lg'></i>">Facebook</option>
                            <option value="Instagram" data-icon="<i class='ri-instagram-fill ri-lg'></i>">Instagram</option>
                            <option value="LinkedIn" data-icon="<i class='ri-linkedin-box-fill ri-lg'></i>">LinkedIn</option>
                            <option value="Telegram" data-icon="<i class='ri-telegram-fill ri-lg'></i>">Telegram</option>
                            <option value="Tik Tok" data-icon="<i class='ri-tiktok-fill ri-lg'></i>">Tik Tok</option>
                            <option value="Youtube" data-icon="<i class='ri-youtube-fill ri-lg'></i>">Youtube</option>
                        </select>
                    </div>
                </td>
                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                    <div class="flex justify-center items-center">
                        <span class="icon_attention_number">
                            <i class="ri-global-line ri-lg"></i>
                        </span>
                        <x-input type="text" data-validate class="link" />
                        <input type="hidden" class="id">
                    </div>
                </td>
                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                    <i class="ri-close-line ri-xl btnRemoveAttencionNumber text-red-500" style="cursor: pointer"></i>
                </td>
            </tr>
        </template>
    @endsection


    @section('script')
        <script src="{{ URL::to('assets/js/custom/social_network.js') }}"></script>
    @endsection
