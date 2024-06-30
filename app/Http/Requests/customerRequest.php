<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class customerRequest extends FormRequest
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
            'name'=> 'required|string|unique:customers,name',
            'phone'=>'required|numeric|digits:11',
            'area' => 'required|string'
        ];
    }
    public function messages()
    {
        return [
            'name.unique' => 'This username already exist in your Customers List or Trash',
            // Other custom error messages...
        ];
    }
}
