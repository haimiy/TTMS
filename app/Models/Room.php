<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable =[
        'room_name',
        'room_capacity',
        'room_no',
        'floor_name',
        'block_id',
    ];
}
