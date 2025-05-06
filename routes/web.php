<?php

use App\Http\Controllers\AttentionNumberController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributeGroupController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AuthPage\LoginPageController;
use App\Http\Controllers\AuthPage\RegisterPageController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ComplaintsBookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportExcelController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\LegalityController;
use App\Http\Controllers\OrderSaleProductsController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProductAttributeController;
use App\Http\Controllers\ProductBrandController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductGeneralController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ShoppingCartProductController;
use App\Http\Controllers\SocialNetworkController;
use App\Http\Controllers\SubcategoryProductController;
use App\Http\Controllers\SubSubcategoryProductController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\ThemesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebPageController;
use App\Http\Middleware\CheckUserType;
use App\Models\AttentionNumber;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/enlace', function () {
    Artisan::call('storage:link');
    return 'Enlace simbólico creado correctamente.';
})->name('enlace');


/* routes webpage */
Route::prefix('/')->group(function () {
    Route::get('iniciar-sesion', [WebPageController::class, 'login'])->name('webpage.login');
    Route::get('terminos-y-condiciones', [WebPageController::class, 'termsAndConditions'])->name('webpage.termsAndConditions');
    Route::get('libro-de-reclamaciones', [WebPageController::class, 'complaintsBook'])->name('webpage.complaintsBook');
    Route::post('/libro-store', [ComplaintsBookController::class, 'store'])->name('webpage.complaint.store');
    Route::get('politicas-de-cambio', [WebPageController::class, 'changePolicies'])->name('webpage.changePolicies');
    Route::get('registro/{fromCheckout?}', [WebPageController::class, 'register'])->name('webpage.register');
    Route::get('checkout-productos', [WebPageController::class, 'checkoutProducts'])->name('web_page.checkoutProducts');
    Route::get('carrito-productos', [WebPageController::class, 'shoppingCartProducts'])->name('web_page.shoppingCartProducts');
    Route::get('productos', [WebPageController::class, 'products'])->name('web_page.products');
    Route::get('productos/categorias/{categoryProduct}', [WebPageController::class, 'viewProductsCategory'])->name('web_page.products_category');
    Route::get('productos/subcategorias/{subCategoryProduct}', [WebPageController::class, 'viewProductsSubCategory'])->name('web_page.products_subcategory');
    Route::post('get_product_by_attributes', [ProductAttributeController::class, 'getProductByAttributes'])->name('productAttributes.get_product_by_attributes');

    Route::get('tienda', [WebPageController::class, 'store'])->name('webpage.store');
    Route::get('nosotros', [WebPageController::class, 'about'])->name('webpage.about');
    Route::get('productos/{product:slug}', [WebPageController::class, 'product'])->name('webpage.product');
    Route::get('productos/categorias/{categoryProduct}', [WebPageController::class, 'viewProductsCategory'])->name('webpage.products_category');
    Route::get('', [WebPageController::class, 'home'])->name('webpage.home');
});


