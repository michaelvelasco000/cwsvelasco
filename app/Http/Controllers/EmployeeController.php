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
    //go to employee list
    public function EmployeeList(){
        // getting all the employee along with their department
        $employees = Employees::with('department')->get();

        return Inertia::render('EmployeeList/Employee', ['employees' => $employees]);
    }

    //go to employee form
    public function EditEmployee($id){  

        // find the employee details for edit
        $employee = Employees::FindOrFail( $id);

        // getting all the department list for the dropdown
        $departments = Department::all();   

        return Inertia::render('EmployeeList/EmployeeForm', ['employee' => $employee,'departments' => $departments]);
    }
    
    public function Store(Request $request)
    {
        // validate employee details
        $validated = $request->validate([
            'employee_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required|string|max:50',
            'department_id' => 'required|integer',
        ]);

        // get the function to other controller
        $controller = new ServiceRecordController();

        // check if it is edit or new data
        if($request->id){
            $employee = Employees::findOrFail($request->id);
            if($employee ){
                // pass the employee details to service record 
                $controller->InsertRecord($request->id, $employee->department_id,$validated['department_id']);
            }   
            //update the data
            $employee->employee_name = $validated['employee_name'];
            $employee->age = $validated['age'];
            $employee->gender = $validated['gender'];
            $employee->department_id = $validated['department_id'];
            $employee->save();
           
        }else{
            //if no data create new employee
            $employee = Employees::create($validated);

            if($employee ){
                // pass the employee details to service record
                $controller->insertrecord($employee->id,$employee->department_id,$validated['department_id']);
            }

        }
        
        return redirect('employee');   
  
    }
    public function DeleteEmployees($id){
        //The service records will be deleted to avoid error because its connected to employee
        ServiceRecords::Where('employee_id','=',$id)->delete();
         // deletion of employee
        Employees::findOrFail($id)->delete();
    }
}
