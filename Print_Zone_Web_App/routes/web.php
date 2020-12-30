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

Route::get('/home', 'App\Http\Controllers\DashBoardController@student_dashboard')->name('student.dashboard')->middleware('auth');


// Student
Route::get('/student_landing','App\Http\Controllers\DashBoardController@student_dashboard')->name('student.dashboard')->middleware('auth');



// Print
Route::get('/print_pdf','App\Http\Controllers\PrintPdfController@index')->name('print_pdf');  // Print PDF Page
Route::post('/print_file_cmd','App\Http\Controllers\PrintPdfController@print_file_cmd')->name('print_file_cmd');  // Print File


// Print Queue
Route::get('/print_queue','App\Http\Controllers\Print_Queue@index')->name('student.print_queue');
Route::get('/cancel_print','App\Http\Controllers\Print_Queue@cancel_print')->name('student.cancel_print');
