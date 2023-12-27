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
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/','Auth\LoginController@index')->name('/');
route::get('logout','Auth\LoginController@logout')->name('logout.user');
Route::post('user/authentication','Auth\LoginController@authenticate')->name('authentication');
Route::get('forgot/password','Auth\ForgotPasswordController@index')->name('forgot.password');
Route::post('create/code','Auth\ForgotPasswordController@create_reset_code')->name('create.code');
Route::post('reset/password','Auth\ResetPasswordController@reset_password')->name('reset.password');
Route::get('reset/form','Auth\ResetPasswordController@index')->name('reset.form');
Route::get('dashboard','Dashboard\HomeController@index')->name('dashboard');
Route::get('hospital/dashboard','Dashboard\HospitalController@index')->name('hospital.dashboard');
Route::get('clients','Patient\RegistrationController@index')->name('clients.list');
Route::get('client/registration','Patient\RegistrationController@patient_form')->name('client.form');
Route::post('client/create','Patient\RegistrationController@create')->name('client.create');
Route::get('client/{id}/reminders','Patient\AppointmentController@index')->name('client.reminders');
Route::post('appointment/create','Patient\AppointmentController@create')->name('appointment.create');
Route::get('get_district/{id}','Patient\RegistrationController@district');
Route::get('get_ward/{id}','Patient\RegistrationController@ward');
Route::get('appointment/list','Patient\AppointmentController@list')->name('appointments.list');
Route::get('hospitals/list','Management\HospitalController@list')->name('hospitals.list');
Route::post('hospital/create','Management\HospitalController@create')->name('hospital.create');
Route::post('hospital/update','Management\HospitalController@update')->name('hospital.update');
Route::get('hospital/{id}/staff','Management\StaffController@list')->name('hospital.staff');
Route::post('staff/create','Management\StaffController@create')->name('staff.create');
Route::post('user/create','Management\UserController@create')->name('user.create');
Route::post('user/update','Management\UserController@update')->name('user.update');
Route::post('user/disable','Management\UserController@disable_user')->name('disable.user');
Route::post('user/enable','Management\UserController@enable_user')->name('enable.user');
Route::get('users/list','Management\UserController@list')->name('users.list');
Route::get('reminders/{id}/list','Patient\AppointmentController@reminders')->name('hospital.reminders');
Route::post('client/search','Patient\RegistrationController@search_client')->name('client.search');
Route::get('client/{id}/edit','Patient\RegistrationController@edit')->name('client.edit');
Route::post('client/update','Patient\RegistrationController@update')->name('client.update');
Route::post('appointment/update','Patient\AppointmentController@update')->name('appointment.update');


//reports
Route::get('hospital/report','Report\HospitalController@index')->name('hospital.report');
Route::post('hospital/filter','Report\HospitalController@filter_hospitals')->name('hospital.filter');
Route::post('hospital/generate/report','Report\HospitalController@generate_report')->name('hospital.get.report');
Route::get('client/report','Report\ClientController@index')->name('client.report');
Route::post('client/filter','Report\ClientController@filter_clients')->name('client.filter');
Route::post('client/generate/report','Report\ClientController@generate_report')->name('client.get.report');
Route::get('user/report','Report\UserController@index')->name('user.report');
Route::post('user/filter','Report\UserController@filter_users')->name('user.filter');
Route::post('user/generate/report','Report\UserController@generate_report')->name('user.get.report');
Route::get('reminders/report','Report\ReminderController@index')->name('reminders.report');
Route::post('reminder/filter','Report\ReminderController@filter_reminders')->name('reminder.filter');
Route::post('reminder/generate/report','Report\ReminderController@generate_report')->name('reminder.get.report');



