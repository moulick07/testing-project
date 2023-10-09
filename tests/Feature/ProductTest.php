<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Carbon\Carbon;


class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_for_product_creating()
    // {
    //     Storage::fake('avatars'); // Set the disk you want to use for testing

    //     $file = UploadedFile::fake()->image('avatar.jpg');// Create a fake image file
    //     // Assert your response or perform other tests
      
    //     $api = 'api/product';
        
    //     $filename = 'logo.jpg';
    //     $Product =[
    //         'name' => 'Running shoes',
    //         'short_description' => 'running shoes',
    //         'discounted_price'=>20,
    //         'in_stock'=>20,
    //         'is_active'=>1,
    //         'brand'=>'Nike',
    //         'cover_image' => $file,
    //         'main_category'=>1,
    //         'category'=>1,
    //         'images' => $file,
    //         'value'=>30,
    //         'variant'=>23,
    //         'parent_product'=>2,
    //         'price'=>20,
    //         'long_description'=>'shoes which are light weight with amazing',
    //     ];
        
    //     Storage::disk('avatars')->assertExists($file->hashName());
   
    //     $response = $this->post($api, $Product);
    //     $response
    //     ->assertJson([
    //             'type' => "success",

    //         ]);
            
    // }

   
}

