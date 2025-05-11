@extends('layouts.master')

@section('content')
    <!-- Page-content -->
    @php
        //dd($product)
    @endphp
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto" data-page_edit>
            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Productos</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li
                        class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboards</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Productos
                    </li>
                </ul>
            </div>
            <div class="card bg-white">
                <div class="card-body">
                    <form id="formActProducts">
                        <div class="flex flex-col md:flex-row justify-center w-full gap-5">
                            <div class="w-full md:w-2/4">
                                <label class="inline-block mb-2 text-base font-medium">Título</label>
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <x-input type="text" placeholder="Comedero para aves" value="{{ $product->title }}"
                                    data-validate name="title" />
                                @error('title')
                                    <p class="mt-0 text-sm text-red-500">{{ $message }}</p>
                                @enderror

                                <label class="inline-block mb-2 text-base font-medium">Marca</label>
                                <x-select data-custom_select2 name="product_brand_id" data-validate>
                                    <option value="">Selecciona una opción</option>
                                    @foreach ($productBrands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ $brand->id == $product->product_brand_id ? 'selected' : '' }}>
                                            {{ $brand->description }}
                                        </option>
                                    @endforeach
                                </x-select>

                                <label class="inline-block text-base font-medium">Categoría</label>
                                <x-select data-custom_select2 name="category_product_id" data-validate>
                                    <option value="">Selecciona una opción</option>
                                    @foreach ($categoryProducts as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $product->category_product_id ? 'selected' : '' }}>
                                            {{ $category->description }}
                                        </option>
                                    @endforeach
                                </x-select>

                                <label class="inline-block mb-2 text-base font-medium">Sub Categoría</label>
                                <x-select data-custom_select2 name="category_product_id" data-validate>
                                    <option value="">Selecciona una opción</option>
                                    @foreach ($subCategoryProducts as $subcategory)
                                        <option value="{{ $subcategory->id }}"
                                            {{ $subcategory->id == $product->subcategory_product_id ? 'selected' : '' }}>
                                            {{ $subcategory->description }}
                                        </option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div class="w-full md:w-2/4">

                                <label class="inline-block mb-2 text-base font-medium">Stock mínimo</label>
                                <x-input type="number" name="min_stock" value="{{ $product->min_stock }}" placeholder="2"
                                    class="mb-3" data-validate />

                                <h6 class="mb-4 text-15">Imagenes</h6>
                                <div id="dropzoneContainerAct" class="dropzone-container" style="max-width: 1000px">
                                    <div id="dropzoneAct">
                                        Arrastra tus imágenes aquí.
                                    </div>
                                    <div id="dropzonePreviewAct" class="dropzone-previews"></div>
                                </div>
                                <div class="flex flex-wrap gap-2 mt-3">
                                    <div class="flex items-center gap-2">
                                        <input id="checkboxDefault24"
                                            class="border rounded-sm appearance-none cursor-pointer size-4 bg-slate-100 border-slate-200 dark:bg-zink-600 dark:border-zink-500 checked:bg-sky-500 checked:border-sky-500 dark:checked:bg-sky-500 dark:checked:border-sky-500 checked:disabled:bg-sky-400 checked:disabled:border-sky-400"
                                            type="checkbox" value="1" name="status_on_website"
                                            {{ $product->status_on_website == 1 ? 'checked' : '' }}>
                                        <label for="checkboxDefault24" class="align-middle">
                                            Visible en página web
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="inline-block mb-2 text-base font-medium">Descripción</label>
                            <div class="ckeditor-classic text-slate-800">
                                {!! $product->description !!}
                            </div>
                        </div>

                        <div>
                            <div
                                class="w-full bg-custom-50 dark:bg-custom-500/10 p-3 mt-3 rounded flex justify-between items-center">
                                <span class="font-bold">Variantes del producto</span>
                                <x-button type="button" color="warning" description="Nueva variante" id="btnNewVariant"
                                    :outline="false" />
                            </div>
                            <div class="overflow-auto">
                                <table class="w-full bg-custom-50 dark:bg-custom-500/10">
                                    <thead class="ltr:text-left rtl:text-right bg-custom-100 dark:bg-custom-500/10">
                                        <tr>
                                            @foreach ($attributeGroups as $attributeGroup)
                                                <th
                                                    class="px-3.5 py-2.5 font-semibold border-b border-custom-200 dark:border-custom-900">
                                                    {{ $attributeGroup->description }}
                                                </th>
                                            @endforeach
                                            <th
                                                class="px-3.5 py-2.5 font-semibold border-b border-custom-200 dark:border-custom-900">
                                                Referencia
                                            </th>
                                            <th
                                                class="px-3.5 py-2.5 font-semibold border-b border-custom-200 dark:border-custom-900">
                                                Precio
                                            </th>
                                            <th
                                                class="px-3.5 py-2.5 font-semibold border-b border-custom-200 dark:border-custom-900">
                                                Stock
                                            </th>
                                            <th
                                                class="px-3.5 py-2.5 font-semibold border-b border-custom-200 dark:border-custom-900">
                                                Activo
                                            </th>
                                            <th
                                                class="px-3.5 py-2.5 font-semibold border-b border-custom-200 dark:border-custom-900">
                                                -
                                            </th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody id="containerProductVariants">
                                        @foreach ($product->productAttributes as $productAttribute)
                                            <tr>
                                                @foreach ($attributeGroups as $attributeGroup)
                                                    <td
                                                        class="px-3.5 py-2.5 border-y border-custom-200 dark:border-custom-900">
                                                        @foreach ($productAttribute->attributesCombination as $attributeCombination)
                                                            @if ($attributeCombination->attribute->attribute_group_id == $attributeGroup->id)
                                                                <x-input type="text" placeholder="2" class=""
                                                                    value="{{ $attributeCombination->attribute->description }}"
                                                                    readonly data-validate />
                                                            @endif
                                                        @endforeach
                                                        <input type="hidden" value="{{ $productAttribute->id }}"
                                                            name="idProductAttribute">
                                                    </td>
                                                @endforeach

                                                <td
                                                    class="px-3.5 py-2.5 font-semibold border-b border-custom-200 dark:border-custom-900">
                                                    <x-input type="text" name="reference" placeholder="2" class=""
                                                        data-validate value="{{ $productAttribute->reference }}" />
                                                </td>
                                                <td
                                                    class="px-3.5 py-2.5 font-semibold border-b border-custom-200 dark:border-custom-900">
                                                    <x-input type="number" step="0.01" name="default_price"
                                                        placeholder="2" class="" data-validate
                                                        value="{{ $productAttribute->default_price }}" />
                                                </td>
                                                <td
                                                    class="px-3.5 py-2.5 font-semibold border-b border-custom-200 dark:border-custom-900">
                                                    <x-input type="number" name="stock" placeholder="2" class=""
                                                        data-validate value="{{ $productAttribute->stock }}" />
                                                </td>
                                                <td
                                                    class="px-3.5 py-2.5 font-semibold border-b border-custom-200 dark:border-custom-900 text-center">
                                                    <input type="radio" name="is_default" class="radio-default-variant"
                                                        @if ($productAttribute->is_default) checked @endif>
                                                </td>
                                                <td
                                                    class="px-3.5 py-2.5 border-y border-custom-200 dark:border-custom-900">
                                                    <a href="#!"
                                                        class="transition-all duration-150 ease-linear text-custom-500 hover:text-custom-600">
                                                        <i class="ri-close-line text-red-500 btnRemoveVariant"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="text-right">
                            <x-button type="submit" color="primary" class="mt-3" description="Guardar"
                                :outline="false" />
                        </div>
                        <template id="templateProductVariants">
                            <tr>
                                @foreach ($attributeGroups as $attributeGroup)
                                    <td class="px-3.5 py-2.5 border-y border-custom-200 dark:border-custom-900">
                                        <x-select name="variant" id="choices-single-default">
                                            <option value="" selected disabled>Seleccione</option>
                                            @foreach ($attributeGroup->attributes as $attribute)
                                                <option value="{{ $attribute->id }}">{{ $attribute->description }}
                                                </option>
                                            @endforeach
                                        </x-select>
                                    </td>
                                @endforeach
                                <td class="px-3.5 py-2.5 font-semibold border-b border-custom-200 dark:border-custom-900">
                                    <x-input type="text" name="reference" placeholder="2" class=""
                                        data-validate />
                                    <input type="hidden" value="" name="idProductAttribute">
                                </td>
                                <td class="px-3.5 py-2.5 font-semibold border-b border-custom-200 dark:border-custom-900">
                                    <x-input type="number" step="0.01" name="default_price" placeholder="2"
                                        class="" data-validate />
                                </td>
                                <td class="px-3.5 py-2.5 font-semibold border-b border-custom-200 dark:border-custom-900">
                                    <x-input type="number" name="stock" placeholder="2" class=""
                                        data-validate />
                                </td>
                                <td
                                    class="px-3.5 py-2.5 font-semibold border-b border-custom-200 dark:border-custom-900 text-center">
                                    <input type="radio" name="is_default" class="radio-default-variant"
                                        value="1">
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-custom-200 dark:border-custom-900">
                                    <a href="#!"
                                        class="transition-all duration-150 ease-linear text-custom-500 hover:text-custom-600">
                                        <i class="ri-close-line text-red-500 btnRemoveVariant"></i>
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

    <!-- Template de Previsualización -->
    <script type="text/template" id="preview-template">
        <div class="dz-preview dz-file-preview">
            <div class="dz-image">
                <img data-dz-thumbnail />
            </div>
            <div class="dz-details">
                <div class="dz-filename"><span data-dz-name></span></div>
                <div class="dz-size" data-dz-size></div>
            </div>

            <input type="radio" name="check_main_image" class="primary-image-checkbox" data-tooltip="default" data-tooltip-content="test tooltip"/>
            <i class="ri-close-line dz-remove-button"></i>
                
        </div>
    </script>
    <!-- End Page-content -->
@endsection

@section('script')
    <script src="{{ URL::to('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ URL::to('assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
    <script src="{{ URL::to('assets/js/pages/form-editor-classic.init.js') }}"></script>
    <script src="{{ URL::to('assets/libs/dropzone/dropzone-min.js') }}"></script>
    {{-- <script src="{{ URL::to('assets/js/pages/form-file-upload.init.js') }}"></script> --}}
    <script src="{{ URL::to('assets/js/custom/products.js') }}"></script>
@endsection
