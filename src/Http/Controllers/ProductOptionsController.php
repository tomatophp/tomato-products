<?php

namespace TomatoPHP\TomatoProducts\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use TomatoPHP\TomatoCategory\Models\Type;
use TomatoPHP\TomatoTranslations\Services\HandelTranslationInput;

class ProductOptionsController extends Controller
{
    use HandelTranslationInput;

    public function index(){
        return view('tomato-products::product-options.index');
    }

    public function create($type){
        return view('tomato-products::product-options.form', compact('type'));
    }

    public function store(Request $request){
        $this->translate($request);
        $getItemIfExists = Type::where('key', $request->get('key'))->first();
        if($getItemIfExists){
            $request->validate([
                "name" => "required|array",
                "name*" => "required|string|max:255",
                "key" => "required|string|unique:types,key,".$getItemIfExists->id,
            ]);

            $getItemIfExists->update([
                'name' => $request->get('name'),
                'key' => $request->get('key'),
                'color' => $request->get('color')??null,
                'icon' => $request->get('icon')??null,
            ]);
        }
        else {
            $request->validate([
                "name" => "required|array",
                "name*" => "required|string|max:255",
                "key" => "required|string|unique:types,key",
            ]);

            Type::create([
                'name' => $request->get('name'),
                'key' => $request->get('key'),
                'for' => 'product-options',
                'type' => $request->get('type'),
                'color' => $request->get('color')??null,
                'icon' => $request->get('icon')??null,
            ]);
        }

        Toast::success(__('Option has been updated successfully'))->autoDismiss(2);
        return back();
    }

    public function edit(Type $item){
        return view('tomato-products::product-options.form', [
            "item" => $item,
            "type" => $item->type
        ]);
    }

    public function destroy(Type $item){
        Type::where('for', 'product-options')->where('type', $item->key)->delete();
        $item->delete();

        Toast::success(__('Option deleted successfully'))->autoDismiss(2);
        return back();
    }

    public function product(\TomatoPHP\TomatoProducts\Models\Product $model): View
    {
        $types = Type::where('for', 'product-options')->where('type', 'type')->get();
        return Tomato::get(
            model: $model,
            view: 'tomato-products::product-options.product',
            data: [
                "types" => $types,
            ],
            attach: [
                "options" => $model->meta('options') ?: (object)[],
                "qty" => $model->meta('qty') ?: (object)[]
            ]
        );
    }

    public function mix(Request $request){
        $request->validate([
            "options" => "required|array",
        ]);

        $options = $request->get('options');
        $optionsByType = Type::where('for', 'product-options')->where('type', 'type')->get();
        $lastOptionsArray = [];
        foreach ($optionsByType as $type){
            if(isset($options[$type->key]) && count($options[$type->key])){
                $lastOptionsArray[] = $options[$type->key];
            }
        }

        return response()->json($this->combinations($lastOptionsArray));
    }

    private function combinations($arrays, $i = 0) {
        if (!isset($arrays[$i])) {
            return array();
        }
        if ($i == count($arrays) - 1) {
            return $arrays[$i];
        }

        // get combinations from subsequent arrays
        $tmp = $this->combinations($arrays, $i + 1);

        $result = array();

        // concat each array from tmp with each element from $arrays[$i]
        foreach ($arrays[$i] as $v) {
            foreach ($tmp as $t) {
                $result[] = is_array($t) ?
                    array_merge(array($v), $t) :
                    array($v, $t);
            }
        }

        return $result;
    }

}
