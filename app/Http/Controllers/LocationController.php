<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\Location;



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
    public function getRouteBetweenTwoLocations($id1, $id2)
    {



        $location1 = Location::find($id1);
        $location2 = Location::find($id2);

        if (!$location1 || !$location2) {
            return response()->json([
                'message' => 'One or both locations not found'
            ], 404);
        }

        $distance = $this->haversineDistance($location1->latitude, $location1->longitude, $location2->latitude, $location2->longitude);

        return response()->json([
            'from' => [
                'id' => $location1->id,
                'name' => $location1->name,
                'latitude' => $location1->latitude,
                'longitude' => $location1->longitude
            ],
            'to' => [
                'id' => $location2->id,
                'name' => $location2->name,
                'latitude' => $location2->latitude,
                'longitude' => $location2->longitude
            ],
            'distance_km' => $distance
        ]);
    }

    private function haversineDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371; // Earth's radius in KM

        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLng / 2) * sin($dLng / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c; // Distance in KM
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
