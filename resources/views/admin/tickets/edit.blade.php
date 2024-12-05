@extends('layouts.master')

@section('content')
    <!-- Page-content -->
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">ProducSorteostos</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboards</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Sorteos
                    </li>
                </ul>
            </div>
            <div class="card bg-white">
                <div class="card-body">
                    <form id="formActRaffles">
                        <div class="flex flex-col md:flex-row justify-center w-full gap-5">
                            <div class="w-full md:w-2/4">

                                <label class="inline-block mb-2 text-base font-medium">Título</label>
                                <x-input type="text" data-validate name="title" value="{{ $raffles->title }}" />
                                <input type="hidden" value="{{ $raffles->id }}" name="id">

                                <label class="inline-block mb-2 text-base font-medium">Precio por ticket</label>
                                <x-input type="number" name="ticket_price" class="mb-3"
                                    value="{{ $raffles->ticket_price }}" data-validate />

                                <label class="inline-block mb-2 text-base font-medium">Fecha limite de compra</label>
                                <x-input type="date" name="end_date" value="{{ $raffles->end_date->format('Y-m-d') }}"
                                    placeholder="https://tiktok" data-validate />

                                <label class="inline-block mb-2 text-base font-medium">Fecha de sorteo</label>
                                <x-input type="datetime-local" name="draw_date"
                                    value="{{ $raffles->draw_date ? $raffles->draw_date->format('Y-m-d\TH:i') : '' }}"
                                    placeholder="Selecciona fecha y hora" data-validate />

                                <label class="inline-block mb-2 text-base font-medium">Ganador</label>
                                <x-select name="winner_id" data-choices="" class="mb-2">
                                    <option value="">Selecciona una opción</option>
                                    @foreach ($webUsers as $user)
                                        <option value="{{ $user->id }}"
                                            {{ $user->id == $raffles->winner_id  ? 'selected' : '' }}>
                                            {{ $user->names . ' ' . $user->surnames }}
                                        </option>
                                    @endforeach
                                </x-select>

                                <label class="inline-block mb-2 text-base font-medium">Imagen del ganador</label>
                                <input type="file" name="winner_image"
                                    class="cursor-pointer form-file border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">

                                <label class="inline-block mb-2 text-base font-medium">Descripción</label>
                                <div class="ckeditor-inline">{!! $raffles->description !!}</div>

                                <div class="flex items-center gap-2 mt-3">
                                    <input id="checkboxDefault24"
                                        class="border rounded-sm appearance-none cursor-pointer size-4 bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-sky-500 checked:border-sky-500 dark:checked:bg-sky-500 dark:checked:border-sky-500 checked:disabled:bg-sky-400 checked:disabled:border-sky-400"
                                        type="checkbox" value="1" name="is_visible"
                                        {{ $raffles->is_visible == 1 ? 'checked' : '' }}>
                                    <label for="checkboxDefault24" class="align-middle">
                                        Visible en página web
                                    </label>
                                </div>

                            </div>
                            <div class="w-full md:w-2/4">
                                <div
                                    class="w-full bg-custom-50 dark:bg-custom-500/10 p-3 mt-3 rounded flex justify-between items-center">
                                    <span class="font-bold">Caracteristicas del sorteo</span>
                                    <x-button type="button" color="warning" description="Nueva variante" id="btnNewFeature"
                                        :outline="false" />
                                </div>
                                <div class="">
                                    <table class="w-full bg-custom-50 dark:bg-custom-500/10">
                                        <thead class="ltr:text-left rtl:text-right bg-custom-100 dark:bg-custom-500/10">
                                            <tr>
                                                <th
                                                    class="px-3.5 py-2.5 font-semibold border-b border-custom-200 dark:border-custom-900">
                                                    Icono
                                                </th>
                                                <th
                                                    class="px-3.5 py-2.5 font-semibold border-b border-custom-200 dark:border-custom-900">
                                                    Titulo
                                                </th>
                                                <th
                                                    class="px-3.5 py-2.5 font-semibold border-b border-custom-200 dark:border-custom-900">
                                                    Descripción
                                                </th>
                                                <th
                                                    class="px-3.5 py-2.5 font-semibold border-b border-custom-200 dark:border-custom-900">
                                                    -
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="containerFeatures">
                                        </tbody>
                                    </table>
                                </div>

                                <h6 class="mb-4 text-15">Imagenes</h6>
                                <div
                                    class="flex items-center justify-center border rounded-md cursor-pointer bg-slate-100 dropzoneAct border-slate-200 dark:bg-zink-600 dark:border-zink-500">
                                    <div class="fallback">
                                        <input type="file" data-validate id="imagesMultiple" multiple="multiple">
                                    </div>
                                    <div class="w-full py-5 text-lg text-center dz-message needsclick">
                                        <div class="mb-3">
                                            <i data-lucide="upload-cloud"
                                                class="block mx-auto size-12 text-slate-500 fill-slate-200 dark:text-zink-200 dark:fill-zink-500"></i>
                                        </div>

                                        <h5 class="mb-0 font-normal text-slate-500 text-15">Inserta tu imagenes aquí</h5>
                                    </div>
                                </div>
                                <ul class="mb-0" id="dropzone-preview">
                                    <li class="mt-2" id="dropzone-preview-list">
                                        <!-- This is used as the file preview template -->
                                        <div class="border rounded border-slate-200 dark:border-zink-500">
                                            <div class="flex p-2">
                                                <div class="shrink-0 me-3">
                                                    <div class="p-2 rounded-md size-14 bg-slate-100 dark:bg-zink-600">
                                                        <img data-dz-thumbnail="" class="block w-full h-full rounded-md"
                                                            src="data:image/png;base64,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"
                                                            alt="Dropzone-Image">
                                                    </div>
                                                </div>
                                                <div class="grow">
                                                    <div class="pt-1">
                                                        <h5 class="mb-1 text-15" data-dz-name="">&nbsp;</h5>
                                                        <p class="mb-0 text-slate-500 dark:text-zink-200" data-dz-size="">
                                                        </p>
                                                        <strong class="error text-danger"
                                                            data-dz-errormessage=""></strong>
                                                    </div>
                                                </div>
                                                <div class="shrink-0 ms-3">
                                                    <button data-dz-remove=""
                                                        class="px-2 py-1.5 text-xs text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20">Quitar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="text-right">
                            <x-button type="submit" color="primary" class="mt-3" description="Guardar"
                                :outline="false" />
                        </div>
                        <template id="templateFeatures">
                            <tr>
                                <td class="px-3.5 py-2.5 border-y border-custom-200 dark:border-custom-900">
                                    <x-select name="measurement_unit_id" id="selectIconsAct" class="choices m-0 p-0"
                                        data-choices="" data-validate name="measurement_unit_id">
                                        <option value="">Seleccione</option>
                                    </x-select>
                                    <input type="hidden" value="">
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-custom-200 dark:border-custom-900">
                                    <x-input type="text" name="min_stock" class="mb-3" data-validate />
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-custom-200 dark:border-custom-900">
                                    <x-input type="text" name="min_stock" class="mb-3" data-validate />
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-custom-200 dark:border-custom-900">
                                    <a href="#!"
                                        class="transition-all duration-150 ease-linear text-custom-500 hover:text-custom-600">
                                        <i class="ri-close-line text-red-500 btnRemoveFeature"></i>
                                    </a>
                                </td>
                            </tr>
                        </template>
                    </form>

                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @php
        $arrayCharacteristics = json_decode($raffles->raffleCharasteristics);

        // Ruta donde están almacenadas las imágenes
        $imageDirectory = storage_path('app/public/uploads/');

        // Imágenes y sus tamaños
        $images = json_decode($raffles->images); // Array de nombres de archivo
        $imageDetails = [];

        foreach ($images as $image) {
            $filePath = $imageDirectory . $image->path;
            if (file_exists($filePath)) {
                $imageDetails[] = [
                    'name' => $image->path,
                    'size' => filesize($filePath), // Tamaño en bytes
                    'url' => '/storage/uploads/' . $image->path,
                    'description' => $image->description,
                    'status' => filter_var($image->status, FILTER_VALIDATE_BOOLEAN),
                ];
            }
        }
    @endphp
    <script>
        const arrayCharacteristics = @json($arrayCharacteristics);
        console.log('arrayCharacteristics :>> ', arrayCharacteristics);

        window.addEventListener("load", () => {
            arrayCharacteristics.forEach(characteristic => {
                agregarTemplate("templateFeatures", "containerFeatures", characteristic)
            });
        })

        document.addEventListener('DOMContentLoaded', async function() {
            let dropzonePreviewNode = document.querySelector("#dropzone-preview-list");
            dropzonePreviewNode.id = "";
            let previewTemplate = dropzonePreviewNode.parentNode.innerHTML;
            dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode);

            let dropzoneAct = new Dropzone(".dropzoneAct", {
                url: 'https://httpbin.org/post',
                method: "post",
                previewTemplate: previewTemplate,
                previewsContainer: "#dropzone-preview",
                clickable: ".dropzoneAct",
            });

            dropzoneAct.on("addedfile", (file) => {
                if (!file.isMock) {
                    let inpoutsToUpload = generateInpoutsToUpload();
                    file.previewElement.appendChild(inpoutsToUpload);
                }
            });

            // Convertir el array de PHP a un objeto JavaScript
            let existingFiles = @json($imageDetails);

            // Iterar sobre los archivos existentes y agregarlos a Dropzone
            existingFiles.forEach(function(file) {
                let mockFile = {
                    name: file.name,
                    size: file.size, // Tamaño en bytes
                    url: file.url, // La URL completa de la imagen
                    isMock: true
                };

                // Emite los eventos de Dropzone para añadir el archivo
                dropzoneAct.emit("addedfile", mockFile);
                dropzoneAct.emit("thumbnail", mockFile, file.url);
                dropzoneAct.emit("complete", mockFile);

                // Añadir el archivo a la lista de archivos de Dropzone
                dropzoneAct.files.push(mockFile);

                // Generar y agregar los inputs con valores precargados
                let inpoutsToUpload = generateInpoutsToUpload(file.description, file.status);
                mockFile.previewElement.appendChild(inpoutsToUpload);
            });

            document.addEventListener("submit", async (e) => {
                if (e.target.matches("#formActRaffles")) {
                    e.preventDefault();

                    if (!FormValidate("formActRaffles")) {
                        toastAlert("Algunos campos son necesarios", "warning")
                        return;
                    }

                    const formData = new FormData(e.target);

                    let editorElement = document.querySelector(".ck-editor__editable");
                    let contenido = editorElement.innerHTML;

                    let validateCheckboxs = validateSingleCheckbox();
                    if (!validateCheckboxs[0]) {
                        return toastAlert(validateCheckboxs[1], "warning")
                    }
                    // Verifica todos los checkboxes
                    e.target.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                        if (!checkbox.checked) {
                            formData.append(checkbox.name, '0');
                        }
                    });

                    const rowsVariants = document.querySelectorAll("#containerFeatures tr");
                    let arrayVariants = [];
                    rowsVariants.forEach(tr => {
                        let inputs = tr.querySelectorAll("input");
                        console.log('inputs :>> ', inputs);
                        let variant = {
                            "iconName": tr.querySelector("select").value,
                            "idFeature": inputs[1].value,
                            "title": inputs[2].value,
                            "description": inputs[3].value,
                        }
                        arrayVariants.push(variant)
                    });

                    formData.append("description", contenido);
                    formData.append("RaffleFeatures", JSON.stringify(arrayVariants));

                    console.log('RaffleFeatures :>> ', JSON.stringify(arrayVariants));

                    for (const file of dropzoneAct.files) {
                        console.log("Procesando archivo:", file.name);

                        let fileToUpload = file;

                        if (!(file instanceof File)) {
                            const response = await fetch(file.url);
                            const blob = await response.blob();
                            fileToUpload = new File([blob], file.name, {
                                type: blob.type
                            });
                        }

                        const descriptionInput = file.previewElement.querySelector(
                            '.description-input');
                        const StatusImage = file.previewElement.querySelector('.status-image');

                        if (descriptionInput) {
                            formData.append("imageDescriptions[]", descriptionInput.value);
                            formData.append("imageStatus[]", StatusImage.checked);
                        }

                        formData.append("RaffleImages[]", fileToUpload);
                    }

                    formData.append('_method', 'PUT');

                    for (let [key, value] of formData.entries()) {
                        console.log(key, value);
                    }

                    try {
                        console.log(ROUTES.RAFFLES + `/${e.target.id.value}`);

                        let response = await customFetch(
                            ROUTES.RAFFLES + `/${e.target.id.value}`,
                            "POST",
                            formData
                        );
                        console.log('response :>> ', response);
                        if (response.status === "success") {
                            boxAlert("Actualizado con exito!", "success")
                        } else {
                            boxAlertValidation(response.errors)
                        }
                    } catch (error) {
                        console.error('Error de red:', error);
                    }

                }
            })
        });
    </script>
@endsection

@section('script')
    <script src="{{ URL::to('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

    <script src="{{ URL::to('assets/libs/%40ckeditor/ckeditor5-build-inline/build/ckeditor.js') }}"></script>
    <script src="{{ URL::to('assets/js/pages/form-editor-inline.init.js') }}"></script>

    <script src="{{ URL::to('assets/libs/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ URL::to('assets/js/custom/raffles.js') }}"></script>
@endsection
