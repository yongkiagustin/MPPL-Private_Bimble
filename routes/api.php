<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::resource('staff', 'StaffController');
Route::resource('student', 'StudentController');
Route::get('user', 'UserController@getAuthenticatedUser')->middleware('jwt.verify');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return response(['message' => 'Access Denied!']);
});

Route::post('login', 'StaffController@login');
Route::middleware(['jwt.auth'])->group(function () {

    Route::prefix('programs')->group(function () {
        Route::get('/' , 'ProgramController@index')->middleware('jwt.refresh');
        Route::get('/{id}' , 'ProgramController@show');
        Route::get('/{programId}/courses' , 'ProgramController@courses');
        Route::get('/{programId}/students' , 'ProgramController@students');
    });

    Route::prefix('courses')->group(function () {
        Route::get('/{id}' , 'CourseController@show');
        Route::post('/{id}' , 'CourseController@store');
        Route::post('/answers/{id}' , 'CourseController@answers');
    });

});
