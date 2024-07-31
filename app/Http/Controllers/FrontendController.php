<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Time;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
   public function index(){
    date_default_timezone_set('Asia/Riyadh');
    $doctor = Appointment::where('date', date('Y-m-d'))->get();
        return view('welcome',compact('doctor'));
   }






















}
