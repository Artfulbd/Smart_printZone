<?php

use App\Http\Controllers\Admin\PrinterDetailsController;
use App\Http\Controllers\Admin\PrintQueueController;
use App\Http\Controllers\Admin\ZoneController;
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

Route::GET('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::GET('/home', 'App\Http\Controllers\Student\StudentDashBoardController@index')->name('student.dashboard')->middleware('auth');


// Student
Route::GET('/student_landing','App\Http\Controllers\Student\StudentDashBoardController@index')->name('student.dashboard')->middleware('auth');



// Student Print
Route::GET('/print_pdf','App\Http\Controllers\Student\PrintPdfController@index')->name('print_pdf');  // Print PDF Page
Route::post('/print_file_cmd','App\Http\Controllers\Student\PrintPdfController@print_file_cmd')->name('print_file_cmd');  // Print File


// Student Print Queue
Route::GET('/print_queue','App\Http\Controllers\Student\Print_Queue@index')->name('student.print_queue');
Route::post('/cancel_print','App\Http\Controllers\Student\Print_Queue@cancel_print')->name('student.cancel_print');




// Admin
Route::GET('/admin_landing','App\Http\Controllers\Admin\AdminDashBoardController@admin_dashboard')->name('admin.dashboard')->middleware('auth');


// Admin Print System
Route::GET('/on_off_system','App\Http\Controllers\Admin\PrintSystemController@index')->name('admin.on_off_system')->middleware('auth');
Route::post('/on_off_action','App\Http\Controllers\Admin\PrintSystemController@on_off_action')->name('admin.on_off_action')->middleware('auth');


// Admin Print Setting
Route::GET('/view_print_setting','App\Http\Controllers\Admin\PrintSystemController@view_print_setting')->name('admin.view_print_setting')->middleware('auth');
Route::post('/create_print_setting','App\Http\Controllers\Admin\PrintSystemController@create_print_setting')->name('admin.create_print_setting')->middleware('auth');
Route::post('/edit_print_setting','App\Http\Controllers\Admin\PrintSystemController@edit_print_setting')->name('admin.edit_print_setting')->middleware('auth');
Route::post('/delete_print_setting','App\Http\Controllers\Admin\PrintSystemController@delete_print_setting')->name('admin.delete_print_setting')->middleware('auth');


// Admin Manage
Route::GET('/view_manage_admin','App\Http\Controllers\Admin\ManageAdminController@index')->name('admin.view_manage_admin')->middleware('auth');
Route::POST('/create_admin','App\Http\Controllers\Admin\ManageAdminController@create_admin')->name('admin.create_admin')->middleware('auth');
Route::POST('/edit_admin','App\Http\Controllers\Admin\ManageAdminController@edit_admin')->name('admin.edit_admin')->middleware('auth');
Route::POST('/delete_admin','App\Http\Controllers\Admin\ManageAdminController@delete_admin')->name('admin.delete_admin')->middleware('auth');


// Manage Student
Route::GET('/goto_search_student_page','App\Http\Controllers\Admin\ManageStudentController@goto_search_student_page')->name('admin.goto_search_student_page')->middleware('auth');  // Goto load Page for Student
Route::POST('/search_student_post','App\Http\Controllers\Admin\ManageStudentController@search_student_post')->name('admin.search_student_post')->middleware('auth');  // Search Student for POST
Route::GET('/search_student_get/{nsu_id}','App\Http\Controllers\Admin\ManageStudentController@search_student_get')->name('admin.search_student_get')->middleware('auth');  // Search Student for POST
Route::POST('/increase_page_amount','App\Http\Controllers\Admin\ManageStudentController@increase_page_amount')->name('admin.increase_page_amount')->middleware('auth');  // Increase Page Amount
Route::POST('/edit_student_information','App\Http\Controllers\Admin\ManageStudentController@edit_student_information')->name('admin.edit_student_information')->middleware('auth');  // Increase Page Amount



// Manage Zone
Route::GET('/view_zones', [ZoneController::class, 'view_zones'])->name('admin.view_zones')->middleware('auth');
Route::POST('/create_zone', [ZoneController::class, 'create_zone'])->name('admin.create_zone')->middleware('auth');
Route::POST('/edit_zone', [ZoneController::class, 'edit_zone'])->name('admin.edit_zone')->middleware('auth');
Route::POST('/delete_zone', [ZoneController::class, 'delete_zone'])->name('admin.delete_zone')->middleware('auth');


// Manage Printer Details
Route::GET('/view_printer_details', [PrinterDetailsController::class, 'view_printer_details'])->name('admin.view_printer_details')->middleware('auth');
Route::POST('/create_printer_details', [PrinterDetailsController::class, 'create_printer_details'])->name('admin.create_printer_details')->middleware('auth');
Route::POST('/edit_printer_details', [PrinterDetailsController::class, 'edit_printer_details'])->name('admin.edit_printer_details')->middleware('auth');
Route::POST('/delete_printer_details', [PrinterDetailsController::class, 'delete_printer_details'])->name('admin.delete_printer_details')->middleware('auth');



// Card Punched Print Queue
Route::GET('/view_card_punched_print_queue', [PrintQueueController::class, 'view_card_punched_print_queue'])->name('admin.view_card_punched_print_queue')->middleware('auth');
Route::POST('/abort_from_card_punched_print_queue', [PrintQueueController::class, 'abort_from_card_punched_print_queue'])->name('admin.abort_from_card_punched_print_queue')->middleware('auth');


// Current Status print queue
Route::GET('/view_current_status_print_queue', [PrintQueueController::class, 'view_current_status_print_queue'])->name('admin.view_current_status_print_queue')->middleware('auth');
Route::GET('/get_current_status_print_queue_data', [PrintQueueController::class, 'get_current_status_print_queue_data'])->name('admin.get_current_status_print_queue_data');
Route::GET('/abort_from_current_status_print_queue/{u_id}', [PrintQueueController::class, 'abort_from_current_status_print_queue'])->name('admin.abort_from_current_status_print_queue');
