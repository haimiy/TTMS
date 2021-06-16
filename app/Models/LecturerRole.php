<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LecturerRole extends Model
{
    use HasFactory;
    protected $table = "lecturers_roles";
    public function lecturer()
    {
        return $this->hasMany(Lecturer::class);
    }
}
