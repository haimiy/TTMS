<?php

namespace App\Imports;

use App\Models\Classes;
use Maatwebsite\Excel\Concerns\ToModel;

class ClassesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Classes([
            'class_name' => $row[1],
            'class_code' => $row[2],
            'class_size' => $row[3], 
            'academic_year_id'=>$row[4], 
            'academic_level_id' =>$row[5],
            'programme_id' =>$row[6],
            'dept_id' => $row[7],
        ]);
    }
}
