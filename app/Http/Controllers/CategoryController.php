<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
     /*
        Function: get categories v1.0
        Input: ----
        Output: list of objects[category] 
        Description: this function to display all categories
    */
    public function getCategories(){
    	$categories = Category::all();
    	if (count($categories)==0) {
    		return response()->json(['data' => '' , 'message' => 'No Categories'], 400);
    	}
    	return response()->json(['data' => $categories , 'message' => 'ok'], 200);
    }

    /*
        Function: get category v1.0
        Input: id:integer
        Output: ----- 
        Description: this function to get specified category
    */
    public function getCategory(Category $id){
        
        return $id ;
    }
	/*
        Function: add category v1.0
        Input: name:string
        Output: ----- 
        Description: this function to add category
    */
    public function addCategory(Request $request){
	    $category = new Category;
        $category->name = $request->name;

    	$category->save();
        return response()->json(['data' => '' , 'message' => 'Category Added Successfully'], 200);
    }
    /*
        Function: update category v1.0
        Input: name:string
        Output: ----- 
        Description: this function to edit category  
    */
    public function updateCategory(Request $request){
        $id   = $request->id;
        $name = $request->name;

        //check if category id exists
        $category = Category::where( 'id' , $id )->first();     
        if (!isset($category)) {
            return response()->json(['data' => '' , 'message' => 'Category Not Found'], 400);
        }    

        if(isset($name) && $name != NULL){
            $category->name = $name;
        }

        $category->save(); 
        return response()->json(['data' => '' , 'message' => 'Category Updated Successfully'], 200);    
    }
    /*
        Function: delete category v1.0
        Input: id:integer
        Output: ----- 
        Description: this function to delete category
    */
    public function deleteCategory(Request $request){
        $id = $request->id;
        $category = Category::where( 'id' , $id )->first();     
        if (!isset($category)) {
            return response()->json(['data' => '' , 'message' => 'Category Not Found'], 400);
        } 
        $category->delete();
        return response()->json(['data' => '' , 'message' => 'Category Deleted Successfully'], 200); 
    }
}
