<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceRecords extends Model
{
    use HasFactory;
    protected $table = 'service_records';
    protected $fillable = [
        'employee_id',
        'department_id',
        'start_date',
        'end_date',
    ];
    public function employee()
    {
        return $this->belongsTo(Employees::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
