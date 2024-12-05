<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class employees extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = [
        'employee_name',
        'age',
        'gender',
        'department_id',
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
