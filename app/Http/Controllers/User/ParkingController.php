<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parking;

class ParkingController extends Controller
{
    public function index()
    {
        // $parkings = Parking::select('id', 'name', 'situation')->get();

        // return view('user.parking.index',
        // compact('parkings'));

        return view('user.parking.index');
    }
}
