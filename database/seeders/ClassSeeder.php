<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->insert([
            [
                "class_name" => "BEING18_COMP",
                "academic_year_id" => 1,
                "academic_level_id" => 1,
                "class_size" => 49,
                "dept_id" => 3
            ],
            [ 
                "class_name" => "OD18_COMP",
                "academic_year_id" => 1,
                "academic_level_id" => 2,
                "class_size" => 33,
                "dept_id" => 2
            ],
            [
                "class_name" => "BEING18_OIL&GAS",
                "academic_year_id" => 1,
                "academic_level_id" => 1,
                "class_size" => 26,
                "dept_id" => 1
            ],
            [
                "class_name" => "0D19_CIVIL",
                "academic_year_id" => 1,
                "academic_level_id" => 2,
                "class_size" => 100,
                "dept_id" => 1
            ],
            [
                "class_name" => "BEING18_TET",
                "academic_year_id" => 1,
                "academic_level_id" => 1,
                "class_size" => 50,
                "dept_id" => 4
            ]
        ]);
    }
}
