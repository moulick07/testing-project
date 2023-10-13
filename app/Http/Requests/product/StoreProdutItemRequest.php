<?php

namespace App\Http\Requests\product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProdutItemRequest extends FormRequest
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
    public static function rules()
    {
        
            return [
                'color' => 'required',
                'price' => 'required|max:255',
                'final_price'=> 'required',
               
                'quantity'=>'required',
               
                'tags'=>'required',
            ];
        
    }
}
