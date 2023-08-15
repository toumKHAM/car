<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // --------- Admin --------- //
    public function adminHome(){
        return view("admin.home");
    }



    // --------- User --------- //
    public function userHome(){
        return view("user.home");
    }
}
