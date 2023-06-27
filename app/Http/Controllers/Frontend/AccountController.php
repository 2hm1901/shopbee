<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\country;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AccountController extends Controller
{
    public function ShowAccount(){
        $country = country::all();
        return view('frontend.accounts.account', compact('country'));
    }
    public function UpdateAccount(UpdateProfileRequest $request){

        $id = Auth::id();

        $infor = User::findOrFail($id);
        $data = $request->all();
        $file = $request->avatar;

        if(!empty($file)){
            $data['avatar'] = $file->getClientOriginalName();
        }

        if($data['password']){
            $data['password'] = bcrypt($data['password']);
        }
        else{
            $data['password'] = $infor->password;
        }

        if($infor->update($data)){
            if(!empty($file)){
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', __('Update profile success'));
        }
        else{
            return redirect()->back()->withErrors('Update profile error');
        }
        
    }
}
