<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Courses_gallery;
use App\Course;
class CourseGalleryController extends Controller
{
    /*
        Function: get course_gallery sv1.0
        Input: ----
        Output: list of objects[course_gallery] 
        Description: this function to display all Course galleries
    */
    public function getCourseGalleries(){
    	$course_galleries = Courses_gallery::all();
    	if (count($course_galleries)==0) {
    		return response()->json(['data' => '' , 'message' => 'No Course Galleries'], 400);
    	}
    	return response()->json(['data' => $course_galleries , 'message' => 'ok'], 200);
    }

    /*
        Function: get course_gallery v1.0
        Input: id:integer
        Output: ----- 
        Description: this function to get specified course_gallery
    */
    public function getCourseGallery(Courses_gallery $id){
        
        return $id ;
    }
    
	/*
        Function: add course_coache v1.0
        Input: name:string, course_id:integer
        Output: ----- 
        Description: this function to add course_coache
    */
    public function addCourseGallery(Request $request){
        $name      = $request->name;
        $course_id = $request->course_id;

   		//check if course_id exists
    	$course=Course::where('id',$course_id)->first();
    	if (!isset($course)) {
        	return response()->json(['data' => '' , 'message' => 'Course Not Found'], 400);
     	}

   		 

	    $course_gallery = new Courses_gallery;
        $course_gallery->name      = $name;
        $course_gallery->course_id = $course_id;

    	$course_gallery->save();
        return response()->json(['data' => '' , 'message' => 'Course_gallery Added Successfully'], 200);
    }
    /*
        Function: update course_gallery v1.0
        Input: course_id:integer, name:string
        Output: ----- 
        Description: this function to edit course_gallery  
    */
    public function updateCourseGallery(Request $request){
        $id        = $request->id;
        $name      = $request->name;
        $course_id = $request->course_id;

        //check if course_gallery id exists
        $course_gallery = Courses_gallery::where( 'id' , $id )->first();     
        if (!isset($course_gallery)) {
            return response()->json(['data' => '' , 'message' => 'Course_gallery Not Found'], 400);
        }    

        if(isset($name) && $name != NULL){
            $course_gallery->name = $name;
        }

        if(isset($course_id) && $course_id != NULL){
       		//check if course_id exists
        	$course=Course::where('id',$course_id)->first();
        	if (!isset($course)) {
            	return response()->json(['data' => '' , 'message' => 'Course Not Found'], 400);
         	} 
            $course_gallery->course_id = $course_id;
        }

        $course_gallery->save(); 
        return response()->json(['data' => '' , 'message' => 'Course_gallery Updated Successfully'], 200);    
    }
    /*
        Function: delete course_gallery v1.0
        Input: id:integer
        Output: ----- 
        Description: this function to delete course_gallery
    */
    public function deleteCourseGallery(Request $request){
        $id = $request->id;
        $course_gallery = Courses_gallery::where( 'id' , $id )->first();     
        if (!isset($course_gallery)) {
            return response()->json(['data' => '' , 'message' => 'Course_gallery Not Found'], 400);
        } 
        $course_gallery->delete();
        return response()->json(['data' => '' , 'message' => 'Course_gallery Deleted Successfully'], 200); 
    }
}
