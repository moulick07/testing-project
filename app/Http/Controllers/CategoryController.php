<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\category\StoreCategoryRequest;
use App\Models\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::paginate(10);
        $response = [
            'type' => 'success',
            'code' => 200,
            'message' => "List",
            'data' => $category
        ];

        return response()->json($response,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        
        try {
        $input = $request->all();
        $category =  Category::create($input);
        $response = [
            'type' => 'success',
            'code' => 200,
            'message' => "Category store successfully",
            'data' => $category
        ];

        return response()->json($response,200);
        
    }
        catch (\Throwable $th) {
           
            $response = [
                'type' => 'error',
                'code' => 500,
                'message' =>  $th->getMessage()
            ];
            return response()->json($response, 500);
        }
        
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
        try {
            $input = $request->all();
            $category =  Category::update($input);
            $response = [
                'type' => 'success',
                'code' => 200,
                'message' => "Updated Succefully",
                'data' => $category
            ];
    
            return response()->json($response,200);
            
        }
            catch (\Throwable $th) {
               
                $response = [
                    'type' => 'error',
                    'code' => 500,
                    'message' =>  $th->getMessage()
                ];
                return response()->json($response, 500);
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
        $category->delete();
        $response =  [
            "type" => "success",
            "code"=> 200,
            "msg" => "Category deleted successfully"
        ];
        return response()->json($response,200);
    } catch (\Throwable $th) {
        $response = [
            'type' => 'error',
            'code' => 500,
            'message' =>  $th->getMessage()
        ];
        return response()->json($response, 500);
    }
    }
}
