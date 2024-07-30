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
         return view('admin.appointment.index');
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function check(Request $request){
        dd("okkkkkk");
    }










}
