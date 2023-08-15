<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CarController extends Controller
{
    public function car(){
        $cars = Car::get();
        return view("admin.car",compact('cars'));
    }

    public function carAdd(Request $request){
        $car = [
            "car_no"    => $request->car_no,
            "car_type"    => $request->car_type,
            "car_color"    => $request->car_color,
        ];

        try {
            Car::create($car);
            return back()->with("alert_icon","success")->with("alert_msg","ບັນທຶກຂໍ້ມູນລົດສໍາເລັດ");
        } catch (\Throwable $th) {
            return back()->with("alert_icon","error")->with("alert_msg","ເກີດຂໍ້ຜິດພາດ");
        }
    }

    public function carView($id){
        $car = Car::find($id);
        $html = View::make('component.car.car',compact('car'))->render();
        return $html;
    }

    public function carEdit(Request $request){
        $car = Car::find($request->id);
        $car->car_no = $request->car_no;
        $car->car_color = $request->car_color;
        $car->car_type = $request->car_type;
        $car->save();
        return back()->with("alert_icon","success")->with("alert_msg","ແກ້ໄຂຂໍ້ມູນລົດສໍາເລັດ");
    }

    public function carDelete($id){
        $count = Booking::where('car_id',$id)->count();
        if($count > 0){
            return [ "icon"=>"error", "msg"=>"ຂໍ້ມູນຖືກນໍາໃຊ້ແລ້ວ, ບໍ່ສາມາດລຶບໄດ້" ];
        }else{
            $car = Car::find($id);
            $car->delete();
            return [ "icon"=>"success", "msg"=>"ການລຶບສໍາເລັດ" ];
        }
    }
}
