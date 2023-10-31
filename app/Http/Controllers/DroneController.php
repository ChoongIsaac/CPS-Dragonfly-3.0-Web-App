<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class DroneController extends Controller
{
    public function dronecontrol()
    {

        if(Auth::check()){
            //$items = Item::all()->whereIn('status', ['Available', 'Unresolved' , 'Lost']);
            return view('dronecontrol');
        }
  
        return redirect("login")->with('noaccess','Please login to access that page');

    }

}
