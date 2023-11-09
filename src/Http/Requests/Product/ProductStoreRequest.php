<?php

namespace TomatoPHP\TomatoProducts\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|array',
            'name*' => 'required|max:255|min:1',
            'slug' => 'nullable|max:255|min:1',
            'sku' => 'nullable|max:255|min:1|unique:products,sku',
            'barcode' => 'nullable|max:255|min:1|unique:products,barcode',
            'type' => 'nullable|max:255|min:1',
            'about' => 'nullable|max:255|min:1',
            'price' => 'required|min:1',
            'discount' => 'nullable|min:1',
            'discount_to' => 'nullable|min:1',
            'vat' => 'nullable|min:1',
            'description' => 'nullable|array',
            'description*' => 'nullable|string|min:1',
            'details' => 'nullable|array',
            'details*' => 'nullable|string|min:1',
            'category_id' => 'nullable|min:1|exists:categories,id',
            'categories' => 'nullable|array',
            'categories*' => 'nullable|min:1|exists:categories,id',
            'tags' => 'nullable|array',
            'tags*' => 'nullable|min:1|exists:categories,id',
            'brand' => 'nullable|min:1|exists:types,id',
            'unit' => 'nullable|min:1|exists:types,key',
            'is_shipped' => 'nullable|min:1',
            'is_activated' => 'nullable|min:1',
            'is_trend' => 'nullable|min:1',
            'is_in_stock' => 'nullable|min:1',
            'has_options' => 'nullable|min:1',
            'has_multi_price' => 'nullable|min:1',
            'has_unlimited_stock' => 'nullable|min:1',
            'has_max_cart' => 'nullable|min:1',
            'min_cart' => 'nullable|min:1',
            'max_cart' => 'nullable|min:1',
            'has_stock_alert' => 'nullable|min:1',
            'min_stock_alert' => 'nullable|min:1',
            'max_stock_alert' => 'nullable|min:1',
            'options' => 'nullable|array',
            'qty' => 'nullable|array',
            'images' => 'nullable|array',
            'images*' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'featured_image' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ];
    }
}
