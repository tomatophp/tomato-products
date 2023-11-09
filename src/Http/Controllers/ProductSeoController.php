<?php

namespace TomatoPHP\TomatoProducts\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class ProductSeoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index(\TomatoPHP\TomatoProducts\Models\Product $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-products::product-seo.index',
            attach: [
                'brand' => $model->meta('brand') ?? null,
                'categories' => $model->categories()->get()->pluck('id'),
                'tags' => $model->tags()->get()->pluck('id'),
            ]
        );
    }
}
