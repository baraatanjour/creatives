<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;
class StatusController extends Controller
{
        /*
        Function: get statuses v1.0
        Input: ----
        Output: list of objects[status] 
        Description: this function to display all statuses
    */
    public function getStatuses(){
    	$statuses = Status::all();
    	if (count($statuses)==0) {
    		return response()->json(['data' => '' , 'message' => 'No Statuses'], 400);
    	}
    	return response()->json(['data' => $statuses , 'message' => 'ok'], 200);
    }

    /*
        Function: get status v1.0
        Input: id:integer
        Output: ----- 
        Description: this function to get specified status
    */
    public function getStatus(Status $id){
        
        return $id ;
    }

	/*
        Function: add status v1.0
        Input: name:string
        Output: ----- 
        Description: this function to add status
    */
    public function addStatus(Request $request){
	    $status = new Status;
        $status->name = $request->name;

    	$status->save();
        return response()->json(['data' => '' , 'message' => 'Status Added Successfully'], 200);
    }
    /*
        Function: update status v1.0
        Input: name:string
        Output: ----- 
        Description: this function to edit status  
    */
    public function updateStatus(Request $request){
        $id   = $request->id;
        $name = $request->name;

        //check if status id exists
        $status = Status::where( 'id' , $id )->first();     
        if (!isset($status)) {
            return response()->json(['data' => '' , 'message' => 'Status Not Found'], 400);
        }    

        if(isset($name) && $name != NULL){
            $status->name = $name;
        }

        $status->save(); 
        return response()->json(['data' => '' , 'message' => 'Status Updated Successfully'], 200);    
    }
    /*
        Function: delete status v1.0
        Input: id:integer
        Output: ----- 
        Description: this function to delete status
    */
    public function deleteStatus(Request $request){
        $id = $request->id;
        $status = Status::where( 'id' , $id )->first();     
        if (!isset($status)) {
            return response()->json(['data' => '' , 'message' => 'Status Not Found'], 400);
        } 
        $status->delete();
        return response()->json(['data' => '' , 'message' => 'Status Deleted Successfully'], 200); 
    }
}
