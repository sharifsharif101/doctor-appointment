<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Prescription;
class PrescriptionController extends Controller
{
    public function index(){
        date_default_timezone_set('Asia/Riyadh');
        $bookings = Booking::where('date', date('Y-m-d'))->where('status', 1)->where('doctor_id', auth()->user()->id)->get();
        return view('prescription.index',compact('bookings'));
    }
    public function store(Request $request){
        $date = $request->all();
        $date['medicine'] = implode(',', $request->medicine);
        Prescription::create($date);
        return redirect()->back()->with('message', 'prescription Created ');
    }
}
