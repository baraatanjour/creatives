<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\City;
class LocationController extends Controller
{
    /*
        Function: getLocations v1.0
        Input: ----
        Output: list of objects[location] 
        Description: this function to display all Locations
    */
    public function getLocations(){
    	$locations = Location::all();
    	if (count($locations)==0) {
    		return response()->json(['data' => '' , 'message' => 'No Locations'], 400);
    	}
    	return response()->json(['data' => $locations , 'message' => 'ok'], 200);
    }

    /*
        Function: get location v1.0
        Input: id:integer
        Output: ----- 
        Description: this function to get specified location
    */
    public function getLocation(Location $id){
        
        return $id ;
    }

	/*
        Function: add location v1.0
        Input: name:string, city_id:integer
        Output: ----- 
        Description: this function to add location
    */
    public function addLocation(Request $request){
        $name    = $request->name;
        $city_id = $request->city_id;

        //check if city_id exists
        $city=City::where('id',$city_id)->first();
        if (!isset($city)) {
            return response()->json(['data' => '' , 'message' => 'City Not Found'], 400);
         }

	    $location = new Location;
        $location->name    = $name;
        $location->city_id = $city_id;

    	$location->save();
        return response()->json(['data' => '' , 'message' => 'Location Added Successfully'], 200);
    }
    /*
        Function: update location v1.0
        Input: name:string,city_id:integer
        Output: ----- 
        Description: this function to edit location  
    */
    public function updateLocation(Request $request){
        $id   = $request->id;
        $name    = $request->name;
        $city_id = $request->city_id;

        //check if location id exists
        $location = Location::where( 'id' , $id )->first();     
        if (!isset($location)) {
            return response()->json(['data' => '' , 'message' => 'Location Not Found'], 400);
        }    

        if(isset($name) && $name != NULL){
            $location->name = $name;
        }

        if(isset($city_id) && $city_id != NULL){
       		//check if city_id exists
        	$city=City::where('id',$city_id)->first();
        	if (!isset($city)) {
            	return response()->json(['data' => '' , 'message' => 'City Not Found'], 400);
         } 
            $location->city_id = $city_id;
        }

        $location->save(); 
        return response()->json(['data' => '' , 'message' => 'Location Updated Successfully'], 200);    
    }
    /*
        Function: delete location v1.0
        Input: id:integer
        Output: ----- 
        Description: this function to delete location
    */
    public function deleteLocation(Request $request){
        $id = $request->id;
        $location = Location::where( 'id' , $id )->first();     
        if (!isset($location)) {
            return response()->json(['data' => '' , 'message' => 'Location Not Found'], 400);
        } 
        $location->delete();
        return response()->json(['data' => '' , 'message' => 'Location Deleted Successfully'], 200); 
    }
}
