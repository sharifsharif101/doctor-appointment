<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\DoctorController;
use  App\Http\Controllers\AppointmentController;
use  App\Http\Controllers\FrontendController;
use  App\Http\Controllers\DashboardController;
use  App\Http\Controllers\ProfileController;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
Route::get('/dashboard',[ DashboardController::class ,'index']);
Route::get('/',[ FrontendController::class ,'index']);


Route::get('/new-appointment/{doctorId}/{date}',[ FrontendController::class ,'show'])->name('create.appointment');
Route::post('/book/appointment',[ FrontendController::class ,'store'])->name('booking.appointment')->middleware('auth');

Route::get('/profile-41',[ ProfileController::class ,'index']);
Route::post('/profile-41', [ProfileController::class, 'store'])->name('profile.store');
Route::post('/profile-41-pic', [ProfileController::class, 'profilePic'])->name('profile.pic');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// }  );

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::resource('doctor', DoctorController::class);
});

Route::group(['middleware' => ['auth', 'doctor']], function () {
    Route::resource('appointment', AppointmentController::class);
    Route::post('/appointment/check', [AppointmentController::class,'check'])->name('appointment.check');
    Route::post('/appointment/update', [AppointmentController::class,'updateTime'])->name('update');
});


 