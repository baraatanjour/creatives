<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Courses_coach;
use App\Coach;
use App\Course;
class CourseCoachController extends Controller
{
    /*
        Function: get Course_coaches sv1.0
        Input: ----
        Output: list of objects[course_coach] 
        Description: this function to display all Course Coaches
    */
    public function getCourseCoaches(){
    	$course_coaches = Courses_coach::all();
    	if (count($course_coaches)==0) {
    		return response()->json(['data' => '' , 'message' => 'No Course Coaches'], 400);
    	}
    	return response()->json(['data' => $course_coaches , 'message' => 'ok'], 200);
    }

    /*
        Function: get Course_coach v1.0
        Input: id:integer
        Output: ----- 
        Description: this function to get specified Course_coach
    */
    public function getCourseCoach(Courses_coach $id){
        
        return $id ;
    }
	/*
        Function: add course_coach v1.0
        Input: coach_id:integer, course_id:integer
        Output: ----- 
        Description: this function to add course_coach
    */
    public function addCourseCoach(Request $request){
        $course_id = $request->course_id;
        $coach_id  = $request->coach_id;

   		//check if course_id exists
    	$course=Course::where('id',$course_id)->first();
    	if (!isset($course)) {
        	return response()->json(['data' => '' , 'message' => 'Course Not Found'], 400);
     	}

   		//check if coach_id exists
    	$coach=Coach::where('id',$coach_id)->first();
    	if (!isset($coach)) {
        	return response()->json(['data' => '' , 'message' => 'Coach Not Found'], 400);
     	} 

	    $course_coach = new Courses_coach;
        $course_coach->course_id = $course_id;
        $course_coach->coach_id  = $coach_id;

    	$course_coach->save();
        return response()->json(['data' => '' , 'message' => 'Course_coach Added Successfully'], 200);
    }
    /*
        Function: update course_coache v1.0
        Input: course_id:integer, coach_id:integer
        Output: ----- 
        Description: this function to edit course_coache  
    */
    public function updateCourseCoach(Request $request){
        $id        = $request->id;
        $course_id = $request->course_id;
        $coach_id  = $request->coach_id;

        //check if course_coach id exists
        $course_coach = Courses_coach::where( 'id' , $id )->first();     
        if (!isset($course_coach)) {
            return response()->json(['data' => '' , 'message' => 'Course_coach Not Found'], 400);
        }    

        if(isset($course_id) && $course_id != NULL){
       		//check if course_id exists
        	$course=Course::where('id',$course_id)->first();
        	if (!isset($course)) {
            	return response()->json(['data' => '' , 'message' => 'Course Not Found'], 400);
         	} 
            $course_coach->course_id = $course_id;
        }

        if(isset($coach_id) && $coach_id != NULL){
       		//check if coach_id exists
        	$coach=Coach::where('id',$coach_id)->first();
        	if (!isset($coach)) {
            	return response()->json(['data' => '' , 'message' => 'Coach Not Found'], 400);
         	} 
            $course_coach->coach_id = $coach_id;
        }

        $course_coach->save(); 
        return response()->json(['data' => '' , 'message' => 'Course_coach Updated Successfully'], 200);    
    }
    /*
        Function: delete course_coach v1.0
        Input: id:integer
        Output: ----- 
        Description: this function to delete course_coach
    */
    public function deleteCourseCoach(Request $request){
        $id = $request->id;
        $course_coach = Courses_coach::where( 'id' , $id )->first();     
        if (!isset($course_coach)) {
            return response()->json(['data' => '' , 'message' => 'Course_coach Not Found'], 400);
        } 
        $course_coach->delete();
        return response()->json(['data' => '' , 'message' => 'Course_coach Deleted Successfully'], 200); 
    }
}
