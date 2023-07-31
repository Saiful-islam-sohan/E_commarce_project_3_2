<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponStorerequest extends FormRequest
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
            'coupon_name'=>'bail|required|string|unique:coupons,coupon_name',
            'discount_amount'=>'bail|required|numeric',
            'minimum_purchase_amount'=>'bail|required|numeric',
            'validity_till'=>'bail|required|date'
        ];
    }
}
