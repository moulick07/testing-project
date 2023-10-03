<?php

namespace App\Http\Requests\category;

use Illuminate\Foundation\Http\FormRequest;

class updateCategoryRequest extends FormRequest
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
           
            'title' => 'required',
            'description' => 'required|max:255',
            'is_parent' => 'required',
            'parent_category' => 'required',
      
    ];
    }
    public function messages()
    {
        return [
            "title.required" => "Please Write a title",
            "description.required" => "Please write some description",
            "is_parent.requried" => "Please select whether category is parent or not",
            "parent_category.requried" => "Please select parent category",
        ];
    }
}
