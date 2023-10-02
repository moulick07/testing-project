<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
class CategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories= Category::all();
        return view()->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $input = $request->all();
        $categories= Category::all();

        
        Category::create($input);
    
        return redirect('')->with(['success' => true, 'message' => 'successfully Category created'], 200)->with('categories',$categories);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $detailCategory = Category::find($category);
      
        return view()->with('detailCategory',$detailCategory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $updatingcategory = Category::find($category->getKey());

        $response = array();
        if(!empty($updatingcategory)){
             $updata['title'] = $request->post('title');
             $updata['description'] = $request->post('description');
             $updata['is_parent'] = $request->post('is_parent');
             $updata['parent_category'] = $request->post('parent_category');

             if($updatingcategory->update($updata)){
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

        return back(); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        $delete_cat = Category::find($category);

        if($delete_cat->delete()){
            $response['success'] = 1;
            $response['msg'] = 'Delete successfully'; 
        }else{
            $response['success'] = 0;
            $response['msg'] = 'Invalid ID.';
        }

        return redirect()->with(['success' => true, 'message' => 'successfully Category delete'], 200);
    }
}
