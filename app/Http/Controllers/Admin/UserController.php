<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\Models\country;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ShowProfile(){
        return view('admin.admin.pages-profile');
    }
    public function ShowCountry(){
        $country = country::all();
        return view('admin.admin.pages-profile', compact('country'));
    }
    public function UpdateProfile(UpdateProfileRequest $request){

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
