<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Time;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Unique;

class AppointmentController extends Controller
{
    
    public function index()
    {
$myappointments = Appointment::latest()->where('user_id', auth()->user()->id)->get();

         return view('admin.appointment.index',compact('myappointments'));
    }

 
    public function create()
    {
        return view('admin.appointment.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
    'date'=>'required|unique:appointments,date,NULL,id,user_id,'.Auth::id(),
    'time'=>'required',
        ]);
        $appointment = Appointment::create([
            'user_id'=>auth()->user()->id,
            'date'=>$request->date,
        ]);

        foreach ($request->time as $time) {
            Time::create([
                'appointment_id' => $appointment->id,
                'time' => $time,
            ]);
        }
        return redirect()->back()->with('message', 'Appointment created for' . $request->date);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

   
    public function check(Request $request){
        $date = $request->date;
        $appointment = Appointment::where('date', $date)->where('user_id', auth()->user()->id)->first();
            if(!$appointment){
                return redirect()->to('/appointment')->with('errmessage','no Appointment time not available for this date');
            }

        $appointmentId = $appointment->id;
        $times = Time::where('appointment_id', $appointmentId)->get();
        return view('admin.appointment.index', compact('times','appointmentId','date'));
    }

    public function updateTime(Request $request){
      
        $appointmentId = $request->appointmentId;
        $appointment = Time::where('appointment_id', $appointmentId)->delete();
    
        foreach ($request->time as $time) {
            Time::create([
                'appointment_id' =>$appointmentId,
                'time' => $time,
                'status'=>0
            ]);
        }
        return redirect()->route('appointment.index')->with('message', 'Appointment Time updated !!');

    }










}
