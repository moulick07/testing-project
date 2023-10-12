<?php

namespace App\Http\Requests\product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
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
    public function rules()
    {
        
    
        return array_merge(StoreProdutItemRequest::rules(), StoreProductItemSizeRequest::rules(),StoreProductMediaRequest::rules(), [
            'name' => 'required',
            'short_description' => 'required|max:255',
            'brand'=> 'required',
            'category_id'=> 'required',
            'product_type'=>'required',
            'is_active'=>'boolean',
        ]);
    }

    public function messages()
    {
       
        return [
            "name.required" => "Please Write a title",
            "short_description.required" => "Please write some short description",
            "brand.requried" => "Please write brand's name  ",
            "category_id.requried" => "Please select 1 category",
            "cover_image.requried" => "Please add one cover image ",
            "product_type.requried" => "Please add Product Type ",
            "is_active.requried" => "Please add either active or inactive for the product  ",
            "color.required"=> "Please enter the color for the product item",
            "price.required"=> "Please enter the price for the product item",
            "final_price.required"=> "Please enter the final price  for the product item",
            "is_available.required"=> "Please enter whether the product item is available or not",
            "quantity.required" => "Plese enter the quantity for the product ",
            "tags.required" => "Plese enter the tag for the product ",
            "image.required" => "Plese select atleast 1 image for the product",
           
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = [
            'type' => 'error',
            'code' => 422,
            'message' => "Server Validation Fail",
            'errors' =>$validator->errors()
        ];

        /**
         * Return response data in json formate
         */
        throw new HttpResponseException(response()->json($response, 422));
    }

}
