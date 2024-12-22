<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';

    protected $fillable = [
        'user_id',
        'car_id',
        'pickup_location',
        'pickup_date',
        'pickup_time',
    ];
}
