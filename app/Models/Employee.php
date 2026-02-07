<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_code',
        'name',
        'designation',
        'email',
        'phone',
        'location',
        'experience',
        'joining_date',
        'user_id',
    ];

    /**
     * Get the user that owns the employee.
     */
   public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function leaves()
{
    return $this->hasMany(Leave::class, 'employee_id');
}

}
