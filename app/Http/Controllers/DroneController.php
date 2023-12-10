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
            return view('dronecontrol');
        }
  
        return redirect("login")->with('noaccess','Please login to access that page');

    }

    public function saveResults(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'start_time' => 'required|date',
                'end_time' => 'required|date',
                'flight_path' => 'required|array',
                'detected_barcodes' => 'required|array',
                // Add any other required fields
            ]);

            // Retrieve data from the request
            $startTime = $request->input('start_time');
            $endTime = $request->input('end_time');
            $flightPath = $request->input('flight_path');
            $detectedBarcodes = $request->input('detected_barcodes');

            // Save results to the database
            $flight = new Flight();
            $flight->start_time = $startTime;
            $flight->end_time = $endTime;
            $flight->flight_path = json_encode($flightPath); // Assuming flight_path is a JSON field
            $flight->save();

            // Save scanned QR codes
            foreach ($detectedBarcodes as $barcode) {
                $scannedQRCode = new ScannedQRCode();
                $scannedQRCode->qr_code = $barcode;
                $scannedQRCode->detected_time = now(); // Assuming detected_time is a timestamp field
                $flight->scannedQRCodes()->save($scannedQRCode);
            }

            // Return a success response
            return response()->json(['message' => 'Results saved successfully']);
        } catch (\Exception $e) {
            // Handle exceptions or errors
            return response()->json(['error' => 'Failed to save results'], 500);
        }
    
    }

    public function flightReview()
    {
        $missions = Mission::all();

        return view('missions.index', compact('missions'));
    }

    public function showMission($id)
    {
        $mission = Mission::findOrFail($id);

        return view('missions.show', compact('mission'));
    }

}
