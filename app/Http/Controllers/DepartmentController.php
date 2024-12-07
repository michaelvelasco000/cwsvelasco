<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Department;
use App\Models\ServiceRecords;

class DepartmentController extends Controller
{
    // go to department list page
    public function DepartmentList(){
        //get all the data of department
        $departments = Department::all();
        return Inertia::render('DepartmentList/Department', ['departments' => $departments]);
    }

    // go to department form
    public function EditDepartment($id){
        // find the specific department for editing the data
        $department = Department::FindOrFail($id);
        // returning the department data to department form
        return Inertia::render('DepartmentList/DepartmentForm', ['department' => $department]);
    }
    
    // store or update department details
    public function Store(Request $request)
    {
        // it will validate the department name and it needs to be unique and required
        $validated = $request->validate([
            'department_name' => 'required|string|max:255|unique:departments,department_name',
        ]);
        
        //if it has id or already save, it means it's for edit and it will update the data
     
        if($request->id){
            $department = Department::findOrFail($request->id);
            $department->department_name =  $validated['department_name'];
            $department->save();
        
        }else{
        //if not it will create new   
            Department::create($validated);
        }
        return redirect('department');   
  
    }

    //delete department
    public function DeleteDepartments($id){
        //The service records will be deleted to avoid error because its connected to department
        ServiceRecords::Where('department_id','=',$id)->delete();
        // deletion of department
        Department::findOrFail($id)->delete();  
    }
}
