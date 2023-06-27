<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;

class HomeController extends Controller
{
    public function ShowLandingPage(){
        $data = product::orderBy('id', 'DESC')->get()->toArray();
        // session()->forget('cart');
        // session()->forget('totalQty.qty');
        return view('frontend.landing-page.landing-page', compact('data'));
    }
}
