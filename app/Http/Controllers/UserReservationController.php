<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserReservationController extends Controller
{
    public function index()
    {
        $reservations = auth()->user()->reservations;
        return view('dashboard', compact('reservations'));
    }
}
