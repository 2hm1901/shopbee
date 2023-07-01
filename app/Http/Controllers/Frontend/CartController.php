<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;

class CartController extends Controller
{
    public function ShowCart(){
        return view('frontend.cart.show-cart');
    }
    public function BuyProduct(){
        $id = $_POST['id'];
        $img = $_POST['image'];
        // dd($totalQty);
        $product = product::where('id', $id)->get()->toArray();

        $item = [
                'product_id' => $product[0]['id'],
                'name' => $product[0]['name'],
                'image' => $img,
                'price' => $product[0]['price'],
                'quantity' => 1 // Số lượng mặc định là 1
            ];

        $isExsit = false;
        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        if(session()->has('cart')){
            $getSession = session()->get('cart');
            foreach($getSession as $key => $value){
                if ($value['product_id'] == $id) {
                    // Nếu đã tồn tại, thực hiện cập nhật số lượng
                    $getSession[$key]['quantity'] += 1;
                    $isExsit = true;
                    session()->put('cart', $getSession);
                }
            }
        }
        if (!$isExsit) {
            session()->push('cart', $item);
        }
        
        // tinhtongqty
        if(session()->has('cart')){
            $totalQty = 0;
            $getSession = session()->get('cart');
            foreach($getSession as $key => $value){
                $totalQty += $value['quantity'];
            }
            $data = ['success' => $totalQty];
            session()->put('totalQty.qty', $totalQty);
        }

        return response()->json($data);
    }
    public function IncreaseProduct(){
        $id = $_POST['id'];
        $getSession = session()->get('cart');
        foreach($getSession as $key => $value){
            if ($value['product_id'] == $id) {
                $getSession[$key]['quantity'] += 1;
            }
            session()->put('cart', $getSession);
        }
        if(session()->has('cart')){
            $totalQty = 0;
            $getSession = session()->get('cart');
            foreach($getSession as $key => $value){
                $totalQty += $value['quantity'];
            }
            $data = ['success' => $totalQty];
            session()->put('totalQty.qty', $totalQty);
        }
        return response()->json($data);
    }
    
    public function DecreaseProduct(){
        $id = $_POST['id'];
        $getSession = session()->get('cart');
        foreach($getSession as $key => $value){
            if ($value['product_id'] == $id) {
                $currentQty = $getSession[$key]['quantity'];
                if ($currentQty <= 1) {
                    unset($getSession[$key]);
                }
                else{
                $getSession[$key]['quantity'] -= 1;
                }
            }
            session()->put('cart', $getSession);
        }
        if(session()->has('cart')){
            $totalQty = 0;
            $getSession = session()->get('cart');
            foreach($getSession as $key => $value){
                $totalQty += $value['quantity'];
            }
            $data = ['success' => $totalQty];
            session()->put('totalQty.qty', $totalQty);
        }
        return response()->json($data);
    }
    public function DeleteProduct(){
        $id = $_POST['id'];
        $getSession = session()->get('cart');
        foreach($getSession as $key => $value){
            if ($value['product_id'] == $id) {
                unset($getSession[$key]);
            }
            session()->put('cart', $getSession);
        }
        if(session()->has('cart')){
            $totalQty = 0;
            $getSession = session()->get('cart');
            foreach($getSession as $key => $value){
                $totalQty += $value['quantity'];
            }
            $data = ['success' => $totalQty];
            session()->put('totalQty.qty', $totalQty);
        }
        return response()->json($data);
    }
}
