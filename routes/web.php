<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ServiceRecordController;
use App\Models\Department;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        $servicerecords = 
        DB::table('service_records')
            ->join('employees', 'service_records.employee_id', '=', 'employees.id')
            ->join('departments', 'service_records.department_id', '=', 'departments.id')
            ->select('service_records.*', 'employees.employee_name', 'departments.department_name')
            ->where('end_date','!=',null)
            ->get();

        return Inertia::render('Dashboard',['servicerecords' => $servicerecords]);
    })->name('dashboard');


    //get all data of empployee
    Route::get('/employee',[EmployeeController::class, 'employeelist'])->name('employee');
    // go to edit/add employee
    Route::get('/editemployee/{id}',[EmployeeController::class, 'editemployee'])->name('editemployee');
    //update employee
    Route::post('/updateemployee',[EmployeeController::class, 'store'])->name('updateemployee');
    //Go to employee form
    Route::get('/employeeform', function () {
        $departments = Department::all();   
        return Inertia::render('EmployeeList/EmployeeForm', ['departments' => $departments]);
    })->name('employeeform');
    //delete employee
    Route::delete('/deleteemployees/{id}',[EmployeeController::class, 'deleteemployees'])->name('deleteemployees');



    //get all data of department
    Route::get('/department',[DepartmentController::class, 'departmentlist'])->name('department');
    //Go to  department form
    Route::get('/departmentform', function () {
            return Inertia::render('DepartmentList/DepartmentForm');
    })->name('departmentform');
    // go to edit department
    Route::get('/editdepartment/{id}',[DepartmentController::class, 'editdepartment'])->name('editdepartment');
     //update or add department
     Route::post('/addupdatedepartment',[DepartmentController::class, 'store'])->name('addupdatedepartment');
     //delete department
     Route::delete('/deletedepartments/{id}',[DepartmentController::class, 'deletedepartments'])->name('deletedepartments');


    //get all data of service record
    Route::get('/servicerecord',[ServiceRecordController::class, 'servicerecordlist'])->name('servicerecord');

    //end service
    Route::get('/endservice/{id}',[ServiceRecordController::class, 'endservice'])->name('endservice');

});
