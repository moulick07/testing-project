<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        return view('category');
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
            'parent_category'=>$request->input('is_parent'),
        ]);
        return back()->with('success','successfull category created ');
    }
}
