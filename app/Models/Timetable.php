<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;
    protected $fillable = [
        'day_id',
        'slots_id',
        'room_id',
        'subject_id',
        'semister_id',
    ];
    
}