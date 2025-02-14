<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function adminMessage()
    {
        $message = \DB::table('admin_message')->get();
        return view('admin-message', compact('message'));
    }

    public function storeMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        \DB::table('admin_message')->truncate();
        \DB::table('admin_message')->insert([
            'content' => $request->message,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Message set!');
    }

    public function destroyMessage(string $id)
    {
        try{
            $deleted = \DB::table('admin_message')->where('id', $id)->delete();

            if($deleted){
                return response()->json([
                    'success' => true,
                    'message' => 'Message removed.',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Message not found.',
                ], 404);
            }
        } catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
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

    public function storeCar(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'make' => 'required|string|max:255',
                'model' => 'required|string|max:255',
                'seats' => 'required|integer|min:1',
                'drivetrain' => 'required|in:fwd,rwd,awd',
                'transmission' => 'required|in:manual,auto',
            ]);

            $car = Car::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Car added successfully!',
                'car' => $car,
            ]);
        } catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function showCarForUpdate(string $id)
    {
        try {
            $car = Car::findOrFail($id);
            return response()->json($car);

        } catch (\Exception $e){
            return response()->json(['message' => $e->getMessage(), 500]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function updateCar(Request $request, string $id)
    {
        try{
            $validatedData = $request->validate([
                'make' => 'required|string|max:255',
                'model' => 'required|string|max:255',
                'seats' => 'required|integer|min:1',
                'drivetrain' => 'required|in:fwd,rwd,awd',
                'transmission' => 'required|in:manual,auto'
            ]);

            $car = Car::findOrFail($id);
            $car->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Car updated successfully!',
                'car' => $car
            ]);

        } catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
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

