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

Route::post('role', 'Api\RoleController@store');
// Route::get('user','Api\UserController@index');


/** 
 * AuthController
 * The AuthController hndles all form of user authentication
 * from creatiing User, loggin in user and send back a token,
 * forgot password, email verification,...
 */

Route::post('auth/signup', 'Api\AuthController@signup');  //register a new User
Route::post('auth/signin', 'Api\AuthController@signIn');  //authenticate a user and send back a token
Route::post('auth/forgot', 'Api\AuthController@forgotPassword');   //user forgot password

/** AuthContoller endpoints ends here */
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::apiresource('book', 'Api\BookController');
    Route::put('book/file/{id}', 'Api\BookController@updateBookFile');
    Route::get('userdetails', 'Api\UserController@getUserDetails');

    Route::apiresource('faculty', 'Api\FacultyController');
    Route::get('faculty/{id}/dep', 'Api\FacultyController@departments');


    Route::apiresource('departments', 'Api\DepartmentController');
    Route::get('departments/{id}/prog', 'Api\DepartmentController@programs');

    Route::apiresource('programs', 'Api\ProgramController');

    Route::get('levels', 'Api\LevelController@index');

    Route::post('levels', 'Api\LevelController@store');
    Route::delete('levels/{id}', 'Api\LevelController@destroy');
});








