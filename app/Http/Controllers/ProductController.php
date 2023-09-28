<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Datatables;



class ProductController extends Controller
{
    //
    public function index(){
        $parentCategory = Category::where('parent_category',0)->get();
        
        return view('addProduct')->with('parentCategory',$parentCategory);
    }

    public function saveProduct(Request $request){
        $categories= Product::all();
        
       $validator =  Validator::make($request->all(),[
            'title' => 'required',
            'short_description' => 'required|max:255',
            'long_description' => 'required',
            'instock' => 'required',
            'price'=> 'required',
            'discount_price'=> 'required',
            'merchant'=> 'required',
            'category'=> 'required',
            'product_image.*' => 'required|mimes:png,jpg,jpeg,webp|max:2048',
            'cover_image' => 'required|mimes:png,jpg,jpeg,webp|max:2048',
            'value' => 'required',
            'parent_product'=>'required',
        ]);
        
       
        if ($validator->fails()) {
             return redirect('/addproduct')->withErrors($validator); 
        }
        else{
            $files = [];
            foreach($request->file('product_image') as $key=>$file)
            {
                $name = time().'.'.$file->extension();
                $files[] = $name;  
                $file->move(public_path('images/ProductImage'), end($files));
            } 
            $coverImageName = time().'.'.$request->cover_image->extension();
            
            $request->cover_image->move(public_path('images/CoverImage'), $coverImageName);
          

        Product::create([
            'name'=>$request->input('title'),
            'short_description'=>$request->input('short_description'),
            'long_description'=>$request->input('long_description'),
            'in_stock'=>$request->input('instock'),
            'price'=>$request->input('price'),
            'discounted-price'=>$request->input('discount_price'),
            'brand'=>$request->input('merchant'),
            'variant'=>implode(',',$request->input('Variant')),
            'value'=>implode(',',$request->input('value')),
            'parent_product'=>$request->input('parent_product'),
            'main_category'=>$request->input('category'),
            'is_active'=>1,
            'cover_image'=>$coverImageName,
            'images'=>implode(',',$files),

        ]);
            return redirect('addproduct')->with(['success' => true, 'message' => 'successfully Product created'], 200);
        }   
      
                  

        
    }

    public function detailProductData($id){
        $detailproduct = Product::where('id',$id)->get();
        // dd($cat);
        ## Read POST 
        return view('productdetail',compact('detailproduct'));

    }


    public function subCategory(Request $request){
        // dd($request);
        $data['sub_category'] = Category::where('parent_category',$request->country_id)->get(['title','id']);
        return response()->json($data);
    }


    public function productView(Request $request){
        $categories= Product::all();

        if ($request->ajax()) {
            // dd($request);
            $data = Product::select('*');
            
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    // Update Button
                    $updateButton = "<a href=detailProduct/".$row->id."> <button class='btn btn-sm btn-info updateUser' ><i class='fa fa-eye'></i></button></a>";
   
                    // Delete Button
                    // $deleteButton = "<button class='btn btn-sm btn-danger deleteUser' data-id='".$row->id."'><i class='fa-solid fa-trash'></i></button>";
   
                    return $updateButton;
   
               }) 
               ->make(true);
                
        }

        return view('productlist')->with('categories',$categories);
    }
}
