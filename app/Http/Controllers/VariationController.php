<?php

namespace App\Http\Controllers;

use App\Http\Requests\updateVariationRequest;
use Illuminate\Http\Request;
use App\Models\VariationTable;  

use App\Http\Requests\variation\StoreVariationRequest;
class VariationController extends Controller
{
    public function index()
    {
        $variation = VariationTable::paginate(20);
        $response = [
            'type' => 'success',
            'code' => 200,
            'message' => "List",
            'data' => $variation
        ];

        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVariationRequest $request)
    {

        try {
            $input = $request->all();
            $variation = VariationTable::create($input);
            $response = [
                'type' => 'success',
                'code' => 200,
                'message' => "Product store successfully",
                'data' => $variation
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $detailproduct = VariationTable::where('id', $id)->first();

        return response()->json($detailproduct);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateVariationRequest $request, VariationTable $variation)
    {

      try{

      
        
        $variation->update($request->all());
        return [
            "status" => 200,
            
            "msg" => "Variation updated successfully"
        ];
    }catch (\Throwable $th) {

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
    public function destroy(VariationTable $variation)
    {


        $variation->delete();
        return [
            "status" => 1,
            "data" => $variation,
            "msg" => "Variation deleted successfully"
        ];
    }
}

