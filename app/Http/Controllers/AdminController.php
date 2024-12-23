<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Reservation;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::with(['user', 'car'])->get();

        return view('admin-dashboard', compact('reservations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = Reservation::with('car')->find($id);
        $reservation->delete();

        $car = Car::find($reservation->car_id);
        $car->update(['is_reserved' => 0]);

//        return response()->json([
//            'success' => true,
//            'message' => 'Reservation deleted.',
//        ]);

        return redirect()->route('admin-dashboard')->with('success', 'Reservation deleted.');
    }
}
