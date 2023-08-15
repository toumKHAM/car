<?php

namespace App\Http\Controllers;

use App\Models\Dept;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class BookerController extends Controller
{
    public function booker(){
        $users = User::where("role","U")->get();
        $depts = Dept::get();
        return view("admin.booker",compact('users','depts'));
    }

    public function bookerAdd(Request $request){
        $booker = [
            "name"      =>  $request->name,
            "phone"     =>  $request->phone,
            "dept_id"   =>  $request->dept_id,
            "username"  =>  $request->username,
            "password"  =>  Hash::make($request->password),
            "role"      =>  "U"
        ];

        try {
            User::create($booker);
            return back()->with("alert_icon","success")->with("alert_msg","ບັນທຶກຂໍ້ມູນສໍາເລັດ");
        } catch (\Throwable $th) {
            return back()->with("alert_icon","error")->with("alert_msg","ເກີດຂໍ້ຜິດພາດ");
        }
    }

    public function bookerView($id){
        $booker = User::find($id);
        $depts = Dept::get();
        $html = View::make('component.booker.booker',compact('booker','depts'))->render();
        return $html;
    }

    public function bookerEdit(Request $request){
        $booker = User::find($request->id);
        if($request->password != null){
            $booker->password = Hash::make($request->password);
        }
        $booker->dept_id = $request->dept_id;
        $booker->name = $request->name;
        $booker->phone = $request->phone;
        $booker->username = $request->username;
        $booker->save();
        return back()->with("alert_icon","success")->with("alert_msg","ແກ້ໄຂຂໍ້ມູນສໍາເລັດ");
    }



    public function bookerDelete($id){
        $count = Booking::where('user_id',$id)->count();
        if($count > 0){
            return [ "icon"=>"error", "msg"=>"ຂໍ້ມູນຖືກນໍາໃຊ້ແລ້ວ, ບໍ່ສາມາດລຶບໄດ້" ];
        }else{
            $booker = User::find($id);
            $booker->delete();
            return [ "icon"=>"success", "msg"=>"ການລຶບສໍາເລັດ" ];
        }
    }


    // function for Developer
    public function addAdmin(){
        $admin = [
            "name"=>"user name",
            "phone"=>"020",
            "username"=>"user",
            "password"=>Hash::make("1234"),
            "role"  => "A"
        ];
        try {
            User::create($admin);
            echo "OK";
        } catch (\Throwable $th) {
            echo "error";
        }
    }
}
