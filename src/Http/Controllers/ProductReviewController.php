<?php

namespace TomatoPHP\TomatoProducts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoProducts\Transformers\ProductReviewsResource;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class ProductReviewController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \TomatoPHP\TomatoProducts\Models\ProductReview::class;
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
            view: 'tomato-products::product-reviews.index',
            table: \TomatoPHP\TomatoProducts\Tables\ProductReviewTable::class,
            resource: ProductReviewsResource::class
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
            model: \TomatoPHP\TomatoProducts\Models\ProductReview::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-products::product-reviews.create',
        );
    }

    /**
     * @param \TomatoPHP\TomatoProducts\Http\Requests\ProductReview\ProductReviewStoreRequest $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(\TomatoPHP\TomatoProducts\Http\Requests\ProductReview\ProductReviewStoreRequest $request): RedirectResponse|JsonResponse
    {
        $response = Tomato::store(
            request: $request,
            model: \TomatoPHP\TomatoProducts\Models\ProductReview::class,
            message: __('ProductReview updated successfully'),
            redirect: 'admin.product-reviews.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return back();
    }

    /**
     * @param \TomatoPHP\TomatoProducts\Models\ProductReview $model
     * @return View|JsonResponse
     */
    public function show(\TomatoPHP\TomatoProducts\Models\ProductReview $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-products::product-reviews.show',
            resource: ProductReviewsResource::class
        );
    }

    /**
     * @param \TomatoPHP\TomatoProducts\Models\ProductReview $model
     * @return View
     */
    public function edit(\TomatoPHP\TomatoProducts\Models\ProductReview $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-products::product-reviews.edit',
        );
    }

    /**
     * @param \TomatoPHP\TomatoProducts\Http\Requests\ProductReview\ProductReviewUpdateRequest $request
     * @param \TomatoPHP\TomatoProducts\Models\ProductReview $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(\TomatoPHP\TomatoProducts\Http\Requests\ProductReview\ProductReviewUpdateRequest $request, \TomatoPHP\TomatoProducts\Models\ProductReview $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: __('ProductReview updated successfully'),
            redirect: 'admin.product-reviews.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return back();
    }

    /**
     * @param \TomatoPHP\TomatoProducts\Models\ProductReview $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\TomatoPHP\TomatoProducts\Models\ProductReview $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('ProductReview deleted successfully'),
            redirect: 'admin.product-reviews.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return back();
    }
}
