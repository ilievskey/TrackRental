<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Car $car, $id)
    {
        $car = Car::findOrFail($id);
        $locations = ['GTC', 'Skopje Aerodrom', 'Vero'];
        return view('reserve', compact('car', 'locations'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $car = Car::findOrFail($id);
        $validated = $request->validate([
            'pickup_location' => 'required|string',
            'pickup_date' => 'required|date|after_or_equal:today',
            'pickup_time' => 'required|date_format:H:i',
        ]);

        Reservation::create([
            'user_id' => auth()->id(),
            'car_id' => $car->id,
            'pickup_location' => $validated['pickup_location'],
            'pickup_date' => $validated['pickup_date'],
            'pickup_time' => $validated['pickup_time'],
        ]);

        $car->update(['is_reserved' => 1]);

        return response()->json([
            'success' => true,
            'message' => 'Car reserved successfully!',
        ]);
    }
}
