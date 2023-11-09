<?php

namespace TomatoPHP\TomatoProducts\Http\Requests\ProductReview;

use Illuminate\Foundation\Http\FormRequest;

class ProductReviewStoreRequest extends FormRequest
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
            'product_id' => 'required|min:1|exists:products,id',
            'account_id' => 'required|min:1',
            'rate' => 'required|min:1',
            'review' => 'nullable|min:1',
            'is_activated' => 'nullable|min:1',

        ];
    }
}
