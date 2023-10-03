<?php

namespace App\Http\Controllers;

use App\Http\Requests\product\StoreProductRequest;
use App\Http\Requests\product\updateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Product = Product::paginate(10);
        $response = [
            'type' => 'success',
            'code' => 200,
            'message' => "List",
            'data' => $Product
        ];

        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {

        try {

            $input = $request->all();
            
            $ProductCoverimage = $input['cover_image'];
            $Productitleimage = $input['images'];
          
            $files = [];
            foreach($Productitleimage as $key=>$file)
            {
                $titleimage = mt_rand(3,9).time() . '.' . $file->extension();
               
                $files[] = $titleimage;  
                $file->move(public_path('images/ProductImage'), end($files));
            } 
            $coverImageName = mt_rand(3,9).time() . '.' . $ProductCoverimage->extension();
            $ProductCoverimage->move(public_path('images/CoverImage'), $coverImageName);
           

            $input['images'] = implode(",",$files);
            $input['cover_image'] = $coverImageName;
            
            $input['slug'] = Product::generateSlug($input['name']);
            $product = Product::create($input);
            $response = [
                'type' => 'success',
                'code' => 200,
                'message' => "Product store successfully",
                'data' => $product
            ];

            return response()->json($response, 200);

        } catch (\Throwable $th) {

            $response = [
                'type' => 'error',
                'code' => 500,
                'message' => $th->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $response = [
            'type' => 'success',
            'code' => 200,
            'message' => "Detail",
            'data' => $product
        ];

        return response()->json($response,200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateProductRequest $request, Product $product)
    {

      try{

      
        $input = $request->all();
        // dd($input);
        $ProductCoverimage = $input['cover_image'];
        $Productitleimage = $input['images'];
      

        // $input['images'] = implode(",",$files);
        $files = [];
        foreach($Productitleimage as $key=>$file)
        {
            $titleimage = mt_rand(3,9).time() . '.' . $file->extension();
           
            $files[] = $titleimage;  
            $file->move(public_path('images/ProductImage'), end($files));
        } 
        $coverImageName = mt_rand(3,9).time() . '.' . $ProductCoverimage->extension();

        $ProductCoverimage->move(public_path('images/CoverImage'), $coverImageName);
       

        $input['images'] = implode(',',$files);
        $input['cover_image'] = $coverImageName;
        $input['slug'] = Product::setProductSlugAttribute($input['name']);

        $product->update($input);
        return [
            'type' => 'success',
            'code' => 200,
            'message' => "Product updated successfully",
            'data' => $product
        ];
    }catch (\Throwable $th) {

        $response = [
            'type' => 'error',
            'code' => 500,
            'message' => $th->getMessage()
        ];
        return response()->json($response, 500);
    }
    
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            if(file_exists(public_path('images/CoverImage/'.$product->cover_image)) ){
                $image = explode(",",$product->images);
                $length = count($image);
                for ($i = 0; $i < $length; $i++) {
                    unlink(public_path("images/ProductImage/".$image[$i]));
                }
                unlink(public_path('images/CoverImage/'.$product->cover_image));
                
                }
            $product->delete();
                $response =  [
                    "type" => "success",
                    "code"=> 200,
                    "message" => "Product deleted successfully"
                ];
                return response()->json($response,200);
            
        } catch (\Throwable $th) {
            $response = [
                'type' => 'error',
                'code' => 500,
                'message' =>  $th->getMessage()
            ];
            return response()->json($response, 500);
        }        
    }
}