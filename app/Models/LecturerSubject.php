<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LecturerSubject extends Model
{
    use HasFactory;
    protected $table = 'lecturer_subjecs';

    protected $fillable = [
        'lecturer_id',
        'subject_id',
    ];
}
