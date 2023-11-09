<?php

namespace TomatoPHP\TomatoProducts\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoCategory\Models\Category;
use TomatoPHP\TomatoCategory\Models\Type;
use TomatoPHP\TomatoTranslations\Services\HandelTranslationInput;

class ProductCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('tomato-products::product-categories.index');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function create()
    {
        return view('tomato-products::product-categories.form');
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request)
    {
        $getItemIfExists = Category::where('slug', $request->get('slug'))->first();

        $request->merge([
            "for" => "product-categories",
        ]);

        if($getItemIfExists){
            $request->validate([
                "parent_id" => "nullable|integer|exists:categories,id",
                "name" => "required|array",
                "slug" => "required|string|max:255|unique:categories,slug," . $getItemIfExists->id,
                "name*" => "required|string|max:255",
                "color" => "nullable|string|max:255",
                "icon" => "nullable|string|max:255",
                "description" => "nullable|string|max:255",
                "activated" => "nullable|boolean",
                "menu" => "nullable|boolean",
            ]);

            $getItemIfExists->update($request->all());

            Toast::success(__('Category updated successfully!'))->autoDismiss(2);
            return back();
        }
        else {
            $request->validate([
                "parent_id" => "nullable|integer|exists:categories,id",
                "name" => "required|array",
                "slug" => "required|string|max:255|unique:categories,slug",
                "name*" => "required|string|max:255",
                "color" => "nullable|string|max:255",
                "icon" => "nullable|string|max:255",
                "description" => "nullable|string|max:255",
                "activated" => "nullable|boolean",
                "menu" => "nullable|boolean",
            ]);

            Category::create($request->all());

            Toast::success(__('Category created successfully!'))->autoDismiss(2);
            return back();
        }
    }

    public function edit(Category $item){
        return view('tomato-products::product-categories.form', [
            "item" => $item
        ]);
    }

    public function destroy(Category $item){
        $item->delete();

        Toast::success(__('Category deleted successfully'))->autoDismiss(2);
        return back();
    }
}
