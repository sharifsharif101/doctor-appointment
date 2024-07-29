<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DoctorController extends Controller
{

    public function index()
    {
        dd(Auth::user()->role->name);
        $users = User::where('role_id', '!=', 3)->get();
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
        $data = $request->all();
        $name = (new User)->userAvatar($request);
        $data['image'] = $name; 
        $data['password'] = bcrypt($request->password);
        User::create($data);
        return redirect()->back()->with('message', 'Doctor added successfully ');
    }

    public function show(string $id)
    {
        $user = User::find($id);
        return view('admin.doctor.delete',compact('user'));
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
        $imageName = $user->image; // ole one
        $userPassword = $user->password; // old one
        if($request->hasFile('image')){
            $imageName  = (new User)->userAvatar($request);
            unlink(public_path('images/' . $user->image));
        }
        $date['image'] = $imageName;
        if($request->password){
            $date['password'] = bcrypt($request->password);
        }else{
            $date['password'] = $userPassword;
        }
        $user->update($date);
        return redirect()->route('doctor.index')->with('message', 'Doctor updated successfully');
    }


    public function destroy(string $id)
    {
        if(auth()->user()->id == $id){
            abort(401);
        }
        $user = User::find($id);
        $userDelete = $user->delete();
        if( $userDelete){
            unlink(public_path('images/' . $user->image));
        }
        return redirect()->route('doctor.index')->with('message', 'Doctor Deleted successfully');
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
