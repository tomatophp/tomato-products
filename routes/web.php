<?php


use Illuminate\Support\Facades\Route;

Route::middleware(['web','auth', 'splade', 'verified'])->prefix('admin/products/options')->name('admin.products.options.')->group(function () {
    Route::get('/', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductOptionsController::class, 'index'])->name('index');
    Route::post('/mix', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductOptionsController::class, 'mix'])->name('mix');
    Route::get('/create/{type}', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductOptionsController::class, 'create'])->name('create');
    Route::post('/create/{type}', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductOptionsController::class, 'store'])->name('store');
    Route::get('/edit/{item}', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductOptionsController::class, 'edit'])->name('edit');
    Route::delete('/delete/{item}', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductOptionsController::class, 'destroy'])->name('delete');
});

Route::middleware(['web','auth', 'splade', 'verified'])->prefix('admin/products/category')->name('admin.products.category.')->group(function () {
    Route::get('/', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductCategoryController::class, 'index'])->name('index');
    Route::get('/create', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductCategoryController::class, 'create'])->name('create');
    Route::get('/attach', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductCategoryController::class, 'category'])->name('attach');
    Route::post('/attach', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductCategoryController::class, 'attach'])->name('attach.store');
    Route::post('/create', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductCategoryController::class, 'store'])->name('store');
    Route::get('/edit/{item}', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductCategoryController::class, 'edit'])->name('edit');
    Route::delete('/delete/{item}', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductCategoryController::class, 'destroy'])->name('delete');
});

Route::middleware(['web','auth', 'splade', 'verified'])->prefix('admin/products/tags')->name('admin.products.tags.')->group(function () {
    Route::get('/', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductTagsController::class, 'index'])->name('index');
    Route::get('/create', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductTagsController::class, 'create'])->name('create');
    Route::post('/create', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductTagsController::class, 'store'])->name('store');
    Route::get('/edit/{item}', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductTagsController::class, 'edit'])->name('edit');
    Route::delete('/delete/{item}', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductTagsController::class, 'destroy'])->name('delete');
});


Route::middleware(['web','auth', 'splade', 'verified'])->prefix('admin/products/brands')->name('admin.products.brands.')->group(function () {
    Route::get('/', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductBrandsController::class, 'index'])->name('index');
    Route::get('/create', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductBrandsController::class, 'create'])->name('create');
    Route::post('/create', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductBrandsController::class, 'store'])->name('store');
    Route::get('/edit/{item}', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductBrandsController::class, 'edit'])->name('edit');
    Route::delete('/delete/{item}', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductBrandsController::class, 'destroy'])->name('delete');
});

Route::middleware(['web','auth', 'splade', 'verified'])->prefix('admin/products/units')->name('admin.products.units.')->group(function () {
    Route::get('/', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductUnitsController::class, 'index'])->name('index');
    Route::get('/create', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductUnitsController::class, 'create'])->name('create');
    Route::post('/create', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductUnitsController::class, 'store'])->name('store');
    Route::get('/edit/{item}', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductUnitsController::class, 'edit'])->name('edit');
    Route::delete('/delete/{item}', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductUnitsController::class, 'destroy'])->name('delete');
});


Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.products.actions.')->group(function () {
    Route::get('admin/products/{model}/media', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductMediaController::class, 'index'])->name('media');
    Route::get('admin/products/{model}/options', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductOptionsController::class, 'product'])->name('options');
    Route::get('admin/products/{model}/alerts', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductAlertsController::class, 'index'])->name('alerts');
    Route::get('admin/products/{model}/seo', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductSeoController::class, 'index'])->name('seo');
    Route::get('admin/products/{model}/shipping', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductShippingController::class, 'index'])->name('shipping');
    Route::get('admin/products/{model}/prices', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductPricesController::class, 'index'])->name('prices');
});

Route::middleware(['web','auth', 'verified'])->group(function (){
    Route::get('admin/products/print/orders', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductController::class, 'printOrders'])->name('admin.products.print.orders');
});

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/products', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductController::class, 'index'])->name('products.index');
    Route::get('admin/products/orders/attach', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductController::class, 'orderAttach'])->name('products.orders.attach');
    Route::get('admin/products/inventory/attach', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductController::class, 'inventoryAttach'])->name('products.inventory.attach');
    Route::get('admin/products/api', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductController::class, 'api'])->name('products.api');
    Route::get('admin/products/create', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductController::class, 'create'])->name('products.create');
    Route::get('admin/products/import', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductController::class, 'import'])->name('products.import');
    Route::post('admin/products/import-store', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductController::class, 'importStore'])->name('products.import.store');
    Route::post('admin/products', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductController::class, 'store'])->name('products.store');
    Route::get('admin/products/{model}', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductController::class, 'show'])->name('products.show');
    Route::get('admin/products/{model}/edit', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
    Route::get('admin/products/{model}/clone', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductController::class, 'clone'])->name('products.clone');
    Route::get('admin/products/{model}/toggle', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductController::class, 'toggle'])->name('products.toggle');
    Route::post('admin/products/{model}', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductController::class, 'update'])->name('products.update');
    Route::delete('admin/products/{model}', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');
});



Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/product-reviews/api', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductReviewController::class, 'api'])->name('product-reviews.api');
    Route::get('admin/product-reviews/create', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductReviewController::class, 'create'])->name('product-reviews.create');
    Route::post('admin/product-reviews', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductReviewController::class, 'store'])->name('product-reviews.store');
    Route::get('admin/product-reviews/{model}', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductReviewController::class, 'show'])->name('product-reviews.show');
    Route::get('admin/product-reviews/{model}/edit', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductReviewController::class, 'edit'])->name('product-reviews.edit');
    Route::post('admin/product-reviews/{model}', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductReviewController::class, 'update'])->name('product-reviews.update');
    Route::delete('admin/product-reviews/{model}', [\TomatoPHP\TomatoProducts\Http\Controllers\ProductReviewController::class, 'destroy'])->name('product-reviews.destroy');
});
