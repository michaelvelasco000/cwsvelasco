<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Models\ServiceRecords;
class ServiceRecordController extends Controller
{
    //go to service record list
    public function ServiceRecordList(){
     // getting all the service records along with their department and employee details
        $service_records = 
        ServiceRecords::with(['employee', 'department'])
                        ->whereHas('employee')
                        ->whereHas('department')
                        ->get();
        return Inertia::render('ServiceRecords/ServiceRecords', ['service_records' => $service_records]);
    }

    public function InsertRecord($employeeid,$olddepid,$newdepid){
       // check the records of the employee and the connected department
            $service_records = ServiceRecords::Where('employee_id','=',$employeeid)
            ->where('department_id', '=', $olddepid)
            ->limit(1)
            ->get();

        //check if the data is exist
            $exist = ServiceRecords::Where('employee_id','=',$employeeid)
            ->where('department_id', '=', $olddepid)
            ->limit(1)
            ->exists();
 
        // check if the employee data is change the department meaning it will end the service records to previous department
        if($exist && $olddepid != $newdepid){

            //check if its no end date to service record and it will add the end date of service record
            if(!$service_records->first()->end_date){
                $service_records->first()->end_date = date('Y-m-d');
                $service_records->first()->save();
            }
            //create new records for new depart,emt
            $records =([
                        'employee_id'=>$employeeid,
                        'department_id'=>$newdepid,
                        'start_date'=>date('Y-m-d')
                        ]);
            ServiceRecords::create($records);
    
        }elseif(!$exist){
            // if no service create new
            $records =([
            'employee_id'=>$employeeid,
            'department_id'=>$newdepid,
            'start_date'=>date('Y-m-d')]);
            ServiceRecords::create($records);

        }elseif($olddepid != $newdepid){
            //special case if the the department deleted it will create new service record when edit the employee details
            $records =([
                'employee_id'=>$employeeid,
                'department_id'=>$newdepid,
                'start_date'=>date('Y-m-d')]);
                ServiceRecords::create($records);
        }
    }

    public function EndService($id){
        // find the service records and update the end date
        $servicerecords = ServiceRecords::findOrFail($id);
        $servicerecords->end_date = date('Y-m-d');
        $servicerecords->save(); 

    }
}
