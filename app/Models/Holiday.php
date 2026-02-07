<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'date', 'admin_id'];

    protected $casts = [
        'date' => 'date',
    ];

    public function admin()
{
    return $this->belongsTo(Admin::class);
}

}
