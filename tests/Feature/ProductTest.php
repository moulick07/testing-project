<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use factory;
use Tests\TestCase;
use Carbon\Carbon;


class ProductTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     */
    public function test_for_product_creating()
    {

        $this->withoutExceptionHandling();
       
        $api = 'api/product';
        

        $Product = [
            'name' => 'Running shoes',
            'short_description' => 'running shoes',
            'discounted_price' => 20,
            'in_stock' => 20,
            'is_active' => 1,
            'brand' => 'Nike',
            'cover_image' =>  UploadedFile::fake()->create("test.jpg", 100),
            'main_category' => 1,
            'category' => 1,
            'images' => [
                0 => UploadedFile::fake()->create("test.jpg", 100),
                1 => UploadedFile::fake()->create("test.png", 100),
                2 => UploadedFile::fake()->create("test.png", 100),],
            'value' => 30,
            'variant' => 23,
            'parent_product' => 2,
            'price' => 20,
            'long_description' => 'shoes which are light weight with amazing',
        ];

        // Storage::disk('avatars')->assertExists($file->hashName());

        $response = $this->post($api, $Product);
        $response
            ->assertJson([
                'type' => "success",

            ]);

    }
    // fetching all the Products
    public function test_for_product_fetching_all()
    {
        $this->test_for_product_creating();
        $api = 'api/product';


        $response = $this->getJson($api);

        $response
            ->assertJson([
                'type' => "success",
                'code' => 200,
                'message' => 'List of Products'
            ]);
    }

    // //updating product
    public function test_for_product_updating()
    {
        $this->test_for_product_creating();
        $product = Product::where('deleted_at', null)->latest()->first();
        
        $api = 'api/product/' . $product->id;
        $Product = [
            'name' => 'Running',
            'short_description' => 'running shoes',
            'discounted_price' => 20,
            'in_stock' => 20,
            'is_active' => 1,
            'brand' => 'Nike',
            'cover_image' =>  UploadedFile::fake()->create("test.jpg", 100),
            'main_category' => 1,
            'category' => 1,
            'images' =>[
                0 => UploadedFile::fake()->create("test.jpg", 100),
                1 => UploadedFile::fake()->create("test.png", 100),],
            'value' => 30,
            'variant' => 23,
            'parent_product' => 2,
            'price' => 20,
            'long_description' => 'shoes which are light weight with amazing',
        ];

        $response = $this->put($api, $Product);

        $response
            ->assertJson([
                'type' => "success",
                'code' => 200,
                'message' => 'Product updated successfully'
            ]);
    }

    // //deleting product
    public function test_for_product_deleting()
    {
        $this->test_for_product_creating();
        $productid = Product::where('deleted_at', null)->latest()->first();

        $api = 'api/product/' . $productid->id;

        $response = $this->deleteJson($api);


        $response
            ->assertJson([
                'type' => "success",
                'code' => 200,
                'message' => 'Product deleted successfully'
            ]);
    }

    //required validation test case
    public function test_for_product_validation_required()
    {

        $api = 'api/product';

        $Product = [
            'name' => '',
            'short_description' => '',
            'discounted_price' => '',
            'in_stock' => '',
            'is_active' => '',
            'brand' => '',

            'main_category' => '',
            'category' => '',

            'value' => '',
            'variant' => '',
            'parent_product' => '',
            'price' => '',
            'long_description' => '',
        ];

        $response = $this->postJson($api, $Product);
        $response
            ->assertJson([
                'type' => "error",
                'code' => 422,
                'message' => 'Server Validation Fail',
                "errors" => [
                    "name" => [
                        "Please Write a title"
                    ],
                    "short_description" => [
                        "Please write some short description"
                    ],
                    "long_description" => [
                        "The long description field is required."
                    ],
                    "in_stock" => [
                        "The in stock field is required."
                    ],
                    "price" => [
                        "The price field is required."
                    ],
                    "discounted_price" => [
                        "The discounted price field is required."
                    ],
                    "brand" => [
                        "The brand field is required."
                    ],
                    "category" => [
                        "The category field is required."
                    ],
                    "value" => [
                        "The value field is required."
                    ],
                    "parent_product" => [
                        "The parent product field is required."
                    ],
                    "main_category" => [
                        "Please add 1 main Category"
                    ],
                    "variant" => [
                        "please atleast 1 variant"
                    ],
                    "is_active" => [
                        "The is active field must be true or false."
                    ]
                ]
            ]);
    }

    public function test_for_product_image_size_texting()
    {
        $this->test_for_product_creating();
        $product = Product::where('deleted_at', null)->latest()->first();
        
        $api = 'api/product/' . $product->id;
        $Product = [
            'name' => 'Running',
            'short_description' => 'running shoes',
            'discounted_price' => 20,
            'in_stock' => 20,
            'is_active' => 1,
            'brand' => 'Nike',
            'cover_image' =>  UploadedFile::fake()->create("test.jpg", 3000),
            'main_category' => 1,
            'category' => 1,
            'images' =>[
                0 => UploadedFile::fake()->create("test.jpg", 3000),
                1 => UploadedFile::fake()->create("test.png", 3000),],
            'value' => 30,
            'variant' => 23,
            'parent_product' => 2,
            'price' => 20,
            'long_description' => 'shoes which are light weight with amazing',
        ];

        $response = $this->put($api, $Product);

        $response
            ->assertJson([
                'type' => "error",
                'code' => 422,
                'message' => 'Server Validation Fail',
                "errors" => ["cover_image" => [
                    "The cover image field must not be greater than 2048 kilobytes."
                ]]
            ]);
    }


}