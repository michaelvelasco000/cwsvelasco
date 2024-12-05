<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Department;
use App\Models\ServiceRecords;

class DepartmentController extends Controller
{
    public function departmentlist(){
        $departments = Department::all();
        return Inertia::render('DepartmentList/Department', ['departments' => $departments]);
    }

    public function editdepartment($id){
        // var_dump( $id);  
        $department = Department::FindOrFail( $id);
        
        return Inertia::render('DepartmentList/DepartmentForm', ['department' => $department]);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_name' => 'required|string|max:255|unique:departments,department_name',
        ]);
        
        if($request->id){
            $department = Department::findOrFail($request->id);
            $department->department_name =  $validated['department_name'];
            $department->save();
        
        }else{
        
            Department::create($validated);
        }
        return redirect('department');   
  
    }

    public function deletedepartments($id){
        ServiceRecords::Where('department_id','=',$id)->delete();
        Department::findOrFail($id)->delete();  
    }
}
