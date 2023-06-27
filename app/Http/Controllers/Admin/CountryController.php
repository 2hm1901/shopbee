<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\country;
class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ShowCountry(){
        $data = country::all();
        return view('admin.country.show-country', compact('data'));
    }
    public function ShowAddForm(){
        return view('admin.country.add-country');
    }
    public function AddCountry(Request $request){
        $new_country = new country();
        $new_country->name = $request->name_country;
        $new_country->save();
        return redirect()->back();
    }
    public function ShowEditForm($id){
        $data = country::where('id',$id)->get();
        return view('admin.country.edit-country', compact('data'));
    }
    public function EditCountry($id, request $request){
        country::where('id',$id)->update(
            ['name' => $request->name_country]
        );
        return redirect()->back();
    }
    public function DeleteCountry($id){
        country::where('id',$id)->delete();
        return redirect()->back();
    }
}
