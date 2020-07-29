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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('checkin', 'api\AttendanceController@check_in');
    Route::get('checkout', 'api\AttendanceController@check_out');
    Route::get('attendancelog/', 'api\AttendanceController@users_log_of_a_day');
    Route::get('checklaststatus', 'api\AttendanceController@check_last_status');
    Route::get('/attendanceMonthly/{user_id}/','api\NewAttendanceController@GetAttendanceMonthly');
    Route::get('/attendanceDaily/{user_id}/','api\NewAttendanceController@GetAttendancedaily');
    Route::get('/homepage/{user_id}','api\NewAttendanceController@Gethomepage');

 
  


});
Route::post('login', 'api\LoginController@login');


 // Route::get('checkin', 'api\AttendanceController@check_in');
