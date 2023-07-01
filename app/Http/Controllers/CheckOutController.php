<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    public function index(){
        return view('frontend.check-out.check-out');
    }
}