Route::prefix('shopping-cart-products')->group(function () {
    Route::post('/addRemoveProduct', [ShoppingCartProductController::class, 'addRemoveProduct']);
    Route::post('/store', [ShoppingCartProductController::class, 'store']);
    Route::get('/showCart', [ShoppingCartProductController::class, 'showCart']);
    Route::delete('/clearCart', [ShoppingCartProductController::class, 'clearCart']);
    Route::delete('/removeProduct/{idProductAttribute}', [ShoppingCartProductController::class, 'removeProduct']);
    Route::put('{id}', [ShoppingCartProductController::class, 'update']);
    Route::get('/', [ShoppingCartProductController::class, 'index']);
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin', CheckUserType::class . ':admin_panel']], function () {

    // Rutas de productos
    Route::prefix('productos')->group(function () {
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('{id}', [ProductController::class, 'update'])->name('product.update');
        Route::get('/{id}', [ProductController::class, 'show'])->name('product.show');
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
    });

    Route::prefix('categoria-productos')->group(function () {
        Route::get('/create', [ProductCategoryController::class, 'create'])->name('product_category.create');
        Route::post('/store', [ProductCategoryController::class, 'store'])->name('product_category.store');
        Route::put('{id}', [ProductCategoryController::class, 'update'])->name('product_category.update');
        Route::get('/{id}', [ProductCategoryController::class, 'show'])->name('product_category.show');
        Route::get('/', [ProductCategoryController::class, 'index'])->name('product_category.index');
    });

    Route::prefix('banners')->group(function () {
        Route::get('/create', [BannerController::class, 'create'])->name('banner.create');
        Route::post('/store', [BannerController::class, 'store'])->name('banner.store');
        Route::put('{id}', [BannerController::class, 'update'])->name('banner.update');
        Route::get('/{id}', [BannerController::class, 'show'])->name('banner.show');
        Route::get('/', [BannerController::class, 'index'])->name('banner.index');
    });

    Route::prefix('promotions')->group(function () {
        Route::get('/create', [PromotionController::class, 'create'])->name('promotion.create');
        Route::post('/store', [PromotionController::class, 'store'])->name('promotion.store');
        Route::put('{id}', [PromotionController::class, 'update'])->name('promotion.update');
        Route::get('/{id}', [PromotionController::class, 'show'])->name('promotion.show');
        Route::get('/', [PromotionController::class, 'index'])->name('promotion.index');
    });

    Route::prefix('subcategoria-productos')->group(function () {
        Route::get('/create', [SubcategoryProductController::class, 'create'])->name('product_subcategory.create');
        Route::post('/store', [SubcategoryProductController::class, 'store'])->name('product_subcategory.store');
        Route::put('{id}', [SubcategoryProductController::class, 'update'])->name('product_subcategory.update');
        Route::get('/{id}', [SubcategoryProductController::class, 'show'])->name('product_subcategory.show');
        Route::get('/', [SubcategoryProductController::class, 'index'])->name('product_subcategory.index');
    });

    Route::prefix('terminos-condiciones')->group(function () {
        Route::get('/', [LegalityController::class, 'terminosCondiciones'])->name('terms_conditions.index');
    });
    Route::prefix('politicas-reembolso')->group(function () {
        Route::get('/', [LegalityController::class, 'politicasReembolso'])->name('refund_policies.index');
    });

    Route::prefix('marca-productos')->group(function () {
        Route::post('/store', [ProductBrandController::class, 'store'])->name('product_brand.store');
        Route::put('{id}', [ProductBrandController::class, 'update'])->name('product_brand.update');
        Route::get('/{id}', [ProductBrandController::class, 'show'])->name('product_brand.show');
        Route::get('/', [ProductBrandController::class, 'index'])->name('product_brand.index');
    });

    Route::prefix('general-productos')->group(function () {
        Route::post('/store', [ProductGeneralController::class, 'store'])->name('product_general.store');
        Route::put('{id}', [ProductGeneralController::class, 'update'])->name('product_general.update');
        Route::get('/{id}', [ProductGeneralController::class, 'show'])->name('product_general.show');
        Route::get('/', [ProductGeneralController::class, 'index'])->name('product_general.index');
    });

    Route::prefix('general-tienda')->group(function () {
        Route::put('{id}', [GeneralController::class, 'update'])->name('store_general.update');
        Route::get('/{id}', [GeneralController::class, 'show'])->name('store_general.show');
        Route::get('/', [GeneralController::class, 'index'])->name('store_general.index');
    });

    Route::prefix('numeros-atencion')->group(function () {
        Route::put('{id}', [AttentionNumberController::class, 'update'])->name('attention_number.update');
        Route::get('/{id}', [AttentionNumberController::class, 'show'])->name('attention_number.show');
        Route::get('/', [AttentionNumberController::class, 'index'])->name('attention_number.index');
    });

    Route::prefix('redes-sociales')->group(function () {
        Route::put('{id}', [SocialNetworkController::class, 'update'])->name('social_network.update');
        Route::get('/{id}', [SocialNetworkController::class, 'show'])->name('social_network.show');
        Route::get('/', [SocialNetworkController::class, 'index'])->name('social_network.index');
    });

    Route::prefix('metodos-pago')->group(function () {
        Route::put('{id}', [PaymentMethodController::class, 'update'])->name('payment_method.update');
        Route::get('/{id}', [PaymentMethodController::class, 'show'])->name('payment_method.show');
        Route::get('/', [PaymentMethodController::class, 'index'])->name('payment_method.index');
    });

    Route::prefix('temas-colores')->group(function () {
        Route::put('{id}', [ThemeController::class, 'update'])->name('themes.update');
        Route::get('/{id}', [ThemeController::class, 'show'])->name('themes.show');
        Route::get('/', [ThemeController::class, 'index'])->name('themes.index');
    });

    Route::prefix('libro-reclamaciones')->group(function () {
        Route::put('{id}', [ComplaintsBookController::class, 'update'])->name('complaint_book.update');
        Route::get('/', [ComplaintsBookController::class, 'index'])->name('complaint_book.index');
    });

    Route::prefix('pdf')->group(function () {
        Route::get('/complaint/{complaints_book}', [PdfController::class, 'complaint'])->name('pdf.complaint');
    });

    Route::prefix('variantes-grupos')->group(function () {
        Route::get('/', [AttributeGroupController::class, 'index'])->name('attribute_group.index');
    });

    Route::prefix('variantes-productos')->group(function () {
        Route::get('/create', [AttributeController::class, 'create'])->name('product_attribute.create');
        Route::post('/store', [AttributeController::class, 'store'])->name('product_attribute.store');
        Route::put('{id}', [AttributeController::class, 'update'])->name('product_attribute.update');
        Route::get('/{id}', [AttributeController::class, 'show'])->name('product_attribute.show');
        Route::get('/', [AttributeController::class, 'index'])->name('product_attribute.index');
    });


    Route::prefix('dashboards')->group(function () {
        Route::get('sales_by_mont', [DashboardController::class, 'salesByMonth'])->name('dashboard.salesByMonth');
        Route::post('/ventas', [DashboardController::class, 'dataForChartsSales']);
        Route::post('/usuarios', [DashboardController::class, 'dataForChartsUsers']);
        Route::get('/ventas', [DashboardController::class, 'viewSale'])->name('dashboard.view_sale');
        Route::get('/usuarios', [DashboardController::class, 'viewUser'])->name('dashboard.view_user');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    });

    Route::prefix('ordenes')->group(function () {
        Route::get('/', [OrderSaleProductsController::class, 'index'])->name('orders.index');
        Route::get('/{id}', [OrderSaleProductsController::class, 'show'])->name('orders.show');
    });

    Route::prefix('usuarios')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
    });

    Route::prefix('exportar-excel')->group(function () {
        Route::post('/ventas/transacciones', [ExportExcelController::class, 'exportEcommerceSaleTransaction']);
        Route::post('/ventas/por-producto', [ExportExcelController::class, 'exportSalesByProduct']);
    });
});

