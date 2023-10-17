<?php
namespace App\Http\Requests\product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreProductRequest extends FormRequest
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
            'name' => 'required',
            'short_description' => 'required|max:255',
            'brand' => 'required',
            'category_id' => 'required',
            'product_type' => 'required',
            'color' => 'required',
            'price' => 'required',
            'final_price' => 'required',
            'quantity' => 'required',
            'tags' => 'required',
            'image*' => 'required|mimes:png,jpg,jpeg|max:2048',
            'itemname*' => 'required',
            'itemquantity*' => 'required',

            // Add other rules here
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Please Write a title",
            "short_description.required" => "Please write some short description",
            "brand.required" => "Please write brand's name",
            "category_id.required" => "Please select 1 category",
            "cover_image.required" => "Please add one cover image",
            "product_type.required" => "Please add Product Type",
            "is_active.required" => "Please add either active or inactive for the product",
            "color.required" => "Please enter the color for the product item",
            "price.required" => "Please enter the price for the product item",
            "final_price.required" => "Please enter the final price for the product item",
            "is_available.required" => "Please enter whether the product item is available or not",
            "quantity.required" => "Please enter the quantity for the product",
            "tags.required" => "Please enter the tag for the product",
            "image.required" => "Please select at least 1 image for the product",
        ];
    }

    protected function failedValidation($validator)
    {
        $response = [
            'type' => 'error',
            'code' => 422,
            'message' => "Server Validation Fail",
            'errors' => $validator->errors()
        ];

        throw new HttpResponseException(response()->json($response, 422));
    }

}