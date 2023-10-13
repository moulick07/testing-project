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



            if ($input['color'] && $input['price'] && $input['final_price'] && $input['is_available'] && $input['tags']) {


                $item_color = $input['color'];
                $item_price = $input['price'];
                $item_final_price = $input['final_price'];
                $item_is_available = $input['is_available'];
                $item_tags = $input['tags'];

                //if the itemname is coming in array then multiple values will be stored
                foreach ($item_color as $key => $value) {
                    $input['color'] = $value;
                    $input['price'] = $item_price[$key];
                    $input['final_price'] = $item_final_price[$key];
                    // $input['final_price']= $item_final_price[$key];
                    $input['is_available'] = $item_is_available[$key];
                    $input['tags'] = $item_tags[$key];
                    $checking = ProductItem::where('product_id', $product->id)->latest()->first();

                    if ($checking) {

                        $input['ordering'] = $checking->ordering + 1;
                    } else {
                        $input['ordering'] = 1;
                    }
                    $product_item = ProductItem::create($input);
                }
            }

            // $product_item = ProductItem::create($input);


            //if product item 
            if ($product_item) {
                $image = $input['image'];
                $files = [];
                foreach ($image as $file) {
                    if ($file->extension() == 'jpeg' || $file->extension() == 'jpg' || $file->extension() == 'png') {
                        $input['type'] = "image";
                    } else {
                        $input['type'] = "video";
                    }


                    $titleimage = mt_rand(3, 9) . time() . '.' . $file->extension();

                    $files[] = $titleimage;
                    $file->move(public_path('images/product_media'), end($files));
                    
                }
                foreach ($files as $key => $media) {
                    
                    $input['product_item_id'] = $product_item->id;
                    $input['name'] =$media;
                    $input['image'] = $media;
                    $input['path'] = 'images/product_media';
                    $checking = ProductMedia::where('product_item_id', $product_item->id)->latest()->first();
                    if ($checking) {
    
                        $input['ordering'] = $checking->ordering + 1;
                    } else {
                        $input['ordering'] = 1;
                    }
                    $productmedia = ProductMedia::create($input);
    
                }



                if ($input['itemname'] && $input['itemquantity']) {

                    $input['product_item_id'] = $product_item->id;
                    $item_name = $input['itemname'];
                    $item_quantity = $input['itemquantity'];

                    //if the itemname is coming in array then multiple values will be stored
                    foreach ($item_name as $key => $value) {
                        $input['itemname'] = $value;
                        $input['itemquantity'] = $item_quantity[$key];

                        $product_item_size = ProductItemSize::create($input);
                    }
                }
            }


            DB::commit();

            $response = [
                'type' => 'success',
                'code' => 200,
                'message' => "Product store successfully",
                'data' => $product,
                $product_item,
               
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
    public function update(StoreProductRequest $request, Product $product)
    {

        try {


            $input = $request->all();

            $product->update($input);
            $product_item_id = ProductItem::where('product_id', $product->id)->first();
            $product_item_id->update($input);

            if ($request->hasFile('image')) {

                $productMedia = ProductMedia::where('product_item_id', $product_item_id->id)->first();
                //delete the existing image

                $Productitleimage = $input['image'];
                $files = [];
                foreach ($Productitleimage as $key => $file) {
                    $titleimage = mt_rand(3, 9) . time() . '.' . $file->extension();

                    $files[] = $titleimage;
                    $file->move(public_path('images/product_media'), end($files));
                }
                $input['image'] = implode(',', $files);
                $input['product_item_id'] = $product_item_id->id;
                $input['name'] = implode(",", $files);
                $input['image'] = implode(",", $files);
                $input['path'] = 'images/product_media';


                $productMedia->update($input);
                //deleting the image which is exists with multiple
                $image = explode(",", $productMedia->image);
                $length = count($image);
                for ($i = 0; $i < $length; $i++) {

                    unlink(public_path("images/product_media/" . $image[$i]));
                }
            }
            if ($input['itemname'] && $input['itemquantity']) {
                $item_size = ProductItemSize::where('itemname', $input['itemname'])->first();
                $input['product_item_id'] = $product_item_id->id;
                $item_name = $input['itemname'];
                $item_quantity = $input['itemquantity'];

                //if the itemname is coming in array then multiple values will be stored
                foreach ($item_name as $key => $value) {
                    $input['itemname'] = $value;
                    $input['itemquantity'] = $item_quantity[$key];

                    $product_item_size = $item_size->update($input);
                }
            }




            //updating the multiple image






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
            $product_item = ProductItem::where('product_id', $product->id)->get();

            $product_media = ProductMedia::where('product_item_id', $product_item[0]->id)->get();
            foreach ($product_media as $key => $value) {
                $image = explode(",", $value->image);

                $length = count($image);
                for ($i = 0; $i < $length; $i++) {
                    if (file_exists(public_path('images/product_media/' . $image[$i]))) {
                        unlink(public_path("images/product_media/" . $image[$i]));
                    }

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