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
use Illuminate\Support\Facades\Request;

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
    public function store(Request $request)
    {

        
        
        // dd($request);
            try {

            DB::beginTransaction();
                // dd($request);
            $input = request()->all();
            $input['ordering'] = 1;
            $product = Product::create($input);


            //if product created than add details to product item table 
            
            $input['product_id'] = $product->id;
            foreach ($input['product_item'] as $key => $product_item) {
                        $input['color'] = $product_item['color'];
                        $input['quantity'] = $product_item['quantity'];
                        $input['price'] = $product_item['price'];
                        $input['final_price'] = $product_item['final_price'];
                        $input['is_available'] = $product_item['is_available'];
                        $input['tags'] = $product_item['tags'];
                        $productitem = ProductItem::create($input);
                        
                        if($product_item){
                            // dd($product_item['image']);
                        $image = $product_item['image'];
                        $files = [];
                        foreach ($image as $file) {
                            

                        // if ($file->extension() == 'jpeg' || $file->extension() == 'jpg' || $file->extension() == 'png') {
                        //     $input['type'] = "image";
                        // } else {
                        //     $input['type'] = "video";
                        // }
                        // dd($file);

                        $titleimage = mt_rand(3, 9) . time() . '.' . $file->extension();

                        $files[] = $titleimage;
                        $file->move(public_path('images/product_media'), end($files));

                    }

                    foreach ($files as $key => $media) {

                        $input['name'] = $media;
                        $input['image'] = $media;
                        $input['path'] = 'images/product_media';
                        $productmedia = ProductMedia::create($input);
                        }
            


            // if ($input['color'] && $input['price'] && $input['final_price'] && $input['is_available'] && $input['tags']) {


            //     $item_color = $input['color'];
            //     $item_price = $input['price'];
            //     $item_final_price = $input['final_price'];
            //     $item_is_available = $input['is_available'];
            //     $item_tags = $input['tags'];

            //     //if the item name is coming in array then multiple values will be stored
            //     foreach ($item_color as $key => $value) {
                    
            //         $input['color'] = $value;
            //         $input['price'] = $item_price[$key];
            //         $input['final_price'] = $item_final_price[$key];
            //         $input['is_available'] = $item_is_available[$key];
            //         $input['tags'] = $item_tags[$key];
            //         // $checking = ProductItem::where('product_id', $product->id)->latest()->first();
                    
            //         // if ($checking) {
                        
            //             //     $input['ordering'] = $checking->ordering + 1;
            //             // } else {
            //                 //     $input['ordering'] = 1;
            //                 // }
                            
                            
            //         $product_item = ProductItem::create($input);
                        
            //         \Log::info($product_item);
                    
                   
            //         $product_itemid[] = $product_item->id;
                    
            //     }
        
            //     if ($product_item) {
            //         foreach ($product_itemid as $key => $itemId) {
            //             $input['product_item_id'] = $itemId;
            //         }
            //         $image = $input['image'];
            //         $files = [];
            //         foreach ($image as $file) {

            //             if ($file->extension() == 'jpeg' || $file->extension() == 'jpg' || $file->extension() == 'png') {
            //                 $input['type'] = "image";
            //             } else {
            //                 $input['type'] = "video";
            //             }


            //             $titleimage = mt_rand(3, 9) . time() . '.' . $file->extension();

            //             $files[] = $titleimage;
            //             $file->move(public_path('images/product_media'), end($files));

            //         }

            //         foreach ($files as $key => $media) {

            //             $input['name'] = $media;
            //             $input['image'] = $media;
            //             $input['path'] = 'images/product_media';
            //             $checking = ProductMedia::where('product_item_id', $product_item->id)->latest()->first();
            //             if ($checking) {

            //                 $input['ordering'] = $checking->ordering + 1;
            //             } else {
            //                 $input['ordering'] = 1;
            //             }
            //             $productmedia = ProductMedia::create($input);

            //         }



            //         if ($input['itemname'] && $input['itemquantity']) {

            //             $input['product_item_id'] = $product_item->id;
            //             $item_name = $input['itemname'];
            //             $item_quantity = $input['itemquantity'];

            //             //if the itemname is coming in array then multiple values will be stored
            //             foreach ($item_name as $key => $value) {
            //                 $input['itemname'] = $value;
            //                 $input['itemquantity'] = $item_quantity[$key];

            //                 $product_item_size = ProductItemSize::create($input);
            //                 // dd($value);
            //             }
            //         }
            //     }
            // }

            // $product_item = ProductItem::create($input);


            //if product item 


            DB::commit();

            $response = [
                'type' => 'success',
                'code' => 200,
                'message' => "Product store successfully",
                'data' => $product,
                
            ];   
        }
            }
            return response()->json($response, 200);
        } 
        catch (\Throwable $th) {
            \Log::error($th);
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

            $product_item_ids = ProductItem::where('product_id', $product->id)->pluck('id');

            if ($input['color']) {
                $item_colors = $input['color'];
                $item_prices = $input['price'];
                $item_final_prices = $input['final_price'];
                $item_is_availables = $input['is_available'];
                $item_tags = $input['tags'];

                $product_items = ProductItem::whereIn('id', $product_item_ids)->get();

                foreach ($product_items as $key => $product_item) {
                    $product_item->color = $item_colors[$key];
                    $product_item->price = $item_prices[$key];
                    $product_item->final_price = $item_final_prices[$key];
                    $product_item->is_available = $item_is_availables[$key];
                    $product_item->tags = $item_tags[$key];
                    $product_item->save();
                }
            }

            if ($request->hasFile('image')) {
                $productMedias = ProductMedia::whereIn('product_item_id', $product_item_ids)->get();

                $Productitleimages = $input['image'];
                $files = [];

                foreach ($Productitleimages as $key => $file) {
                    $titleimage = mt_rand(3, 9) . time() . '.' . $file->extension();
                    $files[] = $titleimage;
                    $file->move(public_path('images/product_media'), $titleimage);
                }

                foreach ($productMedias as $key => $mediaupdate) {
                    $mediaupdate->name = $files[$key];
                    $mediaupdate->image = $files[$key];
                    $mediaupdate->path = 'images/product_media';
                    $mediaupdate->save();
                }
            }

            if ($input['itemname'] && $input['itemquantity']) {
                $item_names = $input['itemname'];
                $item_quantities = $input['itemquantity'];

                $product_item_sizes = ProductItemSize::whereIn('product_item_id', $product_item_ids)->get();

                foreach ($product_item_sizes as $key => $item_size) {
                    $item_size->itemname = $item_names[$key];
                    $item_size->itemquantity = $item_quantities[$key];
                    $item_size->save();
                }
            }

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

            // dd();
            $product->productItem()->productMedia()->delete();
            $product->productItem()->productSize()->delete();
            $product->productItem()->delete();
            $product->delete();
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