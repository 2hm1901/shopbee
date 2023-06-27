<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RequestMemberLogin;
use App\Http\Requests\RequestMemberRegister;
use Illuminate\Support\Facades\Auth;

use App\Models\User;


class MemberController extends Controller
{
    public function ShowRegisterForm(){
        return view('frontend.member.register');
    }
    public function MemberRegister(RequestMemberRegister $request){
        $new_member = new User();
        $new_member->name = $request->name;
        $new_member->email = $request->email;
        $new_member->password = bcrypt($request->password);
        $new_member->level = 0;
        $new_member->save();
        return redirect('/login.html');
    }

    public function ShowLoginForm(){
        return view('frontend.member.login');
    }
    public function MemberLogin(RequestMemberLogin $request){
        $login = [
            'email'=>$request->email,
            'password'=>$request->password,
            'level'=>0
        ];

        $remember = false;

        if($request->remember_me){
            $remember = true;
        }
        if(Auth::attempt($login, $remember)){
            return redirect('/');
        } 
        else{
            return redirect()->back()->withErrors('Email or password is not correct!');
        }
    }

}
