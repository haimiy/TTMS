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
            ],
            [ 
                "dept_name" => "COMPUTER STUDIES",
            ],
            [
                "dept_name" => "ELECTRICAL ENGINEERING",
            ],
            [
                "dept_name" => "ELECTRONICS AND TELECOMMUNICATION ENGINEERING",
            ],
            [
                "dept_name" => "MECHANICAL ENGINEERING",
            ],
            [
                "dept_name" => "SCIENCE AND LABORATORY TECHNOLOGY",
            ],
            [
                "dept_name" => "GENERAL STUDIES",
            ]
        ]);

        DB::table('semister')->insert([
            [
                "semister_name" => "Semister one",
            ],
            [ 
                "semister_name" => "Semister two",
            ],
            [
                "semister_name" => "Semister three",
            ]
        ]);
    }
}
