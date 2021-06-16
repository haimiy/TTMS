<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $table = "classes";

    protected $fillable = [
        'class_name',
        'class_size',
        'dept_id'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class,'dept_id');
    }
}
