<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Car;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $primaryKey = 'id';
    public $timestamps=false;
    protected $fillable = [
        'request_date', 'content', 'people', 'password', 'src', 'des',
        'from_date', 'to_date', 'user_id', 'approve_date', 'status',
        'because', 'driver_id', 'car_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function driver()
    {
        return $this->hasOne(User::class, 'id', 'driver_id');
    }

    public function car()
    {
        return $this->hasOne(Car::class, 'id', 'car_id');
    }
}
