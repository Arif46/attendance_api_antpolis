<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('backend.index');
// })->name('home');
Route::get('/profile', 'ProfileController@index')->name('profile.index');
Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
Route::post('/profile/update', 'ProfileController@update')->name('profile.update');
Route::get('/profile/approve/index', 'ProfileController@approval_profile_data')->name('profile.approve.index');
Route::get('/profile/approve', 'ProfileController@approve_profile')->name('profile.approve');
Route::post('/profile/remarks/store', 'ProfileController@profile_remarks_store')->name('profile.remarks.store');
Route::get('/profile/remarks/show', 'ProfileController@profile_remarks_show')->name('profile.remarks.show');

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'employee','middleware' => ['auth']], function() {
	Route::get('/', 'admin\UserController@index')->name('add-employee');
Route::post('/store', 'admin\UserController@store')->name('user.store');
Route::get('/view', 'admin\UserController@show')->name('user.show');
Route::get('/edit', 'admin\UserController@edit')->name('user.edit');
Route::post('/update', 'admin\UserController@update')->name('user.update');
Route::get('/destroy', 'admin\UserController@destroy')->name('user.destroy');


});

Route::group(['prefix' => 'department','middleware' => ['auth']], function() {
 Route::get('/','admin\DepartmentController@index')->name('department.index');
 Route::post('store','admin\DepartmentController@store')->name('department.store');
 Route::get('destroy','admin\DepartmentController@destroy')->name('department.destroy');
 Route::get('detail','admin\DepartmentController@detail')->name('department.detail');
 Route::post('update','admin\DepartmentController@update')->name('department.update');
});
 Route::group(['prefix' => 'attendance','middleware' => ['auth']], function() {
 Route::get('/own', 'AttendanceController@index')->name('attendance.own');
Route::get('/in', 'AttendanceController@check_in')->name('attendance.check_in');
Route::get('/out', 'AttendanceController@check_out')->name('attendance.check_out');
Route::get('/today', 'AttendanceController@attendance_today')->name('attendance.today');
// attendnce store
Route::get('/single/index', 'AttendanceController@single_attendance_index')->name('attendance.single.index');
Route::post('/single/store', 'AttendanceController@single_attendance_store')->name('attendance.single.store');

// approval
Route::get('/approve-index', 'ApproveAttendanceController@index')->name('attendance.approve.index');

Route::get('/unapprove-findSuper', 'ApproveAttendanceController@find_unApproved_superAdmin_attendance')->name('attendance.unapproved.super.find');

Route::post('/approve-super', 'ApproveAttendanceController@approved_by_superAdmin')->name('attendance.approve.super');
Route::get('/log/single', 'AttendanceController@log_single')->name('attendance.log.single');
});
 

Route::group(['prefix' => 'company','middleware' => ['auth']], function() {
 Route::get('','admin\CompanyController@index')->name('company.index');
 Route::post('store','admin\CompanyController@store')->name('company.store');
 Route::get('destroy','admin\CompanyController@destroy')->name('company.destroy');
 Route::get('detail','admin\CompanyController@detail')->name('company.detail');
 Route::post('update','admin\CompanyController@update')->name('company.update'); 
});
Route::group(['prefix' => 'designation','middleware' => ['auth']], function() {
 Route::get('','admin\DesignationController@index')->name('designation.index');
 Route::post('store','admin\DesignationController@store')->name('designation.store');
 Route::get('destroy','admin\DesignationController@destroy')->name('designation.destroy');
 Route::get('detail','admin\DesignationController@detail')->name('designation.detail');
 Route::post('update','admin\DesignationController@update')->name('designation.update');
});
Route::group(['prefix' => 'subdepartment','middleware' => ['auth']], function() {
 Route::get('/','admin\SubDepartmentController@index')->name('sub-department.index');
 Route::post('subdepartmentstore','admin\SubDepartmentController@store')->name('sub-department.store');
 Route::get('subdepartmentdestroy','admin\SubDepartmentController@destroy')->name('sub-department.destroy');
 Route::get('subdepartmentdetail','admin\SubDepartmentController@detail')->name('sub-department.detail');
 Route::post('subdepartmentupdate','admin\SubDepartmentController@update')->name('sub-department.update'); 
});



Route::get('/lead-industry','LeadGeneration\IndustryController@index')->name('lead.industry.index');
Route::post('/create-industry','LeadGeneration\IndustryController@store')->name('lead.industry.store');
Route::get('/show-industry','LeadGeneration\IndustryController@show')->name('lead.industry.show');
Route::get('/edit-industry','LeadGeneration\IndustryController@edit')->name('lead.industry.edit');
Route::get('/destroy-industry','LeadGeneration\IndustryController@destroy')->name('lead.industry.destroy');
Route::post('/update-industry','LeadGeneration\IndustryController@update')->name('lead.industry.update');


