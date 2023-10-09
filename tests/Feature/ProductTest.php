<?php

namespace Tests\Feature;

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
      
    //     $response = $this->post('/your-route', [
           
    //     ]);

    //     // Assert your response or perform other tests
    //     $response->assertStatus(200);
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
    //         'created_at' => Carbon::now(),
    //         'updated_at' => Carbon::now(),
    //     ];
        
    //     Storage::disk('avatars')->assertExists($file->hashName());
    //     //$user = User::create($userData);
        
    //     $response = $this->post($api, $Product);
    //     // dd($api);  
    //     $response
    //     ->assertJson([
    //             'type' => "success",

    //         ]);
            
    // }
}

