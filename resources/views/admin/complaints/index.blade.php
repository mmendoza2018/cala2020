use Illuminate\Support\Facades\URL;
@extends('layouts.master')

@section('content')
    <!-- Page-content -->
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Reclamaciones</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboards</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Reclamaciones
                    </li>
                </ul>
            </div>
            <div class="card bg-white">
                <div class="card-body">
                    <table id="tableComplaints" class="display stripe group" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombres</th>
                                <th>Tipo documento</th>
                                <th>número documento</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Tipo</th>
                                <th>Fecha de reclamo</th>
                                <th>Fecha de repuesta</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($complaints as $complaint)
                                <tr>
                                    <td>{{ $complaint->id }}</td>
                                    <td>{{ $complaint->first_name . ' ' . $complaint->last_name . ' ' . $complaint->second_last_name }}
                                    </td>
                                    <td>{{ $complaint->document_type }}</td>
                                    <td>{{ $complaint->document_number }}</td>
                                    <td>{{ $complaint->phone_number }}</td>
                                    <td>{{ $complaint->email }}</td>
                                    <td>{{ $complaint->claim_type }}</td>
                                    <td>{{ $complaint->created_at }}</td>
                                    <td>{{ $complaint->response_date }}</td>
                                    <td class="text-center">
                                        @if (!$complaint->response)
                                            <a href="#" data-modal-target="modalOrdersDetail"
                                                onclick="setIdComplaint('{{ $complaint->id }}')">
                                                <i class="ri-edit-box-fill ri-xl cursor-pointer"></i>
                                            </a>
                                        @endif
                                        <a href="#" onclick="generatePDF('{{ $complaint->id }}')">
                                            <i class="ri-file-3-fill ri-xl cursor-pointer"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    <!-- Modal add cash register-->
    <div id="modalOrdersDetail" modal-center=""
        class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
        <div class="w-screen md:w-[30rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
            <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
                <h5 class="text-16">Actualizar</h5>
                <button data-modal-close="modalOrdersDetail"
                    class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500"><i
                        data-lucide="x" class="size-5"></i></button>
            </div>
            <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                <form id="formActComplaint">
                    <label class="inline-block mb-2 text-base font-medium">Respuesta o solución planteada</label>
                    <textarea
                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        id="textArea" rows="5" name="response"></textarea>
                    <input type="hidden" id="idComplaint" name="id">
                    <div class="text-right">
                        <x-button type="submit" color="primary" class="mt-3"
                            description="Guardar y remitir documento por EMAIL" :outline="false" />
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::to('assets/js/datatables/jquery-3.7.0.js') }}"></script>
    <script src="{{ URL::to('assets/js/datatables/data-tables.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/complaint.js') }}"></script>
@endsection
