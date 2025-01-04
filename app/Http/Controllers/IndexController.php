<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        $makes = $cars->pluck('make')->unique();
        $maxSeats = $cars->pluck('seats')->max();

        return view('index', compact('cars', 'makes', 'maxSeats'));
    }

    public function getMessage(){
        $message = \DB::table('admin_message')->latest()->first();
        return response()->json($message);
    }

}
