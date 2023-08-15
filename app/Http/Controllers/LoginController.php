<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function checkLogin(Request $request){
        $username = $request->username;
        $password   = $request->password;
        $user = User::where('username',$username)->where('role','!=','N')->first();
        if(empty($user)){
            return back()->withInput()->with('username_error',"ຊື່ຜູ້ໃຊ້ນີ້ບໍ່ມີໃນລະບົບ");
        }

        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            $request->session()->regenerate();
            $user = Auth::user();
            Auth::login($user);
            if($user->role == "A"){
                return redirect()->intended('admin/home');
            }elseif($user->role == "U"){
                return redirect()->intended('user/home');
            }
            
        }else{
            return back()->withInput()->with('password_error',"ລະຫັດຜ່ານບໍ່ຖືກຕ້ອງ");
        }
    }

    public function logout(){
        $user = Auth::user();
        Auth::logout($user);
        return redirect('/');
    }

    public function changepwd(Request $request){
        try {
            $id = Auth::id();
            $user = User::find($id);
            $user->password = Hash::make($request->confirmnewpass);
            $user->save();
            return back()->with("changepwd_icon","success")->with("changepwd_msg","ປ່ຽນລະຫັດຜ່ານສໍາເລັດ");
        } catch (\Throwable $th) {
            return back()->with("changepwd_icon","error")->with("changepwd_msg","ເກີດຂໍ້ຜິດພາດ");
        }
    }
}
