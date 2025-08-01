<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\AttentionNumber;
use App\Models\Banner;
use App\Models\CategoryProduct;
use App\Models\ComplaintsBook;
use App\Models\General;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductVariant;
use App\Models\Promotion;
use App\Models\Raffle;
use App\Models\SubcategoryProduct;
use App\Models\Theme;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class WebPageController extends Controller
{

  public function checkoutProducts()
  {
    $total = 0;

    if (session()->has('shoppingCartProducts')) {
      $total = array_reduce(session('shoppingCartProducts'), function ($carry, $product) {
        return $carry + ($product['price'] * $product['quantity']);
      }, 0);
    }

    return view('webpage.checkout_products', [
      "total" => $total,
      "activeScroll" => false,
    ]);
  }

  public function configStore()
  {
    return view('webpage.config_store', []);
  }

  public function shoppingCartProducts()
  {
    return view('webpage.shopping_cart_products', [
      "activeScroll" => false,
    ]);
  }

  public function searchProducts(Request $request)
  {
    $query = $request->input('query');

    $products = Product::with([
      'productAttributes.prices',
      'productAttributes.attributesCombination',
      'productBrand',
      'productImages',
    ])
      ->where('status', 1)
      ->where('title', 'like', "%{$query}%")
      ->get();

    return ApiResponse::success($products, "Registro encontrado");
  }

  public function product(Product $product)
  {

    $product->load(['productAttributes.attributesCombination', 'productBrand']);
    $defaultProductAttribute = $product->productAttributes->firstWhere('is_default', 1);

    $groupedAttributes = [];
    $defaultAttributes = []; // Para almacenar la combinación por defecto, si existe

    // Iterar sobre los atributos del producto
    foreach ($product->productAttributes as $attribute) {
      foreach ($attribute->attributesCombination as $combination) {
        // Obtener el tipo y el valor del atributo
        $attributeType = $combination->attribute->attributeGroup->description; // "Tamaño" o "Color"
        $attributeValue = $combination->attribute->description; // "Rojo", "M"
        $attributeId = $combination->attribute->id; // ID del atributo

        // Verificar si el tipo de atributo ya está en el arreglo
        if (!isset($groupedAttributes[$attributeType])) {
          // Inicializar la estructura para el tipo de atributo
          $groupedAttributes[$attributeType] = [
            'description' => $attributeType,
            'attributes' => [], // Inicializar el arreglo de atributos
          ];
        }

        // Verificar si el valor ya está en el arreglo de atributos
        if (!in_array($attributeValue, array_column($groupedAttributes[$attributeType]['attributes'], 'value'))) {
          // Agregar el valor y el ID al arreglo de atributos
          $groupedAttributes[$attributeType]['attributes'][] = [
            'id' => $attributeId,
            'value' => $attributeValue,
          ];
        }

        // Si el atributo actual es el valor por defecto, almacenarlo
        if ($attribute->is_default) {
          $defaultAttributes[$attributeType] = $attributeId;
        }
      }
    }

    // Convertir el arreglo a la forma deseada (sin llaves, solo índices numéricos)
    $finalGroupedAttributes = [];
    foreach ($groupedAttributes as $attributeType => $data) {
      $finalGroupedAttributes[] = [
        'description' => $data['description'],
        'attributes' => $data['attributes'], // Arreglo de atributos con ID y valor
      ];
    }
    // Obtener productos relacionados de la misma categoría
    $relatedProducts = Product::with([
      'productAttributes.prices',
      'productAttributes.attributesCombination',
      'productBrand'
    ])->where('category_product_id', $product->category_product_id)
      ->where('id', '!=', $product->id) // Excluir el producto actual
      ->where('status', 1) // Si manejas un campo status para productos activos
      ->inRandomOrder()
      ->take(8)
      ->get();

    return view('webpage.product', [
      "product" => $product,
      "activeScroll" => false,
      "finalGroupedAttributes" => $finalGroupedAttributes,
      "defaultAttributes" => $defaultAttributes,
      "defaultProductAttribute" => $defaultProductAttribute,
      "relatedProducts" => $relatedProducts
    ]);
  }

  public function register($fromCheckout = false)
  {

    if ($fromCheckout) {
      //creamos sesion para mostrar la ruta checkout mas adelante
      session(['from_checkout' => true]);
    }

    return view('webpage.register', ["activeScroll" => false]);
  }

  public function login()
  {
    return view('webpage.login', ["activeScroll" => false]);
  }

  public function social(Request $request)
  {
    return view('webpage.social', ["activeScroll" => true]);
  }

  public function termsAndConditions(Request $request)
  {
    return view('webpage.terms_and_conditions', ["activeScroll" => false]);
  }

  public function complaintsBook(Request $request)
  {
    $lastComplaint = ComplaintsBook::latest()->first();
    $nextId = 1;
    if ($lastComplaint) {
      $lastComplaint->id + 1;
    }
    return view('webpage.complaints_book', ["activeScroll" => false, "lastComplaint" => $nextId]);
  }

  public function changePolicies(Request $request)
  {
    return view('webpage.change_policies', ["activeScroll" => false]);
  }

  public function store(Request $request)
  {
    $categories = CategoryProduct::where("status", 1)->get();
    $brands = ProductBrand::where("status", 1)->get();
    $subCategories = SubcategoryProduct::where("status", 1)->get();
    //$products = Product::where("status_on_website", 1)->where("status", 1)->paginate(4);

    $productsQuery = $this->applyProductFilters($request);

    if (request()->ajax()) {
      //dd($productsQuery);
      return view('webpage.components.products', [
        "products" => $productsQuery
      ])->render();
    }
    return view('webpage.store', [
      "products" => $productsQuery,
      "brands" => $brands,
      "categories" => $categories,
      "subCategories" => $subCategories,
      "activeScroll" => false,
    ]);
  }

  public function viewProductsCategory(Request $request, CategoryProduct $categoryProduct)
  {
    $categories = CategoryProduct::where("status", 1)->get();
    $brands = ProductBrand::where("status", 1)->get();
    $products = Product::where("status_on_website", 1)->where("status", 1)->paginate(4);

    // Aplicar filtros
    $productsQuery = $this->applyProductFilters($request);
    $productsQuery->where('category_product_id', $categoryProduct->id);
    // Paginación
    $products = $productsQuery->paginate(9);

    if (request()->ajax()) {
      return view('webpage.components.products', compact('products'))->render();
    }

    return view('webpage.products_category', [
      "products" => $products,
      "brands" => $brands,
      "categories" => $categories,
      "activeScroll" => false
    ]);
  }

  public function viewCategories(Request $request, CategoryProduct $categoryProduct)
  {
    $categories = CategoryProduct::where("status", 1)->get();
    // Paginación
    if (request()->ajax()) {
      return view('webpage.components.categories', compact('categories'))->render();
    }

    return view('webpage.categories', [
      "categories" => $categories,
      "activeScroll" => false,
    ]);
  }

  public function about(Request $request)
  {
    return view('webpage.about', ["activeScroll" => true]);
  }

  public function home(Request $request)
  {
    $banners = Banner::where('status', 1)->get();
    $categories = CategoryProduct::where('status', 1)->get();
    $promotions = Promotion::where('status', 1)->get();
    $brands = ProductBrand::where('status', 1)->get();

    $products = $this->applyProductFilters($request);

    if (request()->ajax()) {
      return view('webpage.components.products', compact('products'))->render();
    }

    return view('webpage.home', [
      "activeScroll" => true,
      "products" => $products,
      "banners" => $banners,
      "categories" => $categories,
      "promotions" => $promotions,
      "brands" => $brands,
    ]);
  }

  private function applyProductFilters(Request $request)
  {
    $productsQuery = Product::with([
      'productAttributes.prices',
      'productAttributes.attributesCombination',
      'productBrand'
    ])
      ->where('products.status', 1)
      ->where("status_on_website", 1);

    // Filtro de búsqueda
    if ($request->query('search')) {
      $productsQuery->where('products.title', 'LIKE', '%' . $request->query('search') . '%');
    }

    if ($request->query('favorites') !== null) {
      $productsQuery->where('products.featured', (bool) $request->query('favorites'));
    }

    // Filtro por marcas
    if ($request->query('brands')) {
      $productsQuery->whereIn('products.product_brand_id', $request->query('brands'));
    }

    // Filtro por categories
    if ($request->query('categories')) {
      $productsQuery->whereIn('products.category_product_id', $request->query('categories'));
    }

    if ($request->query('subcategories')) {
      $productsQuery->whereIn('products.subcategory_product_id', $request->query('subcategories'));
    }

    // Ordenamiento
    switch ($request->query('order')) {
      case 'price_desc':
        $productsQuery->join('product_attributes', 'products.id', '=', 'product_attributes.product_id')
          ->orderBy('product_attributes.default_price', 'desc')
          ->distinct('products.id')
          ->select('products.*');
        break;

      case 'price_asc':
        $productsQuery->join('product_attributes', 'products.id', '=', 'product_attributes.product_id')
          ->orderBy('product_attributes.default_price', 'asc')
          ->distinct('products.id')
          ->select('products.*');
        break;

      case 'newest':
        $productsQuery->orderBy('products.created_at', 'desc');
        break;

      case 'oldest':
        $productsQuery->orderBy('products.created_at', 'asc');
        break;
    }

    // Límite (por defecto 20 si no se especifica)
    $limit = (int) $request->query('limit', 20);

    // Obtener el parámetro paginate
    $paginateParam = $request->query('paginate');
    if (is_null($paginateParam) || $paginateParam === 'true') {
      return $productsQuery->paginate($limit)->appends($request->query());
    }

    // De lo contrario, limitamos resultados sin paginación
    return $productsQuery->limit($limit)->get();
  }
}
