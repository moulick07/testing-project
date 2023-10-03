<?php

namespace App\Http\Controllers;

use App\Http\Requests\product\StoreProductRequest;
use App\Http\Requests\product\updateProductRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Product = Product::paginate(20);
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

            $ProductCoverimage = $request['cover_image'];
            $Productitleimage = $input['images'];







            // $input['images'] = implode(",",$files);

            $titleimage = time() . '.' . $Productitleimage->extension();
            $coverImageName = time() . '.' . $ProductCoverimage->extension();

            $ProductCoverimage->move(public_path('images/CoverImage'), $coverImageName);
            $Productitleimage->move(public_path('images/ProductImage'), $titleimage);


            $input = $request->all();
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
    public function show(string $id)
    {
        $detailproduct = Product::where('id', $id)->first();

        return response()->json($detailproduct);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateProductRequest $request, Product $product)
    {

      try{

      
        $update_input = $request->all();

        $ProductCoverimage = $request['cover_image'];
        $Productitleimage = $update_input['images'];


        $titleimage = time() . '.' . $Productitleimage->extension();
        $coverImageName = time() . '.' . $ProductCoverimage->extension();

        $ProductCoverimage->move(public_path('images/CoverImage'), $coverImageName);
        $Productitleimage->move(public_path('images/ProductImage'), $titleimage);


        $product->update($request->all());
        return [
            "status" => 200,
            
            "msg" => "Product updated successfully"
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


        $product->delete();
        return [
            "status" => 1,
            "data" => $product,
            "msg" => "Product deleted successfully"
        ];
    }
}