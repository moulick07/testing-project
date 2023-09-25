<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Datatables;
class CategoryController extends Controller
{
    public function index(){
        $categories= Category::all();
        return view('category')->with('categories',$categories);
    }
    public function save(Request $request){
        $input = $request->all();
        $request->validate([
            'title' => 'required',
            'Description' => 'required|max:255',
            'is_parent' => 'required',
            'parent-cat' => 'required',
        ]);
        Category::create([
            'title'=>$request->input('title'),
            'description'=>$request->input('Description'),
            'is_parent'=>$request->input('is_parent'),
            'parent_category'=>$request->input('parent-cat'),
        ]);
        return back()->with('success','successfull category created ');
    }
    public function data(Request $request){
        $categories= Category::all();

        if ($request->ajax()) {
            // dd($request);
            $data = Category::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    
                    // Update Button
                    $updateButton = "<a href=detailCategory/".$row->id."> <button class='btn btn-sm btn-info updateUser' ><i class='fa fa-eye'></i></button></a>";
   
                    // Delete Button
                    // $deleteButton = "<button class='btn btn-sm btn-danger deleteUser' data-id='".$row->id."'><i class='fa-solid fa-trash'></i></button>";
   
                    return $updateButton;
   
               }) 
               ->make(true);
                
        }

        return view('variations')->with('categories',$categories);
     
    }

  
     // Read Employee record by ID
     public function getCategoryData(Request $request){

        ## Read POST data 
        $id = $request->post('id');

        $empdata = Category::find($id);

        $response = array();
        if(!empty($empdata)){

            $response['title'] = $empdata->title;
            $response['description'] = $empdata->description;
            $response['is_parent'] = $empdata->is_parent;
            $response['parent_category'] = $empdata->parent_category;

            $response['success'] = 1;
        }else{
            $response['success'] = 0;
        }

        return response()->json($response);

    }
    public function detailCategoryData($id){
        $detailcategory = Category::where('id',$id)->get();
        // dd($cat);
        ## Read POST 
        return view('categorydetail',compact('detailcategory'));

    }

    // Update Category record
    public function updateCategory(Request $request){
        ## Read POST data
        $id = $request->post('id');

        $empdata = Category::find($id);

        $response = array();
        if(!empty($empdata)){
             $updata['title'] = $request->post('title');
             $updata['description'] = $request->post('description');
             $updata['is_parent'] = $request->post('is_parent');
             $updata['parent_category'] = $request->post('parent_category');

             if($empdata->update($updata)){
                  $response['success'] = 1;
                  $response['msg'] = 'Update successfully'; 
             }else{
                  $response['success'] = 0;
                  $response['msg'] = 'Record not updated';
             }

        }else{
             $response['success'] = 0;
             $response['msg'] = 'Invalid ID.';
        }

        return response()->json($response); 
    }

    // Delete Employee
    public function deleteCategory(Request $request){

        ## Read POST data
        $id = $request->post('id');

        $empdata = Category::find($id);

        if($empdata->delete()){
            $response['success'] = 1;
            $response['msg'] = 'Delete successfully'; 
        }else{
            $response['success'] = 0;
            $response['msg'] = 'Invalid ID.';
        }

        return response()->json($response); 
    }

    public function addVariation(){

        return  view('addvariation');
    }
}