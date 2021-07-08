<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AcademicIssue extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('academic_levels')->insert([
            [
                "academic_level_name" => "Bachelor of Engineering Degree",
                "academic_level_code" => "BENG"
            ],
            [
                "academic_level_name" => "Ordinary Diploma",
                "academic_level_code" => "OD"  
            ],
            [
                "academic_level_name" => "General Course",
                "academic_level_code" => "GC" 
            ]
            
        ]);

        DB::table('academic_years')->insert([
            [
                "year_name" => "2018/2019",
                "start_date" => "2018-01-06",
                "end_date" => "2021-07-07"
            ],
            [
                "year_name" => "2019/2020",
                "start_date" => "2019-01-07",
                "end_date" => "2022-07-05" 
            ],
            [
                "year_name" => "2020/2021",
                "start_date" => "2020-01-09",
                "end_date" => "2023-06-07" 
            ]    
        ]);
        DB::table('nta_levels')->insert([
            [
                "nta_level_name" => "NTA level 6",
                "no_of_years" => 3,
                "academic_level_id" => 2
            ],
            [
                "nta_level_name" => "NTA level 8",
                "no_of_years" => 3,
                "academic_level_id" => 1
            ]    
        ]);
    }
}
