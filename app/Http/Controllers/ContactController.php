<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Course;
class ContactController extends Controller
{
    /*
        Function: get contacts v1.0
        Input: ----
        Output: list of objects[Course] 
        Description: this function to display all courses
    */
    public function getContacts(){
    	$contacts = Contact::all();
    	if (count($contacts)==0) {
    		return response()->json(['data' => '' , 'message' => 'No Contacts'], 400);
    	}
    	return response()->json(['data' => $contacts , 'message' => 'ok'], 200);
    }

    /*
        Function: get contact v1.0
        Input: id:integer
        Output: ----- 
        Description: this function to get specified contact
    */
    public function getContact(Contact $id){
        
        return $id ;
    }

	/*
        Function: add contact v1.0
        Input: phone:string, email:string, whatsapp:string, course_id:integer
        Output: ----- 
        Description: this function to add contact
    */
    public function addContact(Request $request){

    	$phone     = $request->phone;
    	$email     = $request->email;
    	$whatsapp  = $request->whatsapp;
    	$course_id = $request->course_id;

        //check if course_id exists
        $course=Course::where('id',$course_id)->first();
        if (!isset($course)) {
            return response()->json(['data' => '' , 'message' => 'Course Not Found'], 400);
         } 
       
        $contact = new Contact;
        $contact->phone     = $phone;
        $contact->email     = $email;
        $contact->whatsapp  = $whatsapp;
        $contact->course_id = $course_id;

    	$contact->save();
        return response()->json(['data' => '' , 'message' => 'Contact Added Successfully'], 200);
    }
    /*
        Function: update contact v1.0
        Input: phone:string, email:string, whatsapp:string, course_id:integer
        Output: ----- 
        Description: this function to edit contact  
    */
    public function updateContact(Request $request){
        $id          = $request->id;
        $phone     = $request->phone;
    	$email     = $request->email;
    	$whatsapp  = $request->whatsapp;
    	$course_id = $request->course_id;

        //check if contact id exists
        $contact = Contact::where( 'id' , $id )->first();     
        if (!isset($contact)) {
            return response()->json(['data' => '' , 'message' => 'Contact Not Found'], 400);
        }    

        if(isset($phone) && $phone != NULL){
            $contact->phone = $phone;
        }

        if(isset($email) && $email != NULL){
            $contact->email = $email;
        } 

        if(isset($whatsapp) && $whatsapp != NULL){
            $contact->whatsapp = $whatsapp;
        } 

        if(isset($course_id) && $course_id != NULL){
        	//check if course_id exists
        	$course=Course::where('id',$course_id)->first();
        	if (!isset($course)) {
            	return response()->json(['data' => '' , 'message' => 'Course Not Found'], 400);
        	} 
            $contact->course_id = $course_id;
        } 


        $contact->save(); 
        return response()->json(['data' => '' , 'message' => 'Contact Updated Successfully'], 200);    
    }
    /*
        Function: delete contact v1.0
        Input: id:integer
        Output: ----- 
        Description: this function to delete contact
    */
    public function deleteContact(Request $request){
        $id = $request->id;
        $contact = Contact::where( 'id' , $id )->first();     
        if (!isset($contact)) {
            return response()->json(['data' => '' , 'message' => 'Contact Not Found'], 400);
        } 
        $contact->delete();
        return response()->json(['data' => '' , 'message' => 'Contact Deleted Successfully'], 200); 
    }
}
