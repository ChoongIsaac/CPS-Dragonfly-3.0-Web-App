<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Mission;
use App\Models\FlightDetail;
use Illuminate\Support\Facades\DB;


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
                // 'flight_path' => 'required|array',
                'detected_barcodes' => 'required|array',
                // Add any other required fields
            ]);

            // Retrieve data from the request
            $startTime = $request->input('start_time');
            $endTime = $request->input('end_time');
            // $flightPath = $request->input('flight_path');
            $detectedBarcodes = $request->input('detected_barcodes');

            // Save results to the database
            $flight = new Mission();
            $flight->start_time = $startTime;
            $flight->end_time = $endTime;
            // $flight->flight_path = json_encode($flightPath); // Assuming flight_path is a JSON field
            $flight->save();

            // Save scanned QR codes
            foreach ($detectedBarcodes as $barcode) {
                $scannedQRCode = new FLightDetail();
                $scannedQRCode->qr_code = $barcode;
                $scannedQRCode->detected_time = now(); // Assuming detected_time is a timestamp field
                $flight->flightDetail()->save($scannedQRCode);
            }

            // Return a success response
            return response()->json(['message' => 'Results saved successfully']);
        } catch (Exception $e) {
            // Handle exceptions or errors
            return response()->json(['error' => 'Failed to save results'], 500);
        }
    
    }

    public function flightReview()
    {
        $allMissions = Mission::all();

        if(Auth::check()){
            return view('flightreview',['missions'=>$allMissions]);
        }
  
        return redirect("login")->with('noaccess','Please login to access that page');

    }

    public function showMission($id)
    {
        // $missions = Mission::where('mission_id', $id)->first();

        $missions = Mission::with('flightDetail')
        ->where('mission_id', $id)
        ->first();
    //     $missions = DB::table('missions')
    // ->leftJoin('flight_details', 'missions.mission_id', '=', 'flight_details.mission_id')
    // ->select('missions.*', 'flight_details.detected_qr_code', 'flight_details.detected_time')
    // ->where('missions.mission_id', $id)->get();

        return view('viewmission', compact('missions'));
    }

}
