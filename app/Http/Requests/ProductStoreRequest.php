<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_id'=>'bail|required|numeric',
            'name'=>'bail|required|string',
            'product_price'=>'bail|required|numeric|min:0',
            'product_off_price'=>'bail|required|numeric|min:0',
            'product_code'=>'bail|string|unique:products,product_code',
            'product_stock'=>'bail|required|numeric|min:1',
            'alert_quantity'=>'bail|required|numeric|min:1',
            'short_description'=>'bail|string|nullable',
            'long_discription_up'=>'bail|string|nullable',
            'short_discription_down'=>'bail|string|nullable',
            'delivary'=>'bail|string|nullable',
            'product_image'=>'bail|required|image',
        ];
    }
}
