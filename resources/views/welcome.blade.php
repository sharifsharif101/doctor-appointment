@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       <div class="row">
            <div class="col-md-6">
                <img src="/banner/online-medicine-concept_160901-152.jpg" class="img-fluid" style="border:1px solid #ccc" alt="">
            </div>
            <div class="col-md-6">
                <h2>Create Account & book Your Appointment</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium nihil pariatur quo necessitatibus quibusdam distinctio, excepturi dolores doloribus quae, sit reprehenderit eveniet ducimus quas! Voluptate aspernatur consequatur quisquam quos consectetur?</p>
                <div class="mt-5">
                    <button class="btn btn-success">Register as Patient</button>
                    <button class="btn btn-secondary">  Login</button>
                </div>
            </div>
       </div>
    </div>
    <hr>
    {{-- serch doctor --}}
    <div class="card">
        <div class="card-body">
            <div class="card-header">Find Doctor</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" name="date" class="form-control" id="datepicker">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary" type="submit">Find Doctor</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- dispaly doctor --}}
    <div class="card">
        <div class="card-body">
            <div class="card-header"> Doctors</div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Expertise</th>
                            <th>Book</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>
                                <img src="/doctor/doctor.png" width="100px" style="border-radius:50%" alt="">
                            </td>
                            <td> 
                                Name of doctor
                            </td>
                            <td>
                                Cardoligest
                            </td>
                            <td> 
                                <button class="btn btn-success">
                                    Book Appointment
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
