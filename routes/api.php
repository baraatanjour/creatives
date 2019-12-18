<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//course section
Route::get('/getCourses', 'CourseController@getCourses');
Route::get('/getCourse/{id}', 'CourseController@getCourse');
Route::post('/addCourse', 'CourseController@addCourse');
Route::post('/updateCourse', 'CourseController@updateCourse');
Route::post('/deleteCourse', 'CourseController@deleteCourse');

//contact section
Route::get('/getContacts', 'ContactController@getContacts');
Route::get('/getContact/{id}', 'ContactController@getContact');
Route::post('/addContact', 'ContactController@addContact');
Route::post('/updateContact', 'ContactController@updateContact');
Route::post('/deleteContact', 'ContactController@deleteContact');

//category section
Route::get('/getCategories', 'CategoryController@getCategories');
Route::get('/getCategory/{id}', 'CategoryController@getCategory');
Route::post('/addCategory', 'CategoryController@addCategory');
Route::post('/updateCategory', 'CategoryController@updateCategory');
Route::post('/deleteCategory', 'CategoryController@deleteCategory');

//city section
Route::get('/getCities', 'CityController@getCities');
Route::get('/getCity/{id}', 'CityController@getCity');
Route::post('/addCity', 'CityController@addCity');
Route::post('/updateCity', 'CityController@updateCity');
Route::post('/deleteCity', 'CityController@deleteCity');

//coach section
Route::get('/getCoaches', 'CoachController@getCoaches');
Route::get('/getCoach/{id}', 'CoachController@getCoach');
Route::post('/addCoach', 'CoachController@addCoach');
Route::post('/updateCoach', 'CoachController@updateCoach');
Route::post('/deleteCoach', 'CoachController@deleteCoach');

//location section
Route::get('/getLocations', 'LocationController@getLocations');
Route::get('/getLocation/{id}', 'LocationController@getLocation');
Route::post('/addLocation', 'LocationController@addLocation');
Route::post('/updateLocation', 'LocationController@updateLocation');
Route::post('/deleteLocation', 'LocationController@deleteLocation');

//student section
Route::get('/getStudents', 'StudentController@getStudents');
Route::get('/getStudent/{id}', 'StudentController@getStudent');
Route::post('/addStudent', 'StudentController@addStudent');
Route::post('/updateStudent', 'StudentController@updateStudent');
Route::post('/deleteStudent', 'StudentController@deleteStudent');

//university section
Route::get('/getUniversities', 'UniversityController@getUniversities');
Route::get('/getUniversity/{id}', 'UniversityController@getUniversity');
Route::post('/addUniversity', 'UniversityController@addUniversity');
Route::post('/updateUniversity', 'UniversityController@updateUniversity');
Route::post('/deleteUniversity', 'UniversityController@deleteUniversity');

//status section
Route::get('/getStatuses', 'StatusController@getStatuses');
Route::get('/getStatus/{id}', 'StatusController@getStatus');
Route::post('/addStatus', 'StatusController@addStatus');
Route::post('/updateStatus', 'StatusController@updateStatus');
Route::post('/deleteStatus', 'StatusController@deleteStatus');

//course_coach section
Route::get('/getCourseCoaches', 'CourseCoachController@getCourseCoaches');
Route::get('/getCourseCoach/{id}', 'CourseCoachController@getCourseCoach');
Route::post('/addCourseCoach', 'CourseCoachController@addCourseCoach');
Route::post('/updateCourseCoach', 'CourseCoachController@updateCourseCoach');
Route::post('/deleteCourseCoach', 'CourseCoachController@deleteCourseCoach');

//course_gallery section
Route::get('/getCourseGalleries', 'CourseGalleryController@getCourseGalleries');
Route::get('/getCourseGallery/{id}', 'CourseGalleryController@getCourseGallery');
Route::post('/addCourseGallery', 'CourseGalleryController@addCourseGallery');
Route::post('/updateCourseGallery', 'CourseGalleryController@updateCourseGallery');
Route::post('/deleteCourseGallery', 'CourseGalleryController@deleteCourseGallery');

//course_student section
Route::get('/getCourseStudents', 'CourseStudentController@getCourseStudents');
Route::get('/getCourseStudent/{id}', 'CourseStudentController@getCourseStudent');
Route::post('/addCourseStudent', 'CourseStudentController@addCourseStudent');
Route::post('/updateCourseStudent', 'CourseStudentController@updateCourseStudent');
Route::post('/deleteCourseStudent', 'CourseStudentController@deleteCourseStudent');