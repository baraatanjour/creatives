<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coach;
use App\University;
class CoachController extends Controller
{
    
    /*
        Function: get coaches v1.0
        Input: ----
        Output: list of objects[coach] 
        Description: this function to display all coaches
    */
    public function getCoaches(){
    	$coaches = Coach::all();
    	if (count($coaches)==0) {
    		return response()->json(['data' => '' , 'message' => 'No Coaches'], 400);
    	}
    	return response()->json(['data' => $coaches , 'message' => 'ok'], 200);
    }

    /*
        Function: get coach v1.0
        Input: id:integer
        Output: ----- 
        Description: this function to get specified coach
    */
    public function getCoach(Coach $id){
        
        return $id ;
    }

	/*
        Function: add coach v1.0
        Input: name:string, email:string, password:string, image:string, phone:string, brief:string, university_id:integer
        Output: ----- 
        Description: this function to add coach
    */
    public function addCoach(Request $request){
        $name          = $request->name;
    	$email         = $request->email;   
        $password      = $request->password;
    	$image         = $request->image;       
        $phone         = $request->phone;
    	$brief         = $request->brief;
    	$university_id = $request->university_id;

        //check if university_id exists
        $university=University::where('id',$university_id)->first();
        if (!isset($university)) {
            return response()->json(['data' => '' , 'message' => 'University Not Found'], 400);
         } 

        $coach = new Coach;
        $coach->name          = $name;
        $coach->email         = $email;
        $coach->password      = $password;
        $coach->image         = $image;
        $coach->phone         = $phone;
        $coach->brief         = $brief;
        $coach->university_id = $university_id;
    	$coach->save();
        return response()->json(['data' => '' , 'message' => 'Coach Added Successfully'], 200);
    }
    /*
        Function: update coach v1.0
        Input:  name:string, email:string, password:string, image:string, phone:string, brief:string, university_id:integer
        Output: ----- 
        Description: this function to edit coach  
    */
    public function updateCoach(Request $request){
        $id   = $request->id;
        $name          = $request->name;
    	$email         = $request->email;   
        $password      = $request->password;
    	$image         = $request->image;       
        $phone         = $request->phone;
    	$brief         = $request->brief;
    	$university_id = $request->university_id;

        //check if coach id exists
        $coach = Coach::where( 'id' , $id )->first();     
        if (!isset($coach)) {
            return response()->json(['data' => '' , 'message' => 'Coach Not Found'], 400);
        }    

        if(isset($name) && $name != NULL){
            $coach->name = $name;
        }   

        if(isset($email) && $email != NULL){
            $coach->email = $email;
        }   

        if(isset($password) && $password != NULL){
            $coach->password = $password;
        }   

        if(isset($image) && $image != NULL){
            $coach->image = $image;
        }   

        if(isset($phone) && $phone != NULL){
            $coach->phone = $phone;
        }   

        if(isset($brief) && $brief != NULL){
            $coach->brief = $brief;
        }   

        if(isset($university_id) && $university_id != NULL){
        //check if university_id exists
        $university=University::where('id',$university_id)->first();
        if (!isset($university)) {
            return response()->json(['data' => '' , 'message' => 'University Not Found'], 400);
         } 
            $coach->university_id = $university_id;
        }

        $coach->save(); 
        return response()->json(['data' => '' , 'message' => 'Coach Updated Successfully'], 200);    
    }
    /*
        Function: delete coach v1.0
        Input: id:integer
        Output: ----- 
        Description: this function to delete coach
    */
    public function deleteCoach(Request $request){
        $id = $request->id;
        $coach = Coach::where( 'id' , $id )->first();     
        if (!isset($coach)) {
            return response()->json(['data' => '' , 'message' => 'Coach Not Found'], 400);
        } 
        $coach->delete();
        return response()->json(['data' => '' , 'message' => 'Coach Deleted Successfully'], 200); 
    }
}
