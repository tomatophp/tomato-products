<?php

namespace TomatoPHP\TomatoProducts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use TomatoPHP\TomatoCategory\Models\Category;
use TomatoPHP\TomatoOrders\Models\Order;
use TomatoPHP\TomatoProducts\Import\ImportProducts;
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
        $categories = Category::where('for', 'product-categories')->get();
        $query = Product::query();
        if($request->has('filter') && isset($request->get('filter')['category_id'])){
            $query->where('category_id', $request->get('filter')['category_id']);
        }
        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'tomato-products::products.index',
            table: \TomatoPHP\TomatoProducts\Tables\ProductTable::class,
            resource: ProductsResource::class,
            query: $query,
            data: [
                "categories" => $categories
            ]
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

        if($request->has('has_options') && $request->get('has_options') == '1'){
            if(is_array($request->get('options'))){
                $response->record->meta('options', $request->get('options'));
            }
            if(is_array($request->get('qty'))){
                $response->record->meta('qty', $request->get('qty'));
            }
        }
        elseif($request->has('has_options') && $request->get('has_options') == '0') {
            $response->record->meta('options', (object)[]);
            $response->record->meta('qty', (object)[]);
        }
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

    public function import(){
        return view('tomato-products::products.import');
    }

    public function importStore(Request $request){
        $request->validate([
            "file" => "required|file|mimes:xlsx,doc,docx,ppt,pptx,ods,odt,odp"
        ]);

        $collection = Excel::toArray(new ImportProducts(), $request->file('file'));
        unset($collection[0][0]);
        foreach ($collection[0] as $item){
            $checkIfProductExists = Product::where('sku', $item[1])->where('barcode', $item[2])->first();
            if($checkIfProductExists){
                $checkIfProductExists->name = $item[0]??null;
                $checkIfProductExists->slug = Str::of($item[0])->slug('-')??null;
                $checkIfProductExists->sku = $item[1]??Str::random(6);
                $checkIfProductExists->barcode = $item[2]??null;
                $checkIfProductExists->price = $item[3]??0;
                $checkIfProductExists->discount = $item[4]??0;
                $checkIfProductExists->vat = $item[5]??0;
                $checkIfProductExists->save();
            }
            else {
                $product = new Product();
                $product->name = $item[0]??null;
                $product->slug = Str::of($item[0])->slug('-')??null;
                $product->sku = $item[1]??Str::random(6);
                $product->barcode = $item[2]??null;
                $product->price = $item[3]??0;
                $product->discount = $item[4]??0;
                $product->vat = $item[5]??0;
                $product->save();
            }
        }

        Toast::success(__('Your File Has Been Imported Successfully'))->autoDismiss(2);
        return back();
    }

    public function inventoryAttach(Request $request)
    {
        $request->validate([
            "ids" => "required|string"
        ]);

        $ids = explode(',', $request->get('ids'));
        $products = Product::whereIn('id', $ids)->get();
        return view('tomato-products::products.inventory-attach', compact('products', 'ids'));
    }

    public function orderAttach(Request $request)
    {
        $request->validate([
            "ids" => "required|string"
        ]);

        $ids = explode(',', $request->get('ids'));
        $products = Product::whereIn('id', $ids)->get();
        return view('tomato-products::products.order-attach', compact('products', 'ids'));
    }

    public function printOrders(Request $request)
    {
        $request->validate([
            "product_id" => "required|exists:products,id"
        ]);


        $orders = Order::query();
        $orders->whereHas('ordersItems', function ($query) use ($request){
            $query->where('product_id', $request->get('product_id'));
        });
        $orders = $orders->get();
        return view('tomato-products::products.print-orders', [
            "orders" => $orders
        ]);
    }
}
