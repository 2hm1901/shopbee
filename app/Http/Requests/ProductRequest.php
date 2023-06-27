<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'=>'required',
            'price'=>'required|integer',
            'id_brand'=>'required',
            'id_category'=>'required',
            'status'=>'required',
            'images.*'=>'required|image|mimes:jpeg,png,jpg,gif|max:1024'
        ];
    }
}