Auth::routes(['verify' => true]);

Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {
    // -----------------------------login----------------------------------------//
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'authenticate');
        Route::get('/logout', 'logout')->name('logout');
        Route::get('logout/page', 'logoutPage')->name('logout/page');
    });

    // ------------------------------ register ----------------------------------//
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'register')->name('register');
        Route::post('/register', 'storeUser')->name('register');
    });

    // ----------------------------- forget password ----------------------------//
    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get('forget-password', 'getEmail')->name('forget-password');
        Route::post('forget-password', 'postEmail')->name('forget-password');
    });

    // ----------------------------- reset password -----------------------------//
    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get('reset-password/{token}', 'getPassword');
        Route::post('reset-password', 'updatePassword');
    });
});

// ------------------------------ AuthPage ----------------------------------//
Route::group(['namespace' => 'App\Http\Controllers\AuthPage', 'prefix' => 'page'], function () {
    // ------------------------------ register ----------------------------------//
    Route::controller(RegisterPageController::class)->group(function () {
        Route::post('/register', 'storeUser')->name('page.register.store'); // Cambié el nombre para que sea único
    });

    Route::controller(LoginPageController::class)->group(function () {
        Route::post('/login', 'authenticate');
        Route::get('/logout', 'logout')->name('page.logout');
    });
});
