<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VariationTable;
use App\Models\Category;
use App\Http\Requests\StoreVariationRequest;
class variationController extends Controller
{
    public function variationSave(StoreVariationRequest $request ,$id){
        $input = $request->all();
        $input['category_id'] = $id;

        $category = Category::find($id)->first();
      
           VariationTable::create($input);
           return back();
    
    }
}
