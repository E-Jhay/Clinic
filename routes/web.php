<?php

use App\Models\Patient;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BotManController;

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

Route::middleware(['auth'])->group(function (){
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

    Route::view('/medical-services-monthly-report', 'medical-services-reports.medical-services-monthly-report')->name('medical-services-monthly-report');
    Route::view('/medical-services-quarterly-report', 'medical-services-reports.medical-services-quarterly-report')->name('medical-services-quarterly-report');
    Route::view('/medical-services-anually-report', 'medical-services-reports.medical-services-anually-report')->name('medical-services-anually-report');

    Route::view('/medical-illness-monthly-report', 'medical-illness-reports.medical-illness-monthly-report')->name('medical-illness-monthly-report');
    Route::view('/medical-illness-quarterly-report', 'medical-illness-reports.medical-illness-quarterly-report')->name('medical-illness-quarterly-report');
    Route::view('/medical-illness-anually-report', 'medical-illness-reports.medical-illness-anually-report')->name('medical-illness-anually-report');

    Route::view('/expired-medicine-monthly-report', 'expired-medicine-reports.expired-medicine-monthly-report')->name('expired-medicine-monthly-report');
    Route::view('/expired-medicine-quarterly-report', 'expired-medicine-reports.expired-medicine-quarterly-report')->name('expired-medicine-quarterly-report');
    Route::view('/expired-medicine-anually-report', 'expired-medicine-reports.expired-medicine-anually-report')->name('expired-medicine-anually-report');

    Route::view('/bmi', 'bmi.faculty')->name('bmi');
    Route::get('/faculty-bmi/{first_name}/{id}/', function ($from_first_name, $from_id){
        // $patientRecords = Patient::where('name', $name)->get();
        return view('bmi.view-bmi', compact('from_first_name', 'from_id'));
    })->name('view-bmi');
    
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

});
Auth::routes();

Route::match(['get', 'post'], 'botman', 'App\Http\Controllers\BotmanController@handle');
