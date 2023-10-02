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
       return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
    
        $input = $request->all();
        $category =  Category::create($input);
    
        return [
            "status" => 1,
            "msg" => "category added successfully",
            "data" =>$category
        ];
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return [
            "status" => 1,
            "data" =>$category
        ];

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
           $category->update($request->all());

        return [
            "status" => 1,
            "data" => $category,
            "msg" => "Category updated successfully"
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return [
            "status" => 1,
            "data" => $category,
            "msg" => "Category deleted successfully"
        ];
    }
}
