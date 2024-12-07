<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ServiceRecordController;
use App\Models\Department;
use App\Models\ServiceRecords;

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
        $service_records = 
        ServiceRecords::with(['employee', 'department'])
        ->whereNotNull('end_date')
        ->get();

        return Inertia::render  ('Dashboard',['service_records' => $service_records]);
    })->name('dashboard');


    //get all data of empployee
    Route::get('/employee',[EmployeeController::class, 'EmployeeList'])->name('employee');
    // go to edit/add employee
    Route::get('/edit_employee/{id}',[EmployeeController::class, 'EditEmployee'])->name('edit_employee');
    //update employee
    Route::post('/add_update_employee',[EmployeeController::class, 'Store'])->name('add_update_employee');
    //Go to employee form
    Route::get('/employee_form', function () {
        $departments = Department::all();   
        return Inertia::render('EmployeeList/EmployeeForm', ['departments' => $departments]);
    })->name('employee_form');
    //delete employee
    Route::delete('/delete_employees/{id}',[EmployeeController::class, 'DeleteEmployees'])->name('delete_employees');



    //get all data of department
    Route::get('/department',[DepartmentController::class, 'DepartmentList'])->name('department');
    //Go to  department form
    Route::get('/department_form', function () {
            return Inertia::render('DepartmentList/DepartmentForm');
    })->name('department_form');
    // go to edit department
    Route::get('/edit_department/{id}',[DepartmentController::class, 'EditDepartment'])->name('edit_department');
     //update or add department
     Route::post('/add_update_department',[DepartmentController::class, 'Store'])->name('add_update_department');
     //delete department
     Route::delete('/delete_departments/{id}',[DepartmentController::class, 'DeleteDepartments'])->name('delete_departments');


    //get all data of service record
    Route::get('/service_record',[ServiceRecordController::class, 'ServiceRecordList'])->name('service_record');

    //end service
    Route::get('/end_service/{id}',[ServiceRecordController::class, 'EndService'])->name('end_service');

});
