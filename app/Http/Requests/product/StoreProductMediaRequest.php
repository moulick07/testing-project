<?php

namespace App\Http\Requests\product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;


class StoreProductMediaRequest extends FormRequest
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
    public static function rules(): array
    {
        return [
            // 'image' => 'required|',
           'image*' => 'required|mimes:png,jpg,jpeg|max:2048',
        ];


    }

}
