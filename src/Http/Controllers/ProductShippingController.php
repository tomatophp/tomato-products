<?php

namespace TomatoPHP\TomatoProducts\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class ProductShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index(\TomatoPHP\TomatoProducts\Models\Product $model): View
    {
        return view('tomato-products::product-shipping.index', compact('model'));
    }
}