Route::get('/lead-leadcompany','LeadGeneration\CompanyLeadController@index')->name('lead.company.index');
Route::post('/create-leadcompany','LeadGeneration\CompanyLeadController@store')->name('lead.company.store');
Route::get('/show-leadcompany','LeadGeneration\CompanyLeadController@show')->name('lead.company.show');
Route::get('/edit-leadcompany','LeadGeneration\CompanyLeadController@edit')->name('lead.company.edit');
Route::get('/destroy-leadcompany','LeadGeneration\CompanyLeadController@destroy')->name('lead.company.destroy');
Route::post('/update-leadcompany','LeadGeneration\CompanyLeadController@update')->name('lead.company.update');


Route::get('/lead-leadbrand','LeadGeneration\BrandController@index')->name('lead.brand.index');
Route::post('/create-leadbrand','LeadGeneration\BrandController@store')->name('lead.brand.store');
Route::get('/show-leadbrand','LeadGeneration\BrandController@show')->name('lead.brand.show');
Route::get('/edit-leadbrand','LeadGeneration\BrandController@edit')->name('lead.brand.edit');
Route::get('/destroy-leadbrand','LeadGeneration\BrandController@destroy')->name('lead.brand.destroy');
Route::post('/update-leadbrand','LeadGeneration\BrandController@update')->name('lead.brand.update');


Route::get('/lead-Subindustry','LeadGeneration\SubIndustryController@index')->name('lead.subindustry.index');
Route::post('/create-Subindustry','LeadGeneration\SubIndustryController@store')->name('lead.subindustry.store');
Route::get('/show-Subindustry','LeadGeneration\SubIndustryController@show')->name('lead.subindustry.show');
Route::get('/edit-Subindustry','LeadGeneration\SubIndustryController@edit')->name('lead.subindustry.edit');
Route::get('/destroy-Subindustry','LeadGeneration\SubIndustryController@destroy')->name('lead.subindustry.destroy');
Route::post('/update-Subindustry','LeadGeneration\SubIndustryController@update')->name('lead.subindustry.update');

Route::get('/lead-ProductOrService','LeadGeneration\ProductOrServiceController@index')->name('lead.productorservice.index');
Route::post('/create-ProductOrService','LeadGeneration\ProductOrServiceController@store')->name('lead.productorservice.store');
Route::get('/show-ProductOrService','LeadGeneration\ProductOrServiceController@show')->name('lead.productorservice.show');
Route::get('/edit-ProductOrService','LeadGeneration\ProductOrServiceController@edit')->name('lead.productorservice.edit');
Route::get('/destroy-ProductOrService','LeadGeneration\ProductOrServiceController@destroy')->name('lead.productorservice.destroy');
Route::post('/update-ProductOrService','LeadGeneration\ProductOrServiceController@update')->name('lead.productorservice.update');

Route::get('/lead-brandservice','LeadGeneration\BrandServiceController@index')->name('lead.brandservice.index');
Route::post('/create-brandservice','LeadGeneration\BrandServiceController@store')->name('lead.brandservice.store');
Route::get('/show-brandservice','LeadGeneration\BrandServiceController@show')->name('lead.brandservice.show');
Route::get('/edit-brandservice','LeadGeneration\BrandServiceController@edit')->name('lead.brandservice.edit');
Route::get('/destroy-brandservice','LeadGeneration\BrandServiceController@destroy')->name('lead.brandservice.destroy');
Route::post('/update-brandservice','LeadGeneration\BrandServiceController@update')->name('lead.brandservice.update');
Route::get('/find','LeadGeneration\BrandServiceController@product_or_service_list')->name('lead.find_product_or_service');

// Route::get('admin/profile', function () {
//     //
// })->middleware('auth');

// Auth::routes();
Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');;


Route::group(['prefix' => 'attendance/old','middleware' => ['auth']], function() {
 Route::get('/attendance-own', 'OldAttendanceController@index')->name('attendance.own.old');
Route::get('/attendance-in', 'OldAttendanceController@check_in')->name('attendance.check_in.old');
Route::get('/attendance-out', 'OldAttendanceController@check_out')->name('attendance.check_out.old');
Route::get('/attendance-today', 'OldAttendanceController@attendance_today')->name('attendance.today.old');

Route::get('/attendance-approve-index', 'OldApproveAttendanceController@index')->name('attendance.approve.index.old');

Route::get('/attendance-unapprove-findSuper', 'OldApproveAttendanceController@find_unApproved_superAdmin_attendance')->name('attendance.unapproved.super.find.old');

Route::post('/attendance-approve-super', 'OldApproveAttendanceController@approved_by_superAdmin')->name('attendance.approve.super.old');
});
 

Route::get('/clear-cache', function() {

    $configCache = Artisan::call('config:cache');
    $clearCache = Artisan::call('cache:clear');
    // return what you want
    return "Finished";
});
