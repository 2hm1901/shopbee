<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\brand;
use App\Models\category;

class HomeController extends Controller
{
    public function ShowLandingPage(){
        $brand = brand::all();
        $category = category::all();
        $data = product::orderBy('id', 'DESC')->get()->toArray();
        // session()->forget('cart');
        // session()->forget('totalQty.qty');
        return view('frontend.landing-page.landing-page', compact('data', 'brand', 'category'));
    }
    public function Search(Request $request){
        
        $q = product::query();
        if(!empty($request->search)){
            $search = $request->search;
            $q->where('name', 'like', '%'.$search.'%');
        }
        if (!empty($request->id_brand)) {
            $brand = $request->id_brand;
            $q->where('id_brand', $brand);
        }
        if (!empty($request->id_category)) {
            $category = $request->id_category;
            $q->where('id_category', $category);
        }
        if (!empty($request->status)) {
            $status = $request->status;
            $q->where('status', $status);
        }
        if(!empty($request->price)){
            $price = explode('-', $request->price);
            $q->whereBetween('price', [$price[0], $price[1]]);
        }
        $data = $q->get()->toArray();
        return view('frontend.search.search-result', compact('data'));
    }
    public function Range(){
        $value = $_POST['value'];
        $value = explode(' : ', $value);
        $range = product::whereBetween('price', [$value[0], $value[1]])->get();
        $data = ['success' => $range];
        return response()->json($data);

    }
}
