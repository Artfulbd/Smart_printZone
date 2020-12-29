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

Route::get('/student_landing', function () {
    return view('student.student_landing');
});
Route::get('/', function () {
    return view('student.student_landing');
});



// Student
Route::get('/print_pdf','App\Http\Controllers\PrintPdfController@index')->name('print_pdf');  // Print PDF Page
Route::post('/print_file_cmd','App\Http\Controllers\PrintPdfController@print_file_cmd')->name('print_file_cmd');  // Print File
