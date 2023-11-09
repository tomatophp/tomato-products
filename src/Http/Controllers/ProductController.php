<?php

namespace TomatoPHP\TomatoProducts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use TomatoPHP\TomatoProducts\Models\Product;
use TomatoPHP\TomatoProducts\Transformers\ProductsResource;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use TomatoPHP\TomatoCategory\Models\Type;
use TomatoPHP\TomatoTranslations\Services\HandelTranslationInput;

class ProductController extends Controller
{
    use HandelTranslationInput;

    public string $model;

    public function __construct()
    {
        $this->model = \TomatoPHP\TomatoProducts\Models\Product::class;
    }

    /**
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'tomato-products::products.index',
            table: \TomatoPHP\TomatoProducts\Tables\ProductTable::class,
            resource: ProductsResource::class
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function api(Request $request): JsonResponse
    {
        return Tomato::json(
            request: $request,
            model: \TomatoPHP\TomatoProducts\Models\Product::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-products::products.create'
        );
    }

    /**
     * @param \TomatoPHP\TomatoProducts\Http\Requests\Product\ProductStoreRequest $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(\TomatoPHP\TomatoProducts\Http\Requests\Product\ProductStoreRequest $request): RedirectResponse|JsonResponse
    {
        $response = Tomato::store(
            request: $request,
            model: \TomatoPHP\TomatoProducts\Models\Product::class,
            message: __('Product updated successfully'),
            redirect: 'admin.products.index'
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \TomatoPHP\TomatoProducts\Models\Product $model
     * @return View|JsonResponse
     */
    public function show(\TomatoPHP\TomatoProducts\Models\Product $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-products::products.show',
            hasMedia: true,
            collection: [
                "images" => true,
                "featured_image" => false
            ],
            resource: ProductsResource::class
        );
    }

    /**
     * @param \TomatoPHP\TomatoProducts\Models\Product $model
     * @return View
     */
    public function edit(\TomatoPHP\TomatoProducts\Models\Product $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-products::products.edit',
            attach: [
                "about" =>   $model->about ?: ['ar' => '', 'en'=> ''],
            ]
        );
    }

    /**
     * @param \TomatoPHP\TomatoProducts\Http\Requests\Product\ProductUpdateRequest $request
     * @param \TomatoPHP\TomatoProducts\Models\Product $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(\TomatoPHP\TomatoProducts\Http\Requests\Product\ProductUpdateRequest $request, \TomatoPHP\TomatoProducts\Models\Product $model): RedirectResponse|JsonResponse
    {
        if($request->has('has_stock_alert') && $request->get('has_stock_alert') == '0'){
            $request->merge([
                "max_stock_alert" => 0,
                "min_stock_alert" => 0,
            ]);
        }
        if($request->has('has_max_cart') && $request->get('has_max_cart') == '0'){
            $request->merge([
                "max_cart" => 0,
                "min_cart" => 0,
            ]);
        }
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: __('Product updated successfully'),
            redirect: 'admin.products.index',
            hasMedia: true,
            collection: [
                "images" => true,
                "featured_image" => false
            ]
        );

        $response->record->tags()->sync($request->get('tags'));
        $response->record->categories()->sync($request->get('categories'));

        $request->get('has_options') == '1' ? $response->record->meta('options', $request->get('options')) : $response->record->meta('options', (object)[]);
        $request->get('has_options') == '1' ? $response->record->meta('qty', $request->get('qty')) : $response->record->meta('qty', (object)[]);
        $response->record->meta('prices', $request->get('prices'));
        $response->record->meta('brand', $request->get('brand'));
        $response->record->meta('unit', $request->get('unit'));
        $response->record->meta('weight', $request->get('weight'));

        if($request->has('has_unlimited_stock') && $request->get('has_unlimited_stock') == '1'){
            $response->record->meta('stock', 0);
        }
        else {
            $response->record->meta('stock', $request->get('stock'));
        }

        if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \TomatoPHP\TomatoProducts\Models\Product $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\TomatoPHP\TomatoProducts\Models\Product $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('Product deleted successfully'),
            redirect: 'admin.products.index',
            hasMedia: true,
            collection: [
                "images" => true,
                "featured_image" => false
            ]
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }


    public function clone(\TomatoPHP\TomatoProducts\Models\Product $model){
        $product = $model->toArray();
        $product['slug'] = Str::random(10);
        $product['sku'] =Str::random(10);
        $product['barcode'] = Str::random(10);
        Product::create($product);

        Toast::success(__('Product cloned successfully'))->autoDismiss(2);
        return back();
    }

    public function toggle(\TomatoPHP\TomatoProducts\Models\Product $model, Request $request){
        $request->validate([
            "action" => "required|max:255|string"
        ]);

        $model->update([
            $request->get('action') => !$model->{$request->get('action')}
        ]);

        Toast::success(__('Product updated successfully'))->autoDismiss(2);
        return back();
    }
}
