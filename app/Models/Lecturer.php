<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'lecturer_role_id',
        'dept_id'
    ];

    public function lecturer_role()
    {
        return $this->belongsTo(LecturerRole::class,'lecturer_role_id');
    }
}
