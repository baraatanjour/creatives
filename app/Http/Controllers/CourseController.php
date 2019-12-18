<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Location;
use App\Category;

class CourseController extends Controller
{

	/*
        Function: get courses v1.0
        Input: ----
        Output: list of objects[Course] 
        Description: this function to display all courses
    */
    public function getCourses(){
    	$courses = Course::all();
    	if (count($courses)==0) {
    		return response()->json(['data' => '' , 'message' => 'No Courses'], 400);
    	}
    	return response()->json(['data' => $courses , 'message' => 'ok'], 200);
    }

    /*
        Function: get course v1.0
        Input: id:integer
        Output: ----- 
        Description: this function to get specified course
    */
    public function getCourse(Course $id){
        
        return $id ;
    }

    /*
        Function: add course v1.0
        Input: title:string, description:string, cover:string, cost:integer, start_date:date, address:string, location_id:integer, category_id:integer
        Output: ----- 
        Description: this function to add course
    */
    public function addCourse(Request $request){

    	$title       = $request->title;
    	$description = $request->description;
    	$cost 	     = $request->cost;
    	$cover 	     = $request->cover;
    	$start_date  = $request->start_date;
    	$address     = $request->address;
    	$location_id = $request->location_id;
    	$category_id = $request->category_id;

        //check if location_id exists
        $location=Location::where('id',$location_id)->first();
        if (!isset($location)) {
            return response()->json(['data' => '' , 'message' => 'Location Not Found'], 400);
         } 
        //check if category_id exists
        $category=Category::where('id',$category_id)->first();
        if (!isset($category)) {
            return response()->json(['data' => '' , 'message' => 'Category Not Found'], 400);
         } 
        //check if cost is integer
        if (!is_numeric($cost)) {
            return response()->json(['data' => '' , 'message' => 'Cost Not Valid'], 400);
         }
        $course = new Course;
        $course->title       = $title;
        $course->description = $description;
        $course->cost        = $cost;
        $course->cover       = $cover;
        $course->start_date  = $start_date;
        $course->address     = $address;
        $course->location_id = $location_id;
        $course->category_id = $category_id;

    	$course->save();
        return response()->json(['data' => '' , 'message' => 'Course Added Successfully'], 200);
    	
    }
    /*
        Function: update course v1.0
        Input: title:string, description:string, cover:string, cost:integer, start_date:date, address:string, location_id:integer, category_id:integer
        Output: ----- 
        Description: this function to edit course
    */
    public function updateCourse(Request $request){
        $id          = $request->id;
        $title       = $request->title;
        $description = $request->description;
        $cost        = $request->cost;
        $cover       = $request->cover;
        $start_date  = $request->start_date;
        $address     = $request->address;
        $location_id = $request->location_id;
        $category_id = $request->category_id;

        //check if course id exists
        $course = Course::where( 'id' , $id )->first();     
        if (!isset($course)) {
            return response()->json(['data' => '' , 'message' => 'Course Not Found'], 400);
        }    

        if(isset($title) && $title != NULL){
            $course->title = $title;
        }

        if(isset($description) && $description != NULL){
            $course->description = $description;
        } 

        if(isset($cost) && $cost != NULL){
            if (!is_numeric($cost)) {
            return response()->json(['data' => '' , 'message' => 'Cost Not Valid'], 400);
            }
            $course->cost = $cost;
        } 

        if(isset($cover) && $cover != NULL){
            $course->cover = $cover;
        } 

        if(isset($start_date) && $start_date != NULL){
            $course->start_date = $start_date;
        } 
        if(isset($address) && $address != NULL){
            $course->address = $address;
        } 

        if(isset($location_id) && $location_id != NULL){
            $location=Location::where('id',$location_id)->first();
            if (!isset($location)) {
                return response()->json(['data' => '' , 'message' => 'Location Not Found'], 400);
             } 
            $course->location_id = $location_id;
        } 

        if(isset($category_id) && $category_id != NULL){
            $category=Category::where('id',$category_id)->first();
            if (!isset($category)) {
                return response()->json(['data' => '' , 'message' => 'Category Not Found'], 400);
             } 
            $course->category_id = $category_id;
        } 

        $course->save(); 
        return response()->json(['data' => '' , 'message' => 'Course Updated Successfully'], 200);    
    }
    /*
        Function: delete course v1.0
        Input: id:integer
        Output: ----- 
        Description: this function to delete course
    */
    public function deleteCourse(Request $request){
        $id = $request->id;
        $course = Course::where( 'id' , $id )->first();     
        if (!isset($course)) {
            return response()->json(['data' => '' , 'message' => 'Course Not Found'], 400);
        } 
        $course->delete();
        return response()->json(['data' => '' , 'message' => 'Course Deleted Successfully'], 200); 
    }

}












