<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class leave extends Model
{ 
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'admin_id',
        'leave_type',
        'remaining_leave',
        'date_from',
        'date_to',
        'number_of_day',
        'leave_day',
        'reason',  
         'status',
    ];

     public function employee()
    {
        return $this->belongsTo(Employee::class);
    }


public function admin()
{
    return $this->belongsTo(User::class, 'admin_id');
}
    
    
}
