<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class WorkplansController extends Controller
{
    public function workplans(){
        $now = date("Y-m-d H:i:s",time());
        $approves = Booking::where("status","A")->where("to_date",">",$now)->orderBy("id")->get();
        return view("admin.workplans",compact('approves'));
    }
}
