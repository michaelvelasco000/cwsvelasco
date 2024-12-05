<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Models\ServiceRecords;
class ServiceRecordController extends Controller
{

    public function servicerecordlist(){

        $servicerecords = 
        DB::table('service_records')
            ->join('employees', 'service_records.employee_id', '=', 'employees.id')
            ->join('departments', 'service_records.department_id', '=', 'departments.id')
            ->select('service_records.*', 'employees.employee_name', 'departments.department_name')
            ->get();

        return Inertia::render('ServiceRecords/ServiceRecords', ['servicerecords' => $servicerecords]);
    }

    public function insertrecord($employeeid,$olddepid,$newdepid){
       
        $servicerecords = ServiceRecords::Where('employee_id','=',$employeeid)
        ->where('department_id', '=', $olddepid)
        ->limit(1)
        ->get();

        $exist = ServiceRecords::Where('employee_id','=',$employeeid)
        ->where('department_id', '=', $olddepid)
        ->limit(1)
        ->exists();
    //  var_dump(!$exist,$olddepid);
    //  die();
        if($exist && $olddepid != $newdepid){
        if(!$servicerecords->first()->end_date){
            $servicerecords->first()->end_date = date('Y-m-d');
           $servicerecords->first()->save();
        }
        $records =([
                    'employee_id'=>$employeeid,
                    'department_id'=>$newdepid,
                    'start_date'=>date('Y-m-d')]);
        ServiceRecords::create($records);
            

        }elseif(!$exist){
            $records =([
            'employee_id'=>$employeeid,
            'department_id'=>$olddepid,
            'start_date'=>date('Y-m-d')]);
            ServiceRecords::create($records);
        }else{
            $records =([
                'employee_id'=>$employeeid,
                'department_id'=>$olddepid,
                'start_date'=>date('Y-m-d')]);
                ServiceRecords::create($records);
        }
    }

    public function endservice($id){
        $servicerecords = ServiceRecords::findOrFail($id);
        $servicerecords->end_date = date('Y-m-d');
        $servicerecords->save(); 

    }
}
