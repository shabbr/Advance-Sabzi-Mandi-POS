<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=> 'required|string|unique:sellers,name',
            'phone'=>'required|numeric|digits:11',
            'account' =>'required',
            'area' => 'required|string'
        ];
    }
    public function messages()
    {
        return [
            'name.unique' => 'This username already exist in your Sellers List or Trash',
            // Other custom error messages...
        ];
    }
}
