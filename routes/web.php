<?php

use App\Models\Patient;
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
    return view('welcome');
});

Route::view('/health-profile', 'medical-records.health-profile')->name('health-profile');
Route::view('/medicine', 'inventory.medicine')->name('medicine');
Route::view('/supply', 'inventory.supply')->name('supply');
Route::view('/equipment', 'inventory.equipment')->name('equipment');
Route::view('/daily-treatment-record', 'medical-records.daily-treatment-record')->name('daily-treatment-record');
Route::view('/patient-records', 'medical-records.patient-crud')->name('patient-records');
// Route::view('/patient-record/{name}', 'medical-records.view-patient')->name('patient-record');
Route::get('/patient-record/{name}/{designation_id}/', function ($name, $from_designation_id){
    // $patientRecords = Patient::where('name', $name)->get();
    return view('medical-records.view-patient', compact('name', 'from_designation_id'));
})->name('patient-record');

Route::view('/medicine-monthly-report', 'medicine-reports.medicine-monthly-report')->name('medicine-monthly-report');
Route::view('/medicine-quarterly-report', 'medicine-reports.medicine-quarterly-report')->name('medicine-quarterly-report');
Route::view('/medicine-anually-report', 'medicine-reports.medicine-anually-report')->name('medicine-anually-report');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
