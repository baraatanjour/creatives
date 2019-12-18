<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\University;
class StudentController extends Controller
{
    /*
        Function: get students v1.0
        Input: ----
        Output: list of objects[student] 
        Description: this function to display all students
    */
    public function getStudents(){
    	$students = Student::all();
    	if (count($students)==0) {
    		return response()->json(['data' => '' , 'message' => 'No Students'], 400);
    	}
    	return response()->json(['data' => $students , 'message' => 'ok'], 200);
    }

    /*
        Function: get student v1.0
        Input: id:integer
        Output: ----- 
        Description: this function to get specified student
    */
    public function getStudent(Student $id){
        
        return $id ;
    }

	/*
        Function: add student v1.0
        Input: name:string, email:string, password:string, university_id:integer
        Output: ----- 
        Description: this function to add student
    */
    public function addStudent(Request $request){
        $name          = $request->name;
    	$email         = $request->email;   
        $password      = $request->password;
    	$university_id = $request->university_id;

        //check if university_id exists
        $university=University::where('id',$university_id)->first();
        if (!isset($university)) {
            return response()->json(['data' => '' , 'message' => 'University Not Found'], 400);
         } 

        $student = new Student;
        $student->name          = $name;
        $student->email         = $email;
        $student->password      = $password;
        $student->university_id = $university_id;
    	$student->save();
        return response()->json(['data' => '' , 'message' => 'Student Added Successfully'], 200);
    }
    /*
        Function: update student v1.0
        Input:  name:string, email:string, password:string, image:string, university_id:integer
        Output: ----- 
        Description: this function to edit student  
    */
    public function updateStudent(Request $request){
        $id   = $request->id;
        $name          = $request->name;
    	$email         = $request->email;   
        $password      = $request->password;
    	$university_id = $request->university_id;

        //check if student id exists
        $student = Student::where( 'id' , $id )->first();     
        if (!isset($student)) {
            return response()->json(['data' => '' , 'message' => 'Student Not Found'], 400);
        }    

        if(isset($name) && $name != NULL){
            $student->name = $name;
        }   

        if(isset($email) && $email != NULL){
            $student->email = $email;
        }   

        if(isset($password) && $password != NULL){
            $student->password = $password;
        }  

        if(isset($university_id) && $university_id != NULL){
        //check if university_id exists
        $university=University::where('id',$university_id)->first();
        if (!isset($university)) {
            return response()->json(['data' => '' , 'message' => 'University Not Found'], 400);
         } 
            $student->university_id = $university_id;
        }

        $student->save(); 
        return response()->json(['data' => '' , 'message' => 'Student Updated Successfully'], 200);    
    }
    /*
        Function: delete student v1.0
        Input: id:integer
        Output: ----- 
        Description: this function to delete student
    */
    public function deleteStudent(Request $request){
        $id = $request->id;
        $student = Student::where( 'id' , $id )->first();     
        if (!isset($student)) {
            return response()->json(['data' => '' , 'message' => 'Student Not Found'], 400);
        } 
        $student->delete();
        return response()->json(['data' => '' , 'message' => 'Student Deleted Successfully'], 200); 
    }
}
