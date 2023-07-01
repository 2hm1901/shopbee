<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\MailNotify;
use App\Models\history;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{
    public function index(){
        $data = [
            'subject' => 'Cambo Tutorial Mail',
            'body' => session()->get('cart')
        ];



        
        $getSession = session()->get('cart');
        $total_price = 0;
        foreach($getSession as $key => $value){
            $total_price += $value['price'] * $value['quantity'];
        }

        $order = new history();
        $order->email = Auth::user()->email;
        $order->phone = Auth::user()->phone;
        $order->name = Auth::user()->name;
        $order->id_user = Auth::user()->id;
        $order->price = $total_price;
        $order->save();

        try {
            Mail::to('2hm1901dev@gmail.com')->send(new MailNotify($data));
            return response()->json(['Great check your mail box!']);
        } catch (Exception $th) {
            return response()->json(['sorry']);
        }
    }
}
