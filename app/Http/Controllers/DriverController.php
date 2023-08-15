<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DriverController extends Controller
{
    public function driver(){
        $drivers = User::where("role","D")->get();
        return view("admin.driver",compact('drivers'));
    }

    public function driverAdd(Request $request){
        $admin = [
            "name"  =>  $request->name,
            "phone" =>  $request->phone,
            "role"  =>  "D"
        ];
        try {
            User::create($admin);
            return back()->with("alert_icon","success")->with("alert_msg","ບັນທຶກຂໍ້ມູນສໍາເລັດ");
        } catch (\Throwable $th) {
            return back()->with("alert_icon","error")->with("alert_msg","ເກີດຂໍ້ຜິດພາດ");
        }
    }

    public function driverView($id){
        $driver = User::find($id);
        $html = View::make('component.driver.driver',compact('driver'))->render();
        return $html;
    }

    public function driverEdit(Request $request){
        $driver = User::find($request->id);
        $driver->name = $request->name;
        $driver->phone = $request->phone;
        $driver->save();
        return back()->with("alert_icon","success")->with("alert_msg","ແກ້ໄຂຂໍ້ມູນສໍາເລັດ");
    }

    public function driverDelete($id){
        $count = Booking::where('driver_id',$id)->count();
        if($count > 0){
            return [ "icon"=>"error", "msg"=>"ຂໍ້ມູນຖືກນໍາໃຊ້ແລ້ວ, ບໍ່ສາມາດລຶບໄດ້" ];
        }else{
            $driver = User::find($id);
            $driver->delete();
            return [ "icon"=>"success", "msg"=>"ການລຶບສໍາເລັດ" ];
        }
    }
}
