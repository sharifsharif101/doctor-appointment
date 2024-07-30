<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\DoctorController;
use  App\Http\Controllers\AppointmentController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
}  );

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::resource('doctor', DoctorController::class);
});

Route::resource('appointment', AppointmentController::class);
Route::post('/appointment/check', [AppointmentController::class,'check'])->name('appointment.check');
// Route::get('/test', function () {
//     return view('test');
// }  );
