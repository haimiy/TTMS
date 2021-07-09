<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;
    protected $table = "programmes";
    protected $fillable = [
        'programme_name',
        'programme_code',
        'dept_id',
    ];
}
