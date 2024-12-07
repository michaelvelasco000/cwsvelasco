<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employees extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = [
        'employee_name',
        'age',
        'gender',
        'department_id',
    ];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function serviceRecords()
    {
        return $this->hasMany(ServiceRecords::class);
    }
}
