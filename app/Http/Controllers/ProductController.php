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
use App\Models\SubcategoryProduct;
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
        $subCategoryProducts = SubcategoryProduct::where('status', 1)->get();
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
            compact('productBrands', 'categoryProducts', 'attributeGroups', 'subCategoryProducts')
        );
    }

    public function show($id, Request $request)
    {
        $product = Product::with(['productBrand', 'measurementUnit', 'categoryProduct', 'productImages'])
            ->where('status', 1)->findOrFail($id);
        $arrayImageDetails = [];
        $arrayImageActive = [];
        $imageDirectory = storage_path('app/public/uploads/') . getCompanyCode();
        //dd($product);
        foreach ($product->productImages as $image) {
            $imageDetails = pathNameToFile($image->image_name, $imageDirectory);
            array_push($arrayImageDetails, $imageDetails);
            array_push($arrayImageActive, $image->is_main);
        }

        $product->imageDetail = $arrayImageDetails;
        $product->imageChecks = $arrayImageActive;

        if ($request->expectsJson()) {
            return ApiResponse::success($product, "Registro encontrado");
        }

        return view('product.show', compact('product'));
    }

    public function index()
    {
        $products = Product::with(['productBrand', 'measurementUnit', 'categoryProduct', 'productImages'])
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
        $subCategoryProducts = SubCategoryProduct::where('status', 1)->get();
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
            compact('productBrands', 'measurementUnits', 'categoryProducts', 'subCategoryProducts', 'attributeGroups', 'product')
        );
    }


    public function store(Request $request)
    {
        $rules = [
            "title" => "required|string|min:5",
            "description" => "required",
            "imagenes" => "nullable|array",
            "is_main" => "nullable|array",
            "imagenes.*" => "file|image|mimes:jpeg,png,jpg,gif,svg",
            "productVariants" => "required|json",
            "featured" => "",
            "min_stock" => "required",
            "status_on_website" => "required",
            'product_brand_id' => 'required|integer|exists:product_brands,id',
            "category_product_id" => "required",
            "subcategory_product_id" => "required",
        ];

        // Definir los nombres amigables de los atributos
        $attributes = [
            "title" => "Titulo",
            "description" => "Descripción",
            "imagenes" => "imagenes",
            "is_main" => "imagen activa",
            "featured" => "Producto destacado",
            "productVariants" => "Variantes del producto",
            "min_stock" => "Minimo de Stock",
            "status_on_website" => "Estado de la página web",
            'product_brand_id' => "Marca",
            "category_product_id" => "Categoria",
            "subcategory_product_id" => "SubCategoria",
        ];

        // Crear el validador manualmente
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributes);

        // Validar los datos
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return ApiResponse::error("Validation Error", $errors, 202);
        }

        $slug = Str::slug($request->input('title'));

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
        // Crear producto
        $product = Product::create([
            "title" => $validatedData["title"],
            "code" => "XX_PRODUCT",
            "description" => $validatedData["description"],
            "slug" => $slug,
            "min_stock" => $validatedData["min_stock"],
            "status_on_website" => $validatedData["status_on_website"],
            "product_brand_id" => $validatedData["product_brand_id"],
            "category_product_id" => $validatedData["category_product_id"],
            "featured" => $validatedData["featured"] ?? 0,
            "subcategory_product_id" => $validatedData["subcategory_product_id"],
            "user_id" => Auth::guard('admin')->id()
        ]);

        // Guardar imágenes
        $archivos = $request->file('imagenes');
        foreach ($archivos as $index => $archivo) {
            $path = $archivo->store('uploads/' . getCompanyCode(), 'public');
            $fileName = basename($path);

            $product->productImages()->create([
                'image_name' => $fileName,
                'description' => '-',
                'is_main' => $validatedData["is_main"][$index] === "true" ? 1 : 0,
            ]);
        }

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
            "description" => "required",
            "imagenes" => "nullable|array",
            "is_main" => "nullable|array",
            "imagenes.*" => "file|image|mimes:jpeg,png,jpg,gif,svg",
            "productVariants" => "required|json",
            "min_stock" => "required",
            "status_on_website" => "required",
            "featured" => "",
            'product_brand_id' => 'required|integer|exists:product_brands,id',
            "category_product_id" => "required",
            "subcategory_product_id" => "required",
        ];

        // Definir los nombres amigables de los atributos
        $attributes = [
            "title" => "Titulo",
            "description" => "Descripción",
            "imagenes" => "imagenes",
            "is_main" => "imagen activa",
            "featured" => "Producto destacado",
            "productVariants" => "Variantes del producto",
            "min_stock" => "Minimo de Stock",
            "status_on_website" => "Estado de la página web",
            'product_brand_id' => "Marca",
            "category_product_id" => "Categoria",
            "subcategory_product_id" => "SubCategoria",
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

        $product = Product::findOrFail($id);

        $uploadedImages = $request->file('imagenes');
        $checks = $request->input('is_main'); // ['true', 'false', 'false', ...]

        // Obtener todas las imágenes existentes relacionadas
        $currentImages = $product->productImages()->get()->keyBy('image_name');

        // Obtener nombres originales de imágenes subidas
        $uploadedImageNames = [];
        foreach ($uploadedImages as $uploadedImage) {
            $uploadedImageNames[] = $uploadedImage->getClientOriginalName();
        }

        // Desactivar imagen principal previamente marcada
        $product->productImages()->update(['is_main' => false]);

        // Marcar como inactivas (status = 0) las imágenes que ya no están
        foreach ($currentImages as $imageName => $image) {
            if (!in_array($imageName, $uploadedImageNames)) {
                // Desactivar el registro
                $image->update(['status' => 0]);

                // Eliminar archivo físico
                $filePath = storage_path('app/public/uploads/' . $image->image_name);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        // Procesar archivos subidos
        foreach ($uploadedImages as $index => $uploadedImage) {
            $originalName = $uploadedImage->getClientOriginalName();
            $isMain = $checks[$index] === "true" ? 1 : 0;

            if ($currentImages->has($originalName)) {
                $currentImages[$originalName]->refresh();
                $currentImages[$originalName]->is_main = $isMain;
                $currentImages[$originalName]->status = 1;
                $currentImages[$originalName]->save();
            } else {
                // Guardar imagen nueva
                $newPath = $uploadedImage->store('uploads/' . getCompanyCode(), 'public');
                $fileName = basename($newPath);

                $product->productImages()->create([
                    'image_name' => $fileName,
                    'description' => '-', // Ajusta si es necesario
                    'is_main' => $isMain,
                    'status' => 1
                ]);
            }
        }

        $productData = [
            "title" => $validatedData["title"],
            "code" => "XX_PRODUCT",
            "description" => $validatedData["description"],
            "slug" => $slug,
            "min_stock" => $validatedData["min_stock"],
            "status_on_website" => $validatedData["status_on_website"],
            "product_brand_id" => $validatedData["product_brand_id"],
            "category_product_id" => $validatedData["category_product_id"],
            "subcategory_product_id" => $validatedData["subcategory_product_id"],
            "featured" => $validatedData["featured"],
            "user_id" => Auth::guard('admin')->id()
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

        return ApiResponse::success($product->fresh(), "Actualizado con exito");
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
