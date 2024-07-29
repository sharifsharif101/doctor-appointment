<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{

    public function index()
    {
        $users = User::get();
        return view('admin.doctor.index',compact('users'));
    }

   
    public function create()
    {
        return view('admin.doctor.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $this->validateStore($request);    
        // Debug request data
        // Get all request data
        $data = $request->all();
        // Check if image is uploaded
        $image = $request->file('image');
        if ($image) {
            // Generate a hashed name for the image
            $name = $image->hashName();
            // Define the destination path
            $destination = public_path('/images');
            // Move the image to the destination
            $image->move($destination, $name);
            // Add the image name to the data array
            $data['image'] = $name;
        }
        // Encrypt the password before storing
        $data['password'] = bcrypt($request->password);
        // Create the user with the provided data
        User::create($data);
        return redirect()->back()->with('message', 'Doctor added successfully ');
    }

    public function show(string $id)
    {
        return "sdbsssssssssvsdv";
    }

    public function edit(string $id)
    {
        $user = User::find($id);
        // dd($user);
        return view('admin.doctor.edit',compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $this->validateUpdate($request,$id);
        $date = $request->all();
        $user = User::find($id);
        $imageName = $user->image;
        $userPassword = $user->password;
     
        if($request->hasFile('image')){
            $image = $request->file('image');
            $name = $image->hashName();
            $destination = public_path('/images');
            $image->move($destination, $name);
            $data['image'] = $name;
        }





    }


    public function destroy(string $id)
    {
        //
    }

    public function validateStore($request){
       return $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:3|max:25',
            'gender' => 'required|string|in:male,female',
            'education' => 'required|string|max:255',
            'address' => 'required',
            // 'department' => 'required|string|max:255',
            'phone_number' => 'required|numeric',
            'image' => 'required|mimes:jpeg,jpg,png|max:2048', // Adding a max size limit of 2MB
            'description' => 'required|string',
            'role_id' => 'required',
        ]);
    }


    public function validateUpdate($request ,$id){
        return $this->validate($request, [
             'name' => 'required|string|max:255',
             'email' => 'required|email|unique:users,email,'.$id,
             'gender' => 'required|string|in:male,female',
             'education' => 'required|string|max:255',
             'address' => 'required',
             // 'department' => 'required|string|max:255',
             'phone_number' => 'required|numeric',
             'image' => 'mimes:jpeg,jpg,png',  
             'description' => 'required|string',
             'role_id' => 'required',
         ]);
     }



}
