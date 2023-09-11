<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            'name'=>'bail|required|string|max:255',
            'email'=>'bail|required|string|email',
            'phone'=>'bail|required|string|max:255',
            'district'=>'bail|required|string|max:255',
            'address'=>'bail|required|string|max:255',
            'order_note'=>'bail|nullable|strin',
        ];
    }
}
