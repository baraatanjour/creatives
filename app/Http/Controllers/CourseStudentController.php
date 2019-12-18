<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Student;
use App\Status;
use App\Courses_student;

class CourseStudentController extends Controller
{
    /*
        Function: get course_students sv1.0
        Input: ----
        Output: list of objects[course_student] 
        Description: this function to display all Course Students
    */
    public function getCourseStudents(){
    	$course_students = Courses_student::all();
    	if (count($course_students)==0) {
    		return response()->json(['data' => '' , 'message' => 'No Course Students'], 400);
    	}
    	return response()->json(['data' => $course_students , 'message' => 'ok'], 200);
    }

    /*
        Function: get course_student v1.0
        Input: id:integer
        Output: ----- 
        Description: this function to get specified course_student
    */
    public function getCourseStudent(Courses_student $id){
        
        return $id ;
    }

	/*
        Function: add course_student v1.0
        Input: student_id:integer, course_id:integer, status_id:integer
        Output: ----- 
        Description: this function to add course_student
    */
    public function addCourseStudent(Request $request){
        $course_id  = $request->course_id;
        $student_id = $request->student_id;
        $status_id  = $request->status_id;

   		//check if course_id exists
    	$course=Course::where('id',$course_id)->first();
    	if (!isset($course)) {
        	return response()->json(['data' => '' , 'message' => 'Course Not Found'], 400);
     	}

   		//check if student_id exists
    	$student=Student::where('id',$student_id)->first();
    	if (!isset($student)) {
        	return response()->json(['data' => '' , 'message' => 'Student Not Found'], 400);
     	} 

		//check if status_id exists
    	$status=Status::where('id',$status_id)->first();
    	if (!isset($status)) {
        	return response()->json(['data' => '' , 'message' => 'Status Not Found'], 400);
     	} 

	    $course_student = new Courses_student;
        $course_student->course_id  = $course_id;
        $course_student->student_id = $student_id;
        $course_student->status_id  = $status_id;

    	$course_student->save();
        return response()->json(['data' => '' , 'message' => 'Course_student Added Successfully'], 200);
    }
    /*
        Function: update course_student v1.0
        Input: course_id:integer, coach_id:integer
        Output: ----- 
        Description: this function to edit course_student  
    */
    public function updateCourseStudent(Request $request){
        $id         = $request->id;
        $course_id  = $request->course_id;
        $student_id = $request->student_id;
        $status_id  = $request->status_id;

        //check if course_student id exists
        $course_student = Courses_student::where( 'id' , $id )->first();     
        if (!isset($course_student)) {
            return response()->json(['data' => '' , 'message' => 'Course_student Not Found'], 400);
        }    

        if(isset($course_id) && $course_id != NULL){
       		//check if course_id exists
        	$course=Course::where('id',$course_id)->first();
        	if (!isset($course)) {
            	return response()->json(['data' => '' , 'message' => 'Course Not Found'], 400);
         	} 
            $course_student->course_id = $course_id;
        }

        if(isset($student_id) && $student_id != NULL){
       		//check if student_id exists
        	$student=Student::where('id',$student_id)->first();
        	if (!isset($student)) {
            	return response()->json(['data' => '' , 'message' => 'Student Not Found'], 400);
         	} 
            $course_student->student_id = $student_id;
        }

        if(isset($status_id) && $status_id != NULL){
       		//check if status_id exists
        	$status=Status::where('id',$status_id)->first();
        	if (!isset($status)) {
            	return response()->json(['data' => '' , 'message' => 'Status Not Found'], 400);
         	} 
            $course_student->status_id = $status_id;
        }

        $course_student->save(); 
        return response()->json(['data' => '' , 'message' => 'Course_student Updated Successfully'], 200);    
    }
    /*
        Function: delete course_student v1.0
        Input: id:integer
        Output: ----- 
        Description: this function to delete course_student
    */
    public function deleteCourseStudent(Request $request){
        $id = $request->id;
        $course_student = Courses_student::where( 'id' , $id )->first();     
        if (!isset($course_student)) {
            return response()->json(['data' => '' , 'message' => 'Course_student Not Found'], 400);
        } 
        $course_student->delete();
        return response()->json(['data' => '' , 'message' => 'Course_student Deleted Successfully'], 200); 
    }
}
