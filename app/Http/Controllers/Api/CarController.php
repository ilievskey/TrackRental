<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Models\Reservation;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Car::query();
        if($request->has('make')){
            $query->where('make', $request->input('make'));
        }
        if($request->has('seats')){
            $query->where('seats', $request->input('seats'));
        }
        if($request->has('drivetrain')){
            $drivetrain = $request->input('drivetrain');
            $query->whereIn('drivetrain', is_array($drivetrain) ? $drivetrain : [$drivetrain]);
        }
        if($request->has('transmission')){
            $transmission = $request->input('transmission');
            $query->whereIn('transmission', is_array($transmission) ? $transmission : [$transmission]);
        }

        return $query->get();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $car = Car::findOrFail($id);
        return view('details', compact('car'));
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
