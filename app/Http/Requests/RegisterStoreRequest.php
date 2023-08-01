<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStoreRequest extends FormRequest
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
            'name'=>'bail|required|string',
            'phone'=>'bail|required|string|max:11',
            'email'=>'bail|required|string|email',
            'password'=>'bail|required|string|confirmed|min:4'
        ];
    }
}
