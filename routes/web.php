<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\Patient;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
  //  return view('welcome');
//});

Route::get('/', function () {
    return view('main');
});


Route::get('/dashboard', function () {
return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/doctorlisting', [DoctorController::class, 'index'])->middleware(['auth', 'verified'])->name('doctorlisting');
Route::get('/dedit/{id}',[DoctorController::class,'edit'])->middleware(['auth', 'verified'])->name('doctors.edit');
Route::put('/dedit/{id}',[DoctorController::class,'update'])->middleware(['auth', 'verified'])->name('doctors.update');
Route::get('/ddelete/{id}',[DoctorController::class,'destroy'])->middleware(['auth', 'verified'])->name('doctors.delete');

Route::get('/patientlisting', [PatientController::class, 'index'])->middleware(['auth', 'verified'])->name('patientlisting');
Route::get('/pedit/{id}',[PatientController::class,'edit'])->middleware(['auth', 'verified'])->name('patients.edit');
Route::put('/pedit/{id}',[PatientController::class,'update'])->middleware(['auth', 'verified'])->name('patients.update');
Route::get('/pdelete/{id}',[PatientController::class,'destroy'])->middleware(['auth', 'verified'])->name('patients.delete');
Route::get('/doctors/search', [DoctorController::class, 'search'])->middleware(['auth', 'verified'])->name('doctors.search');

Route::get('/appointments/create', [AppointmentController::class, 'create'])->middleware(['auth', 'verified'])->name('appointments.create');
Route::post('/appointments/store', [AppointmentController::class, 'store'])->middleware(['auth', 'verified'])->name('appointments.store');
Route::get('/appointmentlisting', [AppointmentController::class, 'index'])->middleware(['auth', 'verified'])->name('appointmentlisting');
Route::patch('/appointments/{id}/approve', [AppointmentController::class, 'approve'])->middleware(['auth', 'verified'])->name('appointments.approve');
Route::patch('/appointments/{id}/cancel', [AppointmentController::class, 'cancel'])->middleware(['auth', 'verified'])->name('appointments.cancel');
Route::get('/appointments/{id}/sendemail', [AppointmentController::class, 'sendemail'])->middleware(['auth', 'verified'])->name('appointments.sendemail');
Route::get('/appointmentdelete/{id}',[AppointmentController::class,'destroy'])->middleware(['auth', 'verified'])->name('appointments.delete');

Route::get('/registerdoctor/create', [RegisteredUserController::class, 'createdoctor'])->name('registerdoctor.create');
Route::post('/registerdoctor/store', [RegisteredUserController::class, 'storedoctor'])->name('registerdoctor.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

