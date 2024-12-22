<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'cars';
//    protected $primaryKey = 'id';
    protected $fillable = ['make', 'model', 'seats', 'drivetrain', 'transmission', 'is_reserved'];

    /** @use HasFactory<\Database\Factories\CarFactory> */
    use HasFactory;
}