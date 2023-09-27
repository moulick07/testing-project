<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    //
    public function index(){
        $parentCategory = Category::where('is_parent',1)->get();
        
        return view('addProduct')->with('parentCategory',$parentCategory);
    }
    public function saveProduct(Request $request){
        $input = $request->all();
        // dd($input);
        $categories= Product::all();
        
       $validator =  $request->validate([
            'title' => 'required',
            'short_description' => 'required|max:255',
            'long_description' => 'required',
            'instock' => 'required',
            'price'=> 'required',
            'discount_price'=> 'required',
            'merchant'=> 'required',
            'category'=> 'required',
            'product_image' => 'required|mimes:png,jpg,jpeg,webp|max:2048',
            'cover_image' => 'required|mimes:png,jpg,jpeg,webp|max:2048',
            'value' => 'required',
        ]);
        
       
        if ($validator->fails()) {
             return $validator->errors(); 
        }
        else{
            $productImageName = time().'.'.$request->product_image->extension();  
        $coverImageName = time().'.'.$request->cover_image->extension();
        
        $request->product_image->move(public_path('images'), $productImageName);
        $request->cover_image->move(public_path('images'), $coverImageName);
       $product =  Product::create([
            'name'=>$request->input('title'),
            'short-description'=>$request->input('short_description'),
            'long-description'=>$request->input('long_description'),
            'in-stock'=>$request->input('instock'),
            'price'=>$request->input('price'),
            'discounted-price'=>$request->input('discount_price'),
            'brand'=>$request->input('merchant'),
            'variant'=>implode(',',$request->input('Variant')),
            'value'=>implode(',',$request->input('value')),
            'parent_product'=>$request->input('category'),
            'main-category'=>1,
            'is_active'=>1,
            'cover-image'=>$coverImageName,
            'images'=>$productImageName,

        ]);
            return redirect('addproduct')->with(['success' => true, 'message' => 'successfully Product created'], 200);
        }   
      
            

        
    }
}
