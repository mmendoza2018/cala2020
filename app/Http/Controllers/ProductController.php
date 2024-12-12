<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\AttributeGroup;
use App\Models\CategoryProduct;
use App\Models\MeasurementUnit;
use App\Models\PriceType;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeCombination;
use App\Models\ProductBrand;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function create()
    {
        $productBrands = ProductBrand::where('status', 1)->get();
        $categoryProducts = CategoryProduct::where('status', 1)->get();
        $attributeGroups = AttributeGroup::where('status', 1)
            ->whereHas('attributes', function ($query) {
                $query->where('status', 1); // Filtro en la relación
            })
            ->with(['attributes' => function ($query) {
                $query->where('status', 1); // Asegura que solo se traigan atributos con status 1
            }])
            ->get();

        return view(
            'admin.products.create',
            compact('productBrands', 'categoryProducts', 'attributeGroups')
        );
    }

    public function show($id, Request $request)
    {
        $product = Product::with(['productBrand', 'measurementUnit', 'categoryProduct'])
            ->where('status', 1)->findOrFail($id);

        if ($request->expectsJson()) {
            return ApiResponse::success($product, "Registro encontrado");
        }

        return view('product.show', compact('product'));
    }

    public function index()
    {
        $products = Product::with(['productBrand', 'measurementUnit', 'categoryProduct'])
            ->where('status', 1)
            ->get();
        return view('admin.products.index', [
            "products" => $products,
        ]);
    }

    public function edit($id)
    {
        $measurementUnits = MeasurementUnit::where('status', 1)->get();
        $productBrands = ProductBrand::where('status', 1)->get();
        $categoryProducts = CategoryProduct::where('status', 1)->get();
        $attributeGroups = AttributeGroup::where('status', 1) // Filtro en el modelo principal
            ->whereHas('attributes', function ($query) {
                $query->where('status', 1); // Filtro en la relación
            })
            ->with(['attributes' => function ($query) {
                $query->where('status', 1); // Asegura que solo se traigan atributos con status 1
            }])
            ->get();

        $product = Product::with(['productAttributes.attributesCombination.attribute'])->find($id);

        return view(
            'admin.products.edit',
            compact('productBrands', 'measurementUnits', 'categoryProducts', 'attributeGroups', 'product')
        );
    }


    public function store(Request $request)
    {

        $rules = [
            "title" => "required|string|min:5",
            "description" => "required",
            "productImages" => "required",
            "imageDescriptions" => "required",
            "imageStatus" => "required",
            "productVariants" => "required|json",
            "min_stock" => "required",
            "status_on_website" => "required",
            "status_on_catalog" => "required",
            'product_brand_id' => 'required|integer|exists:product_brands,id',
            "category_product_id" => "required",
        ];

        // Definir los nombres amigables de los atributos
        $attributes = [
            "title" => "Titulo",
            "description" => "Descripción",
            "ProductImages" => "Imagenes",
            "imageDescriptions" => "Descripción de imagen",
            "imageStatus" => "Estado de la imagen",
            "productVariants" => "Variantes del producto",
            "min_stock" => "Minimo de Stock",
            "status_on_website" => "Estado de la página web",
            "status_on_catalog" => "Estado del catalogo",
            'product_brand_id' => "Marca",
            "category_product_id" => "Categoria",
        ];

        // Crear el validador manualmente
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributes);

        // Validar los datos
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return ApiResponse::error("Validation Error", $errors, 202);
        }

        $slug = Str::slug($request->input('title')); // Utiliza la función helper de Laravel para convertir a slug

        // Verificar si el slug ya existe en la base de datos
        $existingSlug = Product::where('slug', $slug)->first();

        $originalSlug = $slug;
        $count = 1;

        // Si existe, añadir un número incremental para que sea único
        while ($existingSlug) {
            $slug = $originalSlug . '-' . $count;
            $count++;
            $existingSlug = Product::where('slug', $slug)->first();
        }

        // Si la validación pasa, obtener los datos validados
        $validatedData = $validator->validated();

        $archivos = $request->file('productImages');
        $paths = [];

        foreach ($archivos as $archivo) {
            $path = $archivo->store('uploads', 'public');
            $fileName = basename($path);
            $paths[] = $fileName;
        }

        // Crear el arreglo asociativo
        $arrayImgs = [];

        foreach ($paths as $index => $path) {
            $arrayImgs[] = [
                'path' => $path,
                'description' => isset($validatedData["imageDescriptions"][$index]) ? $validatedData["imageDescriptions"][$index] : '', // Usa una cadena vacía si no hay descripción
                'status' => isset($validatedData["imageStatus"][$index]) ? $validatedData["imageStatus"][$index] : false // Usa 'desconocido' si no hay estado
            ];
        }
        usort($arrayImgs, function ($a, $b) {
            // Convertir los valores de 'status' a booleanos
            $statusA = filter_var($a['status'], FILTER_VALIDATE_BOOLEAN);
            $statusB = filter_var($b['status'], FILTER_VALIDATE_BOOLEAN);

            // Ordenar de modo que los elementos con 'status' => true estén primero
            return $statusB - $statusA;
        });

        $product = Product::create([
            "title" => $validatedData["title"],
            "code" => "XX_PRODUCT",
            "description" => $validatedData["description"],
            "slug" => $slug,
            "images" => json_encode($arrayImgs),
            "min_stock" => $validatedData["min_stock"],
            "status_on_website" => $validatedData["status_on_website"],
            "status_on_catalog" => $validatedData["status_on_catalog"],
            "product_brand_id" => $validatedData["product_brand_id"],
            "category_product_id" => $validatedData["category_product_id"],
            "user_id" => Auth::guard('admin')->id()
        ]);

        $arrayProductVariants = json_decode($validatedData["productVariants"], true);

        // Recorrer cada variante enviada desde el frontend
        foreach ($arrayProductVariants as $variant) {

            // Crear el registro en product_attributes para la variante
            $productAttribute = ProductAttribute::create([
                "product_id" => $product->id,
                "reference" => $variant['reference'] ?? null,
                "stock" => $variant['stock'] ?? 0,
                "default_price" => $variant['default_price'] ?? 0,
                'is_default' => $variant['is_default'],
            ]);

            // Insertar las combinaciones de atributos seleccionados
            foreach ($variant['attributes'] as $attribute) {
                ProductAttributeCombination::create([
                    'product_attribute_id' => $productAttribute->id,
                    'attribute_id' => $attribute['id'],
                ]);
            }
        }

        $product = Product::latest()->first();

        return ApiResponse::success($product, "Agregado con exito");
    }

    public function update(Request $request, $id)
    {
        $rules = [
            "title" => "required|string|min:5",
            "description" => "",
            "productImages" => "required",
            "imageDescriptions" => "required",
            "imageStatus" => "required",
            "productVariants" => "required|json",
            "doc_paths" => "",
            "min_stock" => "required",
            "status_on_website" => "required",
            'product_brand_id' => 'required|integer|exists:product_brands,id',
            "measurement_unit_id" => "required",
            "category_product_id" => "required",
            "digital_product"=> "",
        ];

        $attributes = [
            "title" => "Titulo",
            "description" => "Descripción",
            "ProductImages" => "Imagenes",
            "imageDescriptions" => "Descripción de imagen",
            "imageStatus" => "Estado de la imagen",
            "productVariants" => "Variantes del producto",
            "doc_paths" => "Documentos",
            "min_stock" => "Minimo de Stock",
            "status_on_website" => "Estado de la página web",
            "status_on_catalog" => "Estado del catalogo",
            'product_brand_id' => "Marca",
            "measurement_unit_id" => "Unidad de medida",
            "category_product_id" => "Categoria",
            "digital_product"=> "Producto digital"
        ];

        // Crear el validador manualmente
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributes);

        // Validar los datos
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return ApiResponse::error("Validation Error", $errors, 202);
        }

        // Convertir el nuevo título a slug
        $title = $request->input('title');
        $slug = Str::slug($title);

        // Verificar si el slug ya existe en la base de datos, excluyendo el actual registro
        $existingSlug = Product::where('slug', $slug)->where('id', '!=', $id)->first();

        $originalSlug = $slug;
        $count = 1;

        // Si existe, añadir un número incremental para que sea único
        while ($existingSlug) {
            $slug = $originalSlug . '-' . $count;
            $count++;
            $existingSlug = Product::where('slug', $slug)->where('id', '!=', $id)->first();
        }

        // Si la validación pasa, obtener los datos validados
        $validatedData = $validator->validated();

        // Obtener el producto desde la base de datos
        $product = Product::findOrFail($id);

        // Obtener las imágenes actuales del producto
        $productImages = json_decode($product->images, true);
        // Obtener las nuevas imágenes enviadas en la solicitud
        $uploadedImages = $request->file('productImages');

        // Convertir las imágenes actuales en un array asociativo con el nombre como clave
        $existingImages = [];
        foreach ($productImages as $image) {
            $existingImages[$image['path']] = $image;
        }

        // Crear arrays para imágenes nuevas y a eliminar
        $imagesToUpdate = [];
        $imagesToDelete = [];
        $uploadedImageNames = [];

        // Comparar imágenes nuevas con las existentes
        $index = 0;
        foreach ($uploadedImages as $uploadedImage) {
            $path = $uploadedImage->getClientOriginalName();
            $uploadedImageNames[] = $path;

            // Si la imagen ya existe, actualiza su información
            if (array_key_exists($path, $existingImages)) {
                $existingImage = $existingImages[$path];
                $existingImage['description'] = $request->imageDescriptions[$index];
                $existingImage['status'] = $request->imageStatus[$index];
                $imagesToUpdate[] = $existingImage;
            } else {
                // Si la imagen es nueva, agrégala
                $newPath = $uploadedImage->store('uploads', 'public');
                $fileName = basename($newPath);

                $imagesToUpdate[] = [
                    "path" => $fileName,
                    "description" => $request->imageDescriptions[$index],
                    "status" => $request->imageStatus[$index]
                ];
            }

            $index++;
        }

        // Convertir los valores de 'status' a booleanos
        usort($imagesToUpdate, function ($a, $b) {
            $statusA = filter_var($a['status'], FILTER_VALIDATE_BOOLEAN);
            $statusB = filter_var($b['status'], FILTER_VALIDATE_BOOLEAN);
            return $statusB - $statusA;
        });

        // Determinar qué imágenes se deben eliminar
        foreach ($existingImages as $path => $image) {
            if (!in_array($path, $uploadedImageNames)) {
                // La imagen no está en el nuevo conjunto de imágenes, por lo que debe ser eliminada
                $imagesToDelete[] = $path;
            }
        }

        //Eliminar físicamente las imágenes no deseadas del almacenamiento
        if (!empty($imagesToDelete)) {
            foreach ($imagesToDelete as $path) {
                $filePath = storage_path('app/public/uploads/' . $path);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }
        $productData = [
            "title" => $validatedData["title"],
            "code" => "XX_PRODUCT",
            "description" => $validatedData["description"],
            "images" => json_encode($imagesToUpdate),
            "slug" => $slug,
            "min_stock" => $validatedData["min_stock"],
            "status_on_website" => intval($validatedData["status_on_website"]),
            "product_brand_id" => $validatedData["product_brand_id"],
            "measurement_unit_id" => $validatedData["measurement_unit_id"],
            "category_product_id" => $validatedData["category_product_id"],
        ];

        $product->update($productData);

        $arrayProductVariants = json_decode($validatedData["productVariants"], true);
        $currentProductAttributes = ProductAttribute::where('product_id', $id)->pluck('id')->toArray();

        // 2. Crear un array para almacenar los ids de los atributos recibidos
        $receivedAttributeIds = [];

        // 3. Procesar cada elemento del arreglo recibido del front
        foreach ($arrayProductVariants as $data) {
            if (empty($data['idProductAttribute'])) {
                // Si el idProductAttribute está vacío, creamos un nuevo registro
                $productAttribute = ProductAttribute::create([
                    'product_id'    => $id,
                    'reference'     => $data['reference'],
                    'default_price' => $data['default_price'],
                    'stock'         => $data['stock'],
                    'is_default'    => $data['is_default']
                ]);

                // Si hay combinaciones de atributos, guardarlas
                if (!empty($data['attributes'])) {
                    foreach ($data['attributes'] as $attribute) {
                        ProductAttributeCombination::create([
                            'product_attribute_id' => $productAttribute->id,
                            'attribute_id'         => $attribute['id']
                        ]);
                    }
                }

                // Almacenar el id del nuevo atributo creado
                $receivedAttributeIds[] = $productAttribute->id;
            } else {
                // Actualizar el ProductAttribute existente
                $productAttribute = ProductAttribute::find($data['idProductAttribute']);

                if ($productAttribute) {
                    $productAttribute->update([
                        'reference'     => $data['reference'],
                        'default_price' => $data['default_price'],
                        'stock'         => $data['stock'],
                        'is_default'    => $data['is_default']
                    ]);

                    // Almacenar el id del atributo actualizado
                    $receivedAttributeIds[] = $productAttribute->id;
                }
            }
        }

        // 4. Comparar y eliminar los ProductAttributes que ya no están presentes en los datos recibidos
        $attributesToDelete = array_diff($currentProductAttributes, $receivedAttributeIds);

        if (!empty($attributesToDelete)) {
            ProductAttribute::whereIn('id', $attributesToDelete)->delete();
        }

        $product = Product::latest()->first();

        return ApiResponse::success($product, "Actualizado con exito");
    }

    private function updateVariantPrices($variantId, $variantData)
    {
        // Tipos de precio: 1 = General, 2 = Mayor, 3 = Especial
        $priceTypes = [
            1 => $variantData['price1'] ?? null,
            2 => $variantData['price2'] ?? null,
            3 => $variantData['price3'] ?? null,
        ];

        foreach ($priceTypes as $priceTypeId => $price) {
            if ($price !== null) {
                // Intentar encontrar un precio existente para este tipo
                $variantPrice = ProductVariantPrice::where('product_variant_id', $variantId)
                    ->where('price_type_id', $priceTypeId)
                    ->first();

                if ($variantPrice) {
                    // Si existe, actualizar el precio
                    $variantPrice->update([
                        'price' => $price,
                    ]);
                } else {
                    // Si no existe, crear un nuevo registro de precio
                    ProductVariantPrice::create([
                        'price' => $price,
                        'product_variant_id' => $variantId,
                        'price_type_id' => $priceTypeId,
                    ]);
                }
            }
        }
    }
}
