<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    // --------- Admin --------- //
    public function adminHistory(){
        $approves = Booking::whereIn('status',['A','U'])->orderBy('approve_date','desc')->get();
        return view("admin.history",compact('approves'));
    }

    public function adminView($id){
        $booking = Booking::find($id);
        $sts = $booking->status;
        if($sts == "A"){
            $html = View::make('component.history.admin.approve',compact('booking'))->render();
        }elseif($sts == "U"){
            $html = View::make('component.history.admin.unauthor',compact('booking'))->render();
        }else{
            $html = "Error";
        }
        return $html;
    }

    public function adminViewEdit($id){
        $appr = Booking::find($id);
        $drivers = User::where("role","D")->get();
        // $cars = Car::leftJoin('bookings as b','b.car_id','cars.id')->select('cars.id','cars.car_no','b.status')->where('b.from_date','>',date("Y-m-d H:i:s"))->where('b.status','A')->get();
        $cars = DB::select("SELECT C.id, C.car_no, B.`status` FROM cars AS C LEFT JOIN bookings AS B ON C.id=B.car_id AND B.from_date > NOW() AND B.`status`='A'");
        $html = View::make('component.history.admin.edit',compact('appr','drivers','cars'))->render();
        return $html;
    }

    public function adminSaveEdit(Request $request){
        $appr = Booking::find($request->id);
        $appr->driver_id = $request->driver_id;
        $appr->car_id = $request->car_id;
        $appr->save();
        return back()->with("alert_icon","success")->with("alert_msg","ແກ້ໄຂຂໍ້ມູນສໍາເລັດ");
    }


    // --------- User --------- //
    public function userHistory(){
        $bookings = Booking::where("user_id",Auth::id())->orderBy('id','desc')->get();
        return view("user.history",compact('bookings'));
    }

    public function userView($id){
        $booking = Booking::find($id);
        $admin = User::where("role","A")->first();
        $sts = $booking->status;
        if($sts == "W"){
            $html = View::make('component.history.user.waiting',compact('booking','admin'))->render();
        }elseif($sts == "A" || $sts == "C"){
            $html = View::make('component.history.user.approve',compact('booking','admin'))->render();
        }elseif($sts == "U"){
            $html = View::make('component.history.user.unauthor',compact('booking','admin'))->render();
        }else{
            $html = "Error";
        }
        return $html;
        
    }

    public function userCancel($id){
        $booking = Booking::find($id);
        if( date("Y-m-d H:i:s",time()) < $booking->from_date ){
            $booking->status = "C";
            $booking->save();
            return [ "icon"=>"success", "msg"=>"ຍົກເລີກສໍາເລັດ" ];
        }else{
            return [ "icon"=>"error", "msg"=>"ບໍ່ສາມາດຍົກເລີກໄດ້" ];
        }
    }

    public function userDelete($id){
        $booking = Booking::find($id);
        if( $booking->status == "W" ){
            $booking->delete();
            return [ "icon"=>"success", "msg"=>"ການລຶບສໍາເລັດ" ];
        }else{
            return [ "icon"=>"error", "msg"=>"ສະຖານະມິການປ່ຽນແປງ, ບໍ່ສາມາດລຶບໄດ້" ];
        }
    }
}
