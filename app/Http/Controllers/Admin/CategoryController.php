<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ShowCategory(){
        $data = category::all();
        return view('admin.category.show-category', compact('data'));
    }
    public function ShowAddForm(){
        return view('admin.category.add-category');
    }
    public function AddCategory(Request $request){
        $new_category = new category();
        $new_category->name = $request->name_category;
        $new_category->save();
        return redirect()->back();
    }
    public function ShowEditForm($id){
        $data = category::where('id',$id)->get();
        return view('admin.category.edit-category', compact('data'));
    }
    public function EditCategory($id, request $request){
        category::where('id',$id)->update(
            ['name' => $request->name_category]
        );
        return redirect('category.html');
    }
    public function DeleteCategory($id){
        category::where('id',$id)->delete();
        return redirect()->back();
    }
}
