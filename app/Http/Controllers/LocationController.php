<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\Location;
use Illuminate\Support\Facades\Validator;




class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Location::all(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRouteBetweenTwoLocations($id1, Request $request)
    {

        $location1 = Location::find($id1);

        $validator = Validator::make($request->all(), [
            'latitude2' => 'required|numeric|min:-90|max:90',
            'longitude2' => 'required|numeric|min:-180|max:180',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        if (!$location1) {
            return response()->json(['error' => 'Location not found'], 404);
        }


        // Get the validated latitude2 and longitude2
        $latitude2 = $request->input('latitude2');
        $longitude2 = $request->input('longitude2');

        // Create a dummy location for the second location using the provided latitude and longitude
        $location2 = new \stdClass();
        $location2->latitude = $latitude2;
        $location2->longitude = $longitude2;

        // Optionally, you can give it a name if needed (this is just an example)
        $location2->name = 'Location 2';

        return view('route', compact('location1', 'location2'));


    }

    public function getRouteBetweenTwoLocationsApi($id1, Request $request)
    {
        // Find the first location by its ID
        $location1 = Location::find($id1);

        // Validate the latitude2 and longitude2 parameters
        $validator = Validator::make($request->all(), [
            'latitude2' => 'required|numeric|min:-90|max:90',
            'longitude2' => 'required|numeric|min:-180|max:180',
        ]);

        // If validation fails, return an error
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // If location1 is not found, return an error
        if (!$location1) {
            return response()->json(['error' => 'Location not found'], 404);
        }

        // Get the validated latitude2 and longitude2 from the request
        $latitude2 = $request->input('latitude2');
        $longitude2 = $request->input('longitude2');

        // Create a dummy location for the second location
        $location2 = new \stdClass();
        $location2->latitude = $latitude2;
        $location2->longitude = $longitude2;
        $location2->name = 'Your Location'; // Optional name for the second location

        // Calculate the distance between location1 and location2
        $distance = $this->calculateDistance($location1->latitude, $location1->longitude, $latitude2, $longitude2);

        // Return the response with both locations and the calculated distance
        return response()->json([
            'Selected Location' => $location1,
            'Recieved Location' => $location2,
            'distance_km' => $distance
        ]);
    }

     // Function to calculate the distance between two geographical points
     public function calculateDistance($latitude1, $longitude1, $latitude2, $longitude2)
     {
         $earthRadius = 6371; // Earth radius in kilometers

         // Convert latitude and longitude from degrees to radians
         $lat1 = deg2rad($latitude1);
         $lon1 = deg2rad($longitude1);
         $lat2 = deg2rad($latitude2);
         $lon2 = deg2rad($longitude2);

         // Differences in coordinates
         $dlat = $lat2 - $lat1;
         $dlon = $lon2 - $lon1;

         // Haversine formula
         $a = sin($dlat / 2) * sin($dlat / 2) +
              cos($lat1) * cos($lat2) *
              sin($dlon / 2) * sin($dlon / 2);
         $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

         // Distance in kilometers
         $distance = $earthRadius * $c;

         return $distance;
     }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocationRequest $request)
    {
        $location = Location::create($request->validated());

        return response()->json([
            'message' => 'Location successfully created!',
            'data' => $location
        ], 201);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $location = Location::find($id);

        if (!$location) {
            return response()->json([
                'message' => 'Location not found',
            ], 404);
        }

        return response()->json($location, 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocationRequest $request, Location $location )
    {

        $location->update($request->validated());

        return response()->json([
            'message' => 'Location successfully updated!',
            'data' => $location
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $location->delete();

        return response()->json([
            'message' => 'Location successfully deleted!'
        ], 200);
    }



}
