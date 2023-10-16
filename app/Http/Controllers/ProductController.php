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
        // dd(request()->all());
        try {

            DB::beginTransaction();
                
            $input = request()->all();
            $input['ordering'] = 1;
            $product = Product::create($input);


            //if product created than add details to product item table 
            $input['product_id'] = $product->id;
            // dd($input['product_item']);
            foreach ($input['product_item'] as $key => $product_item)
            {
                

                $input['color'] = $product_item['color'];
                $input['quantity'] = $product_item['quantity'];
                $input['price'] = $product_item['price'];
                $input['final_price'] = $product_item['final_price'];
                $input['is_available'] = $product_item['is_available'];
                $input['tags'] = $product_item['tags'];
                $productitem = ProductItem::create($input);
                foreach ($product_item['image'] as $key=> $img) {
                 
                    $base64Image = file_get_contents($img);
                    $fileName = mt_rand(3, 9) .time(). '.png'; // You can generate a unique filename with the appropriate extension.
                    $folderPath = public_path('images/product_media'); 
                    if (!file_exists($folderPath)) {
                        mkdir($folderPath, 0755, true); // Create the folder if it doesn't exist.
                    }
                    $imagePath = $folderPath . '/' . $fileName;

                    // Save the image to the folder in the public directory.
                    file_put_contents($imagePath, $base64Image);
                    $product_media =  ProductMedia::create([
                        'name'=>$fileName,
                        "image"=>$fileName,
                        'path'=>$folderPath,
                        'ordering'=>$key+1,
                        'product_item_id'=>$productitem->id,

                    ]);
                
                }
                $testArray2=[];
            //    dd($product_item['product_item_size']);
                foreach ($product_item['product_item_size'] as $item_key => $itemname) {
                // dd($itemname['id']);
                $testArray2 =  [
                    'itemname' => $itemname['itemname'],
                    'itemquantity'=>$itemname['itemquantity'],
                    'product_item_id' =>$productitem->id
                ];
                // dd($testArray2);
                $productsize = ProductItemSize::create($testArray2);
                //dd($productsize);
                }
            }
            DB::commit();

            $response = [
                'type' => 'success',
                'code' => 200,
                'message' => "Product store successfully",
                'data' => $product,
                
            ];   
            
            return response()->json($response, 200);
        }catch (\Throwable $th) {
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
    public function update(Request $request, Product $product)
    {

        try {

            $input = request()->all();
            // dd($product);
            $product->update($input);

            $product_item_ids = ProductItem::where('product_id', $product->id)->get()->pluck('id')->toArray();
            // $product->productItem()->productMedia()->delete();
            //    $delete_item = ProductItemSize::whereIn('product_item_id',$product_item_ids)->delete();
            // dd($product->id);
            $testArray = [];
            foreach ($input['product_item'] as $key => $product_item) {
                $testArray['product_id'] = $product->id;
                $testArray['color'] = $product_item['color'];
                $testArray['quantity'] = $product_item['quantity'];
                $testArray['price'] = $product_item['price'];
                $testArray['final_price'] = $product_item['final_price'];
                $testArray['is_available'] = $product_item['is_available'];
                $testArray['tags'] = $product_item['tags'];
                $testArray['ordering'] = $key;
                // dd($product_item_ids);

                $productitem = ProductItem::updateOrCreate(['id'=>$product_item['id']],$testArray);
                // dd($productitem);

                // dd($productitem);
                // foreach ($product_item['image'] as $key=> $img) {
                //     # code...
                //     $base64Image = file_get_contents($img);
                //     $fileName = mt_rand(3, 9) .time(). '_' . uniqid() . '.png'; // You can generate a unique filename with the appropriate extension.
                //     $folderPath = public_path('images/product_media'); 
                //     if (!file_exists($folderPath)) {
                //         mkdir($folderPath, 0755, true); // Create the folder if it doesn't exist.
                //     }
                //     $imagePath = $folderPath . '/' . $fileName;

                //     // Save the image to the folder in the public directory.
                //     file_put_contents($imagePath, $base64Image);
                //     $product_media =  ProductMedia::create([
                //         'name'=>$fileName,
                        
                //         'path'=>$folderPath,
                //         'ordering'=>$key+1,
                //         'product_item_id'=>$productitem->id,

                //     ]);
                
                // }
                $item_id = ProductItem::all();
                // dd($item_id);

                // dd($productitem->id);
                $testArray2 = [];
            foreach ($product_item['product_item_size'] as $item_key => $itemname) {
                // dd($itemname['id']);
                $testArray2 = [
                    'itemname' => $itemname['itemname'],
                    'itemquantity'=>$itemname['itemquantity'],
                    'product_item_id' =>$productitem->id
                ];
                //dd($testArray2);
                ProductItemSize::updateOrCreate(['id'=>$itemname['id']],$testArray2);
            }
            // dd($product_item['image']);
            if($product_item['media']){
                    // dd($product_item_ids[$key]);
                //delete image first 
                $product_media = ProductMedia::where('product_item_id',$product_item_ids[$key])->get();
                foreach ($product_media as $productmedia) {
                    // dd($productmedia->name);
                    # code...
                unlink(public_path('images/product_media/'.$productmedia->name)); 
                }

                foreach ($product_item['media'] as $key=> $img) {
                    # code...
                    // dd($img);
                    $base64Image = file_get_contents($img['image']);
                    // dd($base64Image);
                    $fileName = mt_rand(3, 9) .time(). '.png'; // You can generate a unique filename with the appropriate extension.
                    $folderPath = public_path('images/product_media'); 
                    if (!file_exists($folderPath)) {
                        mkdir($folderPath, 0755, true); // Create the folder if it doesn't exist.
                    }
                    $imagePath = $folderPath . '/' . $fileName;

                    // Save the image to the folder in the public directory.
                    file_put_contents($imagePath, $base64Image);
                    $product_media =  ProductMedia::updateOrCreate([
                        'name'=>$fileName,
                        'image'=>$fileName,
                        'path'=>$folderPath,
                        'ordering'=>$key+1,
                        'product_item_id'=>$productitem->id,

                    ]);
                
                }
            
            }

        }


            // if ($input['color']) {
            //     $item_colors = $input['color'];
            //     $item_prices = $input['price'];
            //     $item_final_prices = $input['final_price'];
            //     $item_is_availables = $input['is_available'];
            //     $item_tags = $input['tags'];

            //     $product_items = ProductItem::whereIn('id', $product_item_ids)->get();

            //     foreach ($product_items as $key => $product_item) {
            //         $product_item->color = $item_colors[$key];
            //         $product_item->price = $item_prices[$key];
            //         $product_item->final_price = $item_final_prices[$key];
            //         $product_item->is_available = $item_is_availables[$key];
            //         $product_item->tags = $item_tags[$key];
            //         $product_item->save();
            //     }
            // }

            // if ($request->hasFile('image')) {
            //     $productMedias = ProductMedia::whereIn('product_item_id', $product_item_ids)->get();

            //     $Productitleimages = $input['image'];
            //     $files = [];

            //     foreach ($Productitleimages as $key => $file) {
            //         $titleimage = mt_rand(3, 9) . time() . '.' . $file->extension();
            //         $files[] = $titleimage;
            //         $file->move(public_path('images/product_media'), $titleimage);
            //     }

            //     foreach ($productMedias as $key => $mediaupdate) {
            //         $mediaupdate->name = $files[$key];
            //         $mediaupdate->image = $files[$key];
            //         $mediaupdate->path = 'images/product_media';
            //         $mediaupdate->save();
            //     }
            // }

            // if ($input['itemname'] && $input['itemquantity']) {
            //     $item_names = $input['itemname'];
            //     $item_quantities = $input['itemquantity'];

            //     $product_item_sizes = ProductItemSize::whereIn('product_item_id', $product_item_ids)->get();

            //     foreach ($product_item_sizes as $key => $item_size) {
            //         $item_size->itemname = $item_names[$key];
            //         $item_size->itemquantity = $item_quantities[$key];
            //         $item_size->save();
            //     }
            // }

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

