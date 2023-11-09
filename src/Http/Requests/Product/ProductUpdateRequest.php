<?php

namespace TomatoPHP\TomatoProducts\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'name' => 'sometimes|max:255|min:1',
            'slug' => 'nullable|max:255|min:1',
            'sku' => 'nullable|max:255|min:1|unique:products,sku,'. $this->route("model")->id,
            'barcode' => 'nullable|max:255|min:1|unique:products,barcode,'. $this->route("model")->id,
            'type' => 'nullable|max:255|min:1',
            'about' => 'nullable|max:255|min:1',
            'price' => 'sometimes|min:1',
            'discount' => 'nullable|min:1',
            'discount_to' => 'nullable|min:1',
            'vat' => 'nullable|min:1',
            'description' => 'nullable|min:1',
            'details' => 'nullable|min:1',
            'category_id' => 'nullable|min:1|exists:categories,id',
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

        ];
    }
}
