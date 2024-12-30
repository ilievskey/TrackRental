<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
        //base is reservation
    {
        $reservations = Reservation::with(['user', 'car'])->get();

        return view('admin-dashboard', compact('reservations'));
    }

    public function indexCar()
    {
        $cars = Car::get();

        return view('admin-cars', compact('cars'));
    }

    public function indexUser()
    {
        $users = User::get();

        return view('admin-users', compact('users'));
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
        //base is reservation
    {
        try{
            $reservation = Reservation::with('car')->find($id);
            $reservation->delete();

            $car = Car::find($reservation->car_id);
            $car->update(['is_reserved' => 0]);

            return response()->json([
                'success' => true,
                'message' => 'Reservation deleted.',
            ]);
        } catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroyCar(string $id)
    {
        try{
            $car = Car::find($id);
            $car->delete();

            return response()->json([
                'success' => true,
                'message' => 'Car removed from database.',
            ]);
        } catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroyUser(string $id)
    {
        try{
            $user = User::find($id);
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User gone.',
            ]);
        } catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}

