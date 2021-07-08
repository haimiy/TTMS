<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicLevel extends Model
{
    use HasFactory;
    protected $table = "academic_levels";
    protected $fillable = [
        'academic_level_name',
        'academic_level_code',
    ];
}
