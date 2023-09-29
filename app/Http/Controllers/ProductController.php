<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\VariationTable;
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
            // dd($request->all());
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
                // for($i=0;$i<=count($files);$i++){

                    $file->move(public_path('images/ProductImage'), end($files));
                // }
            } 
            $coverImageName = time().'.'.$request->cover_image->extension();
            
            $request->cover_image->move(public_path('images/CoverImage'), $coverImageName);
          

        Product::create([
            'name'=>$request->input('title'),
            'short_description'=>$request->input('short_description'),
            'long_description'=>$request->input('long_description'),
            'in_stock'=>$request->input('instock'),
            'price'=>$request->input('price'),
            'discounted_price'=>$request->input('discount_price'),
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
        $detailproduct = Product::where('id',$id)->first();
        
        return view('productdetail',compact('detailproduct'));

    }


    public function subCategory(Request $request){
        // dd($request);
        $data['sub_category'] = Category::where('parent_category',$request->country_id)->get(['title','id']);
        return response()->json($data);
    }

    public function Variant(Request $request){
      
        $data['variant'] = VariationTable::where('category_id',$request->parent_id)->get(['title','id']);
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

    public function editProduct(Request $request ){
        $parentCategory = Category::where('parent_category',0)->get();
        // dd($variantall);
        
        for ($i=0; $i <count($parentCategory) ; $i++) { 
            $subCategory = Category::where('parent_category',$parentCategory[$i]->id)->get();
            $variantall = VariationTable::where('category_id',$parentCategory[$i]->id)->get();

        }
     
        $product= Product::where('id',$request->id)->first();
        $variantid=explode(',',$product->variant);     
        // $variantid=explode(',',$product->value);     
        $variant = VariationTable::wherein('id',$variantid)->get();
        $value = VariationTable::wherein('id',$variantid)->get();

            
       
    return view('editProduct')->with('parentCategory',$parentCategory)->with('product',$product)->with('subCategory',$subCategory)->with('variant',$variant)->with('value',$value);

    }

    public function updateProduct(Request $request,$id){
        $categories= Product::all();
            // dd($request->all());
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
                // for($i=0;$i<=count($files);$i++){

                    $file->move(public_path('images/ProductImage'), end($files));
                // }
            } 
            $coverImageName = time().'.'.$request->cover_image->extension();
            
            $request->cover_image->move(public_path('images/CoverImage'), $coverImageName);
          

        Product::where('id',$id)->update([
            'name'=>$request->input('title'),
            'short_description'=>$request->input('short_description'),
            'long_description'=>$request->input('long_description'),
            'in_stock'=>$request->input('instock'),
            'price'=>$request->input('price'),
            'discounted_price'=>$request->input('discount_price'),
            'brand'=>$request->input('merchant'),
            'variant'=>implode(',',$request->input('Variant')),
            'value'=>implode(',',$request->input('value')),
            'parent_product'=>$request->input('parent_product'),
            'main_category'=>$request->input('category'),
            'is_active'=>1,
            'cover_image'=>$coverImageName,
            'images'=>implode(',',$files),

        ]);
            return redirect('product-list')->with(['success' => true, 'message' => 'successfully Product updated'], 200);
        }   
      
                  

        
    }


    public function deleteProduct(Request $request,$id){

        ## Read POST data
        $categories= Product::all();

        

        $empdata = Product::find($id);

        if($empdata->delete()){
            $response['success'] = 1;
            $response['msg'] = 'Delete successfully'; 
        }else{
            $response['success'] = 0;
            $response['msg'] = 'Invalid ID.';
        }

        return redirect('product-list')->with(['success' => true, 'message' => 'successfully Product delete'], 200)->with('categories',$categories);
    }
}
