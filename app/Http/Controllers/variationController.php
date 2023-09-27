<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VariationTable;
class variationController extends Controller
{
    public function variationSave(Request $request , $id){
        $input = $request->all();
       $validator =  $request->validate([
            'title' => 'required',
            'type'=>'required',
            'prefix' => 'required',
            'postfix' => 'required',
            'countable' => 'required',
            'value' => 'required',
        ]);
       
       

           VariationTable::create([
               'title'=>$request->input('title'),
               'type'=>$request->input('type'),
               'prefix'=>$request->input('prefix'),
               'postfix'=>$request->input('postfix'),
               'countable'=>$request->input('countable'),
               'value'=>$request->input('value'),
               'category_id'=>$id,
           ]);
           return back();
    
    }
}
