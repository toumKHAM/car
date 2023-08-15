<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // --------- Admin --------- //
    public function adminBooking(){
        $bookings = Booking::whereIn("status",['W','C'])->orderBy("id")->get();
        return view("admin.booking",compact('bookings'));
    }

    public function adminView($id,$action){
        $drivers = User::where("role","D")->get();
        // $cars = Car::leftJoin('bookings as b','b.car_id','cars.id')->select('cars.id','cars.car_no','b.status')->where('b.from_date','>',date("Y-m-d H:i:s"))->where('b.status','A')->get();
        $cars = DB::select("SELECT C.id, C.car_no, B.`status` FROM cars AS C LEFT JOIN bookings AS B ON C.id=B.car_id AND B.to_date > NOW() AND B.`status`='A'");
        if($action == "A"){
            $html = View::make('component.booking.approve',compact('id','drivers','cars'))->render();
        }elseif($action == "U"){
            $html = View::make('component.booking.unauthor',compact('id'))->render();
        }
        return $html;
    }

    public function adminApprove(Request $request){
        $booking = Booking::find($request->id);
        if($request->approve == "A"){
            $booking->driver_id = $request->driver_id;
            $booking->car_id = $request->car_id;
            $booking->status = "A";
        }elseif($request->approve == "U"){
            $booking->status = "U";
            $booking->because = $request->because;
        }
        $booking->approve_date = date("Y-m-d H:i:s",time());
        $booking->save();
        return back()->with("alert_icon","success")->with("alert_msg","ບັນທຶກການອະນຸມັດສໍາເລັດ");

    }

    public function adminAccept($id){
        $booking = Booking::find($id);
        $booking->delete();
        return [ "icon"=>"success", "msg"=>"ການຍົກເລີກສໍາເລັດ" ];
    }



    // --------- User --------- //
    public function userBooking(){
        return view("user.booking");
    }

    public function addBooking(Request $request){
        $res = date_create_from_format("d/m/Y  H:i", $request->from_date);
        $from_date = date_format($res, "Y-m-d H:i:s");

        $res = date_create_from_format("d/m/Y  H:i", $request->to_date);
        $to_date = date_format($res, "Y-m-d H:i:s");

        $booking = [
            "request_date"  => date("Y-m-d H:i:s",time()),
            "content"       => $request->content,
            "people"        => intval($request->people),
            "src"           => $request->src,
            "des"           => $request->des,
            "user_id"       => Auth::id(),
            "from_date"     => $from_date,
            "to_date"       => $to_date,
            "status"        => "W",
        ];

        try {
            Booking::create($booking);
            return back()->with("alert_icon","success")->with("alert_msg","ຈອງລົດສໍາເລັດ");
        } catch (\Throwable $th) {
            return back()->with("alert_icon","error")->with("alert_msg","ເກີດຂໍ້ຜິດພາດ");
        }
    }
}
