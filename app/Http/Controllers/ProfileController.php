<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
   public function index(){
      
        return view('profile.index');
   }
   public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'gender' => 'required'
        ]);
        User::where('id', auth()->user()->id)
            ->update($request->except('_token'));
        return redirect()->back()->with('message', 'Profile Updated');
   }

   public function profilePic(Request $request){
      
    $this->validate($request, [
        'file' => 'required|image|mimes:jpeg,png,jpg',]);
    if($request->hasFile('file')){
            $image = $request->file('file');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destination = public_path('/profile');
            $image->move($destination, $name);
            User::where('id', auth()->user()->id)->update(['image' => $name]);
            return redirect()->back()->with('message', 'Profile Updated');

    }
}





}
