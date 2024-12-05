<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Employees;
use App\Models\Department;
use App\Http\Controllers\ServiceRecordController;
use App\Models\ServiceRecords;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\DB;
class EmployeeController extends Controller
{
    public function employeelist(){
        $employees = DB::table('employees')
        ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
        ->select('employees.*', 'departments.department_name')
        ->get();
    
        return Inertia::render('EmployeeList/Employee', ['employees' => $employees]);
    }

    public function editemployee($id){
        // var_dump( $id);  
        $employee = Employees::FindOrFail( $id);
        $departments = Department::all();   
        return Inertia::render('EmployeeList/EmployeeForm', ['employee' => $employee,'departments' => $departments]);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required|string|max:50',
            'department_id' => 'required|integer',
        ]);

        // get the function to other controller
        $controller = new ServiceRecordController();

        if($request->id){
            $employee = Employees::findOrFail($request->id);
            if($employee ){
                $controller->insertrecord($request->id, $employee->department_id,$validated['department_id']);
            }  
           

            $employee->employee_name = $validated['employee_name'];
            $employee->age = $validated['age'];
            $employee->gender = $validated['gender'];
            $employee->department_id = $validated['department_id'];
            $employee->save();
           
        }else{
            $employee = Employees::create($validated);

            if($employee ){
                $controller->insertrecord($employee->id,$employee->department_id,'');
            }

        }
        
        return redirect('employee');   
  
    }
    public function deleteemployees($id){
        ServiceRecords::Where('employee_id','=',$id)->delete();
        Employees::findOrFail($id)->delete();
    }
}
