<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            [
                "dept_name" => "CIVIL ENGINEERING",
                "dept_faculty"=>"DIT",
                "dept_code"=>"CET",
            ],
            [ 
                "dept_name" => "COMPUTER STUDIES",
                "dept_faculty"=>"DIT",
                "dept_code"=>"COE",
            ],
            [
                "dept_name" => "ELECTRICAL ENGINEERING",
                "dept_faculty"=>"DIT",
                "dept_code"=>"EE",
            ],
            [
                "dept_name" => "ELECTRONICS AND TELECOMMUNICATION ENGINEERING",
                "dept_faculty"=>"DIT",
                "dept_code"=>"ETE",
            ],
            [
                "dept_name" => "MECHANICAL ENGINEERING",
                "dept_faculty"=>"DIT",
                "dept_code"=>"ME",
            ],
            [
                "dept_name" => "SCIENCE AND LABORATORY TECHNOLOGY",
                "dept_faculty"=>"DIT",
                "dept_code"=>"LS",
            ],
            [
                "dept_name" => "GENERAL STUDIES",
                "dept_faculty"=>"DIT",
                "dept_code"=>"GST",
            ]
        ]);

        DB::table('semister')->insert([
            [
                "semister_name" => "Semister one",
            ]
          
        ]);
    }
}
