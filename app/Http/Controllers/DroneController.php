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
        $droneStartTime = "2023-01-01 10:00:00"; // Replace this with your actual variable


        if(Auth::check()){
            return view('dronecontrol',compact('droneStartTime'));
        }
  
        return redirect("login")->with('noaccess','Please login to access that page');

    }

    public function saveResults(Request $request)
{
    try {
        $requestData = $request->json()->all();

        // Validate the request data
        // Add validation rules as needed
        // $validator = Validator::make($requestData, [
        //     'mission.mission_id' => 'required|string',
        //     'mission.start_time' => 'required|date',
        //     'mission.end_time' => 'required|date',
        //     'mission.flight_path' => 'required|array',
        //     'flight_details' => 'required|array',
        //     // Add any other required fields
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->errors()], 400);
        // }

        // Retrieve data from the request
        $missionData = $requestData['mission'];
        $flightDetailsData = $requestData['flight_details'];

        // Save mission data to the database
        $mission = Mission::create([
            'mission_id' => $missionData['mission_id'],
            'start_time' => $missionData['start_time'],
            'end_time' => $missionData['end_time'],
            'flight_path' => $missionData['flight_path']
            // 'flight_path' => json_encode($missionData['flight_path']), // Assuming flight_path is an array
        ]);
        $created_mission = Mission::where('mission_id', $missionData['mission_id'])->first();

        // Save flight details
        foreach ($flightDetailsData as $flightDetail) {
            FlightDetail::create([
                'mission_id' => $created_mission->mission_id,
                'detected_qr_code' => $flightDetail['detected_qr_code'],
                'detected_time' => $flightDetail['detected_time'],
            ]);
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
