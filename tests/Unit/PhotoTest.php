<?php

namespace Tests\Unit;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;


class PhotoTest extends TestCase
{
    /**
     * A basic unit test example.
     */

    //required validation if the file is either image (png, jpeg , jpg) or video (mp4)
    public function test_for_image_type()
    {
        $api = 'api/photo/';

        // positive condition 
        $product_image = [
            'product_image' => [
                0 => UploadedFile::fake()->create('sample.mp4', '1000', 'mp4'),
                1 => UploadedFile::fake()->create("test.jpg", 100),

            ],
        ];

        $response = $this->post($api, $product_image);

        $response
            ->assertJson([
                'type' => "success",
                'code' => 200,
                'message' => 'photo created to temp folder',
                'data'=>$response['data']
            ]);
            
        $this->removeImage($response['data']);
    }

    public function test_for_file_type()
    {
        $api = 'api/photo/';
        
        // negative condition 
        $product_image = [
            'product_image' => [
                0 => UploadedFile::fake()->create('sample.pdf', '1000', 'pdf'),
                
            ],
        ];

        $response = $this->post($api, $product_image);
        $response
            ->assertJson([
                'status' => 400,
            ]);
    }

    public function removeImage($images){
        foreach($images as $image)
        {
            $imagePath = public_path().'/images/temp/'.$image;
        
            unlink($imagePath);
        }
    }
}
