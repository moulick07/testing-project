<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;


class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_for_product_creating()
    // {
    //     // $faker = Faker::create();
    //     // $fakermultiple = Faker::create(2);

    //     $api = 'api/product';
        
        
    //     $Product =[
    //         'name' => 'Running shoes',
    //         'short_description' => 'running shoes',
    //         'discounted_price'=>20,
    //         'in_stock'=>20,
    //         'is_active'=>1,
    //         'brand'=>'Nike',
            
    //         'main_category'=>1,
    //         'category'=>1,
           
    //         'value'=>30,
    //         'variant'=>23,
    //         'parent_product'=>2,
    //         'price'=>20,
    //         'long_description'=>'shoes which are light weight with amazing',
    //         'created_at' => Carbon::now(),
    //         'updated_at' => Carbon::now(),
    //     ];
     
    //     //$user = User::create($userData);
        
    //     $response = $this->postJson($api, $Product, [
    //         'coverImage' => $file = UploadedFile::fake()->image('random.jpg'),'images'=> $file = UploadedFile::fake()->image('random.jpg'),
            
    //     ]);
    //     // dd($api);  
    //     $response
    //     ->assertJson([
    //             'type' => "success",

    //         ]);
    // }
}

