<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'department',
        'office_phone',
        'user_id',
    ];

    /**
     * Get the user that owns the admin.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function holidays()
{
    return $this->hasMany(Holiday::class);
}

 public function leaves()
    {
        return $this->hasMany(Leave::class, 'admin_id');
    }
}
