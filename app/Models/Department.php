<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table = 'departments';

    protected $fillable = [
        'dept_name'    
    ];
    public function classes()
    {
        return $this->hasMany(Classes::class);
    }
}
