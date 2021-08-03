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
                "class_name" => "BEING18-COE",
                "class_code" => "BEING18-COE",
                "academic_year_id" => 1,
                "academic_level_id" => 1,
                "programme_id"=>7,
                "class_size" => 49,
                "dept_id" => 2,
                "session" =>1
            ],
            [
                "class_name" => "OD18-COE",
                "class_code" => "OD18-COE",
                "academic_year_id" => 1,
                "academic_level_id" => 2,
                "programme_id"=>6,
                "class_size" => 33,
                "dept_id" => 2,
                "session" =>1
            ],
            [
                "class_name" => "BEING18-OIL&GAS",
                "class_code" => "BEING18-OIL&GAS",
                "academic_year_id" => 1,
                "academic_level_id" => 1,
                "programme_id"=>4,
                "class_size" => 26,
                "dept_id" => 1,
                "session" =>1
            ],
            [
                "class_name" => "0D19-CIVIL",
                "class_code" => "0D19-CIVIL",
                "academic_year_id" => 1,
                "academic_level_id" => 2,
                "programme_id"=>2,
                "class_size" => 100,
                "dept_id" => 1,
                "session" =>1
            ],
            [
                "class_name" => "BEING18-TET",
                "class_code" => "BEING18-TET",
                "academic_year_id" => 1,
                "academic_level_id" => 1,
                "programme_id"=>9,
                "class_size" => 50,
                "dept_id" => 4,
                "session" =>1
            ]
        ]);
    }
}
