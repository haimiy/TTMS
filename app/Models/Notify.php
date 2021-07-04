<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    use HasFactory;
    protected $table = 'notify';
    protected $fillable = [
        'lecturer_id',
        'message',
        'status',
        'class_id',
        'created_at'
    ];
}
