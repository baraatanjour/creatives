<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\University;
class UniversityController extends Controller
{
    /*
        Function: get universities v1.0
        Input: ----
        Output: list of objects[university] 
        Description: this function to display all universities
    */
    public function getUniversities(){
    	$universities = University::all();
    	if (count($universities)==0) {
    		return response()->json(['data' => '' , 'message' => 'No Universities'], 400);
    	}
    	return response()->json(['data' => $universities , 'message' => 'ok'], 200);
    }

    /*
        Function: get university v1.0
        Input: id:integer
        Output: ----- 
        Description: this function to get specified university
    */
    public function getUniversity(University $id){
        
        return $id ;
    }


	/*
        Function: add university v1.0
        Input: name:string
        Output: ----- 
        Description: this function to add university
    */
    public function addUniversity(Request $request){
	    $university = new University;
        $university->name = $request->name;

    	$university->save();
        return response()->json(['data' => '' , 'message' => 'University Added Successfully'], 200);
    }
    /*
        Function: update university v1.0
        Input: name:string
        Output: ----- 
        Description: this function to edit university  
    */
    public function updateUniversity(Request $request){
        $id   = $request->id;
        $name = $request->name;

        //check if university id exists
        $university = University::where( 'id' , $id )->first();     
        if (!isset($university)) {
            return response()->json(['data' => '' , 'message' => 'University Not Found'], 400);
        }    

        if(isset($name) && $name != NULL){
            $university->name = $name;
        }

        $university->save(); 
        return response()->json(['data' => '' , 'message' => 'University Updated Successfully'], 200);    
    }
    /*
        Function: delete university v1.0
        Input: id:integer
        Output: ----- 
        Description: this function to delete university
    */
    public function deleteUniversity(Request $request){
        $id = $request->id;
        $university = University::where( 'id' , $id )->first();     
        if (!isset($university)) {
            return response()->json(['data' => '' , 'message' => 'University Not Found'], 400);
        } 
        $university->delete();
        return response()->json(['data' => '' , 'message' => 'University Deleted Successfully'], 200); 
    }
}
