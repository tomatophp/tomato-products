<?php

namespace TomatoPHP\TomatoProducts\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use TomatoPHP\TomatoCategory\Models\Type;

class ProductMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index(\TomatoPHP\TomatoProducts\Models\Product $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-products::product-media.index',
            hasMedia: true,
            collection: [
                "images" => true,
                "featured_image" => false
            ]
        );
    }
}
