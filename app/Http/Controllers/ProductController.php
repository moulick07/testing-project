<?php

namespace App\Http\Controllers;

use App\Http\Requests\product\StoreProductRequest;
use App\Http\Requests\product\StoreProdutItemRequest;
use App\Http\Requests\product\updateProductRequest;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\ProductItemSize;
use App\Models\ProductMedia;
use Illuminate\Support\Facades\DB;
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
            'message' => "List of Products",
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

            DB::beginTransaction();

            $input = $request->all();
            $input['ordering'] = 1;
            $product = Product::create($input);
           
            //if product created than add details to product item table 
            $input['product_id'] = $product->id;
            $checking = ProductItem::where('product_id', $product->id)->latest()->first();
            
            if ($checking) {

                $input['ordering'] = $checking->ordering + 1;
            } else {
                $input['ordering'] = 1;
            }
            $product_item = ProductItem::create($input);


            //if product item 
            if ($product_item) {
                $image = $input['image'];
                foreach ($image as $file) {
                    if ($file->extension() == 'jpeg' || $file->extension() == 'jpg' || $file->extension() == 'png') {
                        $input['type'] = "image";
                    } else {
                        $input['type'] = "video";
                    }

                    $files = [];
                    $titleimage = mt_rand(3, 9) . time() . '.' . $file->extension();

                    $files[] = $titleimage;
                    $file->move(public_path('images/product_media'), end($files));
                }

                $input['product_item_id'] = $product_item->id;
                $input['name'] = implode(",", $files);
                $input['image'] = implode(",", $files);
                $input['path'] = 'images/product_media';
               
                $checking = ProductMedia::where('product_item_id', $product_item->id)->latest()->first();
              
                if ($checking) {

                    $input['ordering'] = $checking->ordering+1 ;
                } 
                else {
                    $input['ordering'] = 1;
                }

                $product_media = ProductMedia::create($input);
                
                $input['product_item_id'] = $product_item->id;
                $item_name = $input['itemname'];
                $item_quantity = $input['itemquantity'];
                
                //if the itemname is coming in array then multiple values will be stored
                foreach($item_name as $key=>$value){    
                    $input['itemname']= $value;
                    $input['itemquantity']= $item_quantity[$key];
                    
                    $product_item_size = ProductItemSize::create($input);
                }
            }


            DB::commit();
           
                $response = [
                    'type' => 'success',
                    'code' => 200,
                    'message' => "Product store successfully",
                    'data' => $product,
                    $product_item,
                    $product_media,
                    $product_item_size
                ];
                return response()->json($response, 200);
        } catch (\Throwable $th) {
            \Log::error("something went wrong");
            DB::rollBack();
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
            'message' => "Detail Product",
            'data' => $product
        ];

        return response()->json($response, 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateProductRequest $request, Product $product, ProductMedia $productMedia)
    {

        try {


            $input = $request->all();

            if ($request->hasFile('image')) {

                //delete the existing image
                unlink(public_path('images/product_item_image/' . $productMedia->name));

                // adding the new image
                $ProductCoverimage = $input['cover_image'];
                $coverImageName = mt_rand(3, 9) . time() . '.' . $ProductCoverimage->extension();
                $ProductCoverimage->move(public_path('images/CoverImage'), $coverImageName);
                $input['cover_image'] = $coverImageName;
            }

            if ($request->hasFile('images')) {

                $Productitleimage = $input['images'];


                //updating the multiple image
                $files = [];
                foreach ($Productitleimage as $key => $file) {
                    $titleimage = mt_rand(3, 9) . time() . '.' . $file->extension();

                    $files[] = $titleimage;
                    $file->move(public_path('images/ProductImage'), end($files));
                }
                $input['images'] = implode(',', $files);

                //deleting the image which is exists with multiple
                $image = explode(",", $product->images);
                $length = count($image);
                for ($i = 0; $i < $length; $i++) {

                    unlink(public_path("images/ProductImage/" . $image[$i]));
                }


            }



            $product->update($input);
            return [
                'type' => 'success',
                'code' => 200,
                'message' => "Product updated successfully",
                'data' => $product
            ];
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
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {

            // dd($product->id);
            $product_item = ProductItem::where('product_id',$product->id)->get();
            
            $product_media = ProductMedia::where('product_item_id',$product_item[0]->id)->get();
            foreach ($product_media as $key => $value) {
                $image = explode(",", $value->image);
               
                $length = count($image);
                for ($i = 0; $i < $length; $i++) {
                    if (file_exists(public_path('images/product_media/' . $image[$i]))) {
                        unlink(public_path("images/product_media/" . $image[$i]));
                    }
                # code...
                $value->delete();   
            }

            }
           
            $product->delete();
            $product_item->delete();
            $response = [
                "type" => "success",
                "code" => 200,
                "message" => "Product deleted successfully"
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
}