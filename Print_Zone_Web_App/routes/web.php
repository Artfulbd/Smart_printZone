<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'App\Http\Controllers\Student\StudentDashBoardController@index')->name('student.dashboard')->middleware('auth');


// Student
Route::get('/student_landing','App\Http\Controllers\Student\StudentDashBoardController@index')->name('student.dashboard')->middleware('auth');



// Student Print
Route::get('/print_pdf','App\Http\Controllers\Student\PrintPdfController@index')->name('print_pdf');  // Print PDF Page
Route::post('/print_file_cmd','App\Http\Controllers\Student\PrintPdfController@print_file_cmd')->name('print_file_cmd');  // Print File


// Student Print Queue
Route::get('/print_queue','App\Http\Controllers\Student\Print_Queue@index')->name('student.print_queue');
Route::post('/cancel_print','App\Http\Controllers\Student\Print_Queue@cancel_print')->name('student.cancel_print');




// Admin
Route::get('/admin_landing','App\Http\Controllers\Admin\AdminDashBoardController@admin_dashboard')->name('admin.dashboard')->middleware('auth');


// Admin Print System
Route::get('/on_off_system','App\Http\Controllers\Admin\PrintSystemController@index')->name('admin.on_off_system')->middleware('auth');
Route::post('/on_off_action','App\Http\Controllers\Admin\PrintSystemController@on_off_action')->name('admin.on_off_action')->middleware('auth');


// Admin Print Setting
Route::get('/view_print_setting','App\Http\Controllers\Admin\PrintSystemController@view_print_setting')->name('admin.view_print_setting')->middleware('auth');
Route::post('/create_print_setting','App\Http\Controllers\Admin\PrintSystemController@create_print_setting')->name('admin.create_print_setting')->middleware('auth');
Route::post('/edit_print_setting','App\Http\Controllers\Admin\PrintSystemController@edit_print_setting')->name('admin.edit_print_setting')->middleware('auth');
Route::post('/delete_print_setting','App\Http\Controllers\Admin\PrintSystemController@delete_print_setting')->name('admin.delete_print_setting')->middleware('auth');


// Admin Manage
Route::get('/view_manage_admin','App\Http\Controllers\Admin\ManageAdminController@index')->name('admin.view_manage_admin')->middleware('auth');
Route::POST('/create_admin','App\Http\Controllers\Admin\ManageAdminController@create_admin')->name('admin.create_admin')->middleware('auth');
Route::POST('/edit_admin','App\Http\Controllers\Admin\ManageAdminController@edit_admin')->name('admin.edit_admin')->middleware('auth');
Route::POST('/delete_admin','App\Http\Controllers\Admin\ManageAdminController@delete_admin')->name('admin.delete_admin')->middleware('auth');
