<?php

namespace App\Http\Controllers;

use App\Models\Department;

use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use App\Models\User;

class DepartmentController extends Controller
{
    // Display a listing of the departments.
    public function index()
    {
        $models = Department::all(); // Fetch all departments
        return view('backend.website.primary_setting.department.index', compact('models')); // Passing data to view
    }

    // Show the form for creating a new department.
    public function create()
    {
//        $users = User::pluck('name', 'id');
        return view('backend.website.primary_setting.department.create'); // Load create form
    }

    // Store a newly created department in the database.
    public function store(DepartmentRequest $request)
    {
        $model = new Department();
        $model->title = $request->title;
        $model->code = $request->code;
        $model->save();
        return redirect()->route('department.index');

    }

    // Show the form for editing the specified department.
    public function edit($id)
    {
        $model = Department::find($id);
        return view('backend.website.primary_setting.department.edit', compact('model'));

    }

    // Update the specified department in the database.
    public function update(DepartmentUpdateRequest $request, $id)
{
        $model = Department::find($id);
        $model->title = $request->title;
        $model->code = $request->code;
        $model->save();
        return redirect()->route('department.index')->with('success', 'Department updated successfully!');
    }

    // Remove the specified department from the database.
    public function delete($id)
    {
        $model = Department::find($id);
        $model->delete();
        return redirect()->route('department.index')->with('success', 'Department deleted successfully!');
    }
}
