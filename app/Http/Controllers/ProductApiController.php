<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();

        return response()->json($product);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $categories = Product::all();
        // dd($request->all());
        $input = $request->all();
        // dd($input);
        $ProductCoverimage = $request['cover_image'];
        $Productitleimage = $input['images'];


       
       
           
           
          
            // $input['images'] = implode(",",$files);
        
            $titleimage = time() . '.' . $Productitleimage->extension();
            $coverImageName = time() . '.' . $ProductCoverimage->extension();

        $ProductCoverimage->move(public_path('images/CoverImage'), $coverImageName);
        $Productitleimage->move(public_path('images/ProductImage'), $titleimage);

       $product =  Product::create($input);

      return [
            "status" => 1,
            "data" => $product,
        ];
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
    public function update(StoreProductRequest $request, Product $product)
    {
        
        $categories = Product::all();
        // dd($request->all());
        $update_input = $request->all();

        $ProductCoverimage = $request['cover_image'];
        $Productitleimage = $update_input['images'];


        $titleimage = time() . '.' . $Productitleimage->extension();
        $coverImageName = time() . '.' . $ProductCoverimage->extension();

    $ProductCoverimage->move(public_path('images/CoverImage'), $coverImageName);
    $Productitleimage->move(public_path('images/ProductImage'), $titleimage);


        $product->update($request->all());
        return [
            "status" => 1,
            "data" => $product,
            "msg" => "Product updated successfully"
        ];
        
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