<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductItem;
use App\Models\ProductItemSize;
use App\Models\ProductMedia;
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
     *  one product with its multiple items and that multiple item have multiple images and sizes.
     *
     */

     public function testStoreProduct()
     {

        $productData = [
            'name' => 'Product A',
            'short_description' => 'This is a test product',
            'is_active'=>1,
            'brand'=>'gucci',  
            
        ];
        $product = Product::create($productData);
        $itemsData = [
            [
                'color' => 'Item 1',
                'tags'=>"long tunics",
                'price'=>100,
                'final_price'=>90,
                'is_available'=>1,
                'ordering'=>1,
                'quantity'=>10,
                'product_id' => $product->id,
            ],
            [
                'color' => 'Item 2',
                'tags'=>"short tunics",
                'price'=>100,
                'quantity'=>9,
                'final_price'=>90,
                'is_available'=>1,
                'ordering'=>2,
                'product_id' => $product->id,
            ],
        ];
       
          
            $items = ProductItem::create($itemsData);
            
            $itemImagesData = [
                [
                    'product_item_id' => $items->id,
                    'image' => 'item1_image1.jpg',
                ],
                [
                    'product_item_id' => $items->id,
                    'image' => 'item1_image2.jpg',
                ],
                
            ];
            $itemImages = ProductMedia::create($itemImagesData);
    
            // Create sizes for each item
            $itemSizesData = [
                [
                    'product_item_id' => $items[0]->id,
                    'size' => 'Size 1',
                    'quantity' => 10,
                ],
                [
                    'product_item_id' => $items[0]->id,
                    'size' => 'Size 2',
                    'quantity' => 5,
                ],
                [
                    'product_item_id' => $items[1]->id,
                    'size' => 'Size 3',
                    'quantity' => 8,
                ],
            ];
            $itemSizes = ProductItemSize::create($itemSizesData);
     

        // Attach images to each ite
     } 
    // fetching all the Products
    public function test_for_product_fetching_all()
    {
        $this->test_for_product_creating("no");
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
        $this->test_for_product_creating("no");
        $product = Product::where('deleted_at', null)->latest()->first();
        
        $api = 'api/product/' . $product->id;
        $product = [
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

        $response = $this->put($api, $product);
            $this->removeImages(explode(',',$response['data']['images']),$response['data']['cover_image']);
 
       

        $response->assertJson([
            'type' => "success",
            
        ]);
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
        $this->test_for_product_creating("no");
        $product = Product::where('deleted_at', null)->latest()->first();

        $api = 'api/product/' . $product->id;
    
        // $this->removeImages(explode(',',$productid->images),$productid->cover_image);
        $response = $this->deleteJson($api);



      

        $response
            ->assertJson([
                'type' => "success",
                'code' => 200,
                'message' => 'Product deleted successfully'
            ]);
    }

    // //required validation test case
    public function test_for_product_validation_required()
    {

        $api = 'api/product';

        $product = [
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

        $response = $this->postJson($api, $product);
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

    //check if image is greater than 2mb 
    public function test_for_product_image_size_testing()
    {
        $this->test_for_product_creating("no");
        $product = Product::where('deleted_at', null)->latest()->first();
        
        $api = 'api/product/' . $product->id;
        $product = [
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

        $response = $this->put($api, $product);

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

//remove image function
    public function removeImages($productImage,$coverImage)
    {
        // remove product images
        foreach($productImage as $image)
        {
            $imagePath = public_path().'/images/product_image/'.$image;
            unlink($imagePath);
        }

        $coverImagePath = public_path().'/images/cover_image/'.$coverImage;
      
        unlink($coverImagePath);

    }


}
