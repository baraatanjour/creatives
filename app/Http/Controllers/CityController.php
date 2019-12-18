<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
class CityController extends Controller
{
    /*
        Function: get cities v1.0
        Input: ----
        Output: list of objects[city] 
        Description: this function to display all cities
    */
    public function getCities(){
    	$cities = City::all();
    	if (count($cities)==0) {
    		return response()->json(['data' => '' , 'message' => 'No Cities'], 400);
    	}
    	return response()->json(['data' => $cities , 'message' => 'ok'], 200);
    }

    /*
        Function: get city v1.0
        Input: id:integer
        Output: ----- 
        Description: this function to get specified city
    */
    public function getCity(City $id){
        
        return $id ;
    }

	/*
        Function: add city v1.0
        Input: name:string
        Output: ----- 
        Description: this function to add city
    */
    public function addCity(Request $request){
	    $city = new City;
        $city->name = $request->name;

    	$city->save();
        return response()->json(['data' => '' , 'message' => 'City Added Successfully'], 200);
    }
    /*
        Function: update city v1.0
        Input: name:string
        Output: ----- 
        Description: this function to edit city  
    */
    public function updateCity(Request $request){
        $id   = $request->id;
        $name = $request->name;

        //check if city id exists
        $city = City::where( 'id' , $id )->first();     
        if (!isset($city)) {
            return response()->json(['data' => '' , 'message' => 'City Not Found'], 400);
        }    

        if(isset($name) && $name != NULL){
            $city->name = $name;
        }

        $city->save(); 
        return response()->json(['data' => '' , 'message' => 'City Updated Successfully'], 200);    
    }
    /*
        Function: delete city v1.0
        Input: id:integer
        Output: ----- 
        Description: this function to delete city
    */
    public function deleteCity(Request $request){
        $id = $request->id;
        $city = City::where( 'id' , $id )->first();     
        if (!isset($city)) {
            return response()->json(['data' => '' , 'message' => 'City Not Found'], 400);
        } 
        $city->delete();
        return response()->json(['data' => '' , 'message' => 'City Deleted Successfully'], 200); 
    }
}
