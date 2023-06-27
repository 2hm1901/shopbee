<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name'=>'required',
            'age'=>'required|integer|max:100',
            'salary'=>'required|integer',
            'position'=>'required'
        ];
    }
    public function messages(){
        return [
            'required'=>':Attribute can not be empty!',
            'max'=>':Attribute too long!',
            'integer'=>':Attribute must be a number!' 
        ];
    }
}
