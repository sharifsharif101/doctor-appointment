<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments= Department::get();
        return view('admin.department.index',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.department.create');
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [
            'department' => 'required'
        ]);
        Department::create($request->all());
        return redirect()->back()->with('message', 'Department Created successfully ');

    }

 
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $department = Department::find($id);
        return view('admin.department.edit',compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'department' => 'required'
        ]);
        $department=Department::find($id);
        $department->department = $request->department;
        $department->save();
        return redirect()->route('department.index')->with('message', 'Department Updated successfully ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department=Department::find($id);
        $department->delete();
        return redirect()->route('department.index')->with('message', 'Department Deleted');
    }
}
