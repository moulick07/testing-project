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
    public function variation(Request $request){
        $categories= Category::all();

        if ($request->ajax()) {
            // dd($request);
            $data = Category::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('variations')->with('categories',$categories);
     
    }

    public function editVariation(Request $request)
    {
     
        $Categories = Category::findOrFail($request->id);
        return response()->json($Categories);
    }

     public function update(Request $request)
    {
        dd($request);
        //validation
        }
}
