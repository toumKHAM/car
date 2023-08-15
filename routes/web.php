<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\BookerController;
use App\Http\Controllers\WorkplansController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { return view('login'); });
Route::post("checklogin",[LoginController::class,"checkLogin"]);
Route::get('logout', [LoginController::class,"logout"])->name('login');
Route::post("changepwd",[LoginController::class,"changepwd"]);



Route::middleware(['auth'])->group(function (){
    // ---------- Admin Route ---------- // 
    Route::get("admin/home",[HomeController::class,"adminHome"]);

    Route::get("admin/booking",[BookingController::class,"adminBooking"]);
    Route::get("admin/view/{id}/{action}",[BookingController::class,"adminView"]);
    Route::post("admin/booking/approve",[BookingController::class,"adminApprove"]);
    Route::get("admin/booking/accept/{id}",[BookingController::class,"adminAccept"]);

    Route::get("admin/car",[CarController::class,"car"]);
    Route::post("admin/car/add",[CarController::class,"carAdd"]);
    Route::get("admin/car/view/{id}",[CarController::class,"carView"]);
    Route::post("admin/car/edit",[CarController::class,"carEdit"]);
    Route::get("admin/car/delete/{id}",[CarController::class,"carDelete"]);

    Route::get("admin/driver",[DriverController::class,"driver"]);
    Route::post("admin/driver/add",[DriverController::class,"driverAdd"]);
    Route::get("admin/driver/view/{id}",[DriverController::class,"driverView"]);
    Route::post("admin/driver/edit",[DriverController::class,"driverEdit"]);
    Route::get("admin/driver/delete/{id}",[DriverController::class,"driverDelete"]);

    Route::get("admin/booker",[BookerController::class,"booker"]);
    Route::post("admin/booker/add",[BookerController::class,"bookerAdd"]);
    Route::get("admin/booker/view/{id}",[BookerController::class,"bookerView"]);
    Route::post("admin/booker/edit",[BookerController::class,"bookerEdit"]);
    Route::get("admin/booker/delete/{id}",[BookerController::class,"bookerDelete"]);

    Route::get("admin/workplans",[WorkplansController::class,"workplans"]);

    Route::get("admin/history",[HistoryController::class,"adminHistory"]);
    Route::get("admin/history/view/{id}",[HistoryController::class,"adminView"]);
    Route::get("admin/history/viewedit/{id}",[HistoryController::class,"adminViewEdit"]);
    Route::post("admin/history/saveedit",[HistoryController::class,"adminSaveEdit"]);

    Route::get("admin/report",[ReportController::class,"report"]);


    // ---------- User Route ---------- // 
    Route::get("user/home",[HomeController::class,"userHome"]);

    Route::get("user/booking",[BookingController::class,"userBooking"]);
    Route::post("user/addBooking",[BookingController::class,"addBooking"]);

    Route::get("user/history",[HistoryController::class,"userHistory"]);
    Route::get("user/view/{id}",[HistoryController::class,"userView"]);
    Route::get("user/cancel/{id}",[HistoryController::class,"userCancel"]);
    Route::get("user/delete/{id}",[HistoryController::class,"userDelete"]);

});

// test function
Route::get("add/admin",[BookerController::class,"addAdmin"]);
