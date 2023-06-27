<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\brand;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ShowBrand(){
        $data = brand::all();
        return view('admin.brand.show-brand', compact('data'));
    }
    public function ShowAddForm(){
        return view('admin.brand.add-brand');
    }
    public function AddBrand(Request $request){
        $new_brand = new brand();
        $new_brand->name = $request->name_brand;
        $new_brand->save();
        return redirect()->back();
    }
    public function ShowEditForm($id){
        $data = brand::where('id',$id)->get();
        return view('admin.brand.edit-brand', compact('data'));
    }
    public function EditBrand($id, request $request){
        brand::where('id',$id)->update(
            ['name' => $request->name_brand]
        );
        return redirect()->back();
    }
    public function DeleteBrand($id){
        brand::where('id',$id)->delete();
        return redirect()->back();
    }
}
