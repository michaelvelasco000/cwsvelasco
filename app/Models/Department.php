<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
    protected $table = 'departments';
    protected $fillable = [
        'department_name',
    ];
    public function employees()
    {
        return $this->hasMany(Employees::class);
    }
    public function serviceRecords()
    {
        return $this->hasMany(ServiceRecords::class);
    }
}
