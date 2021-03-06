<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            [
                "subject_name" => "Entrepreneurship for Engineers",
                "subject_code" => "GSU 08201",
                "credit_no" => 3
            ],
            [   "subject_name" => "Project Realization",
                "subject_code" => "COU 082014",
                "credit_no" => 18        
            ],
            [
                "subject_name" => "Wireless Networks",
                "subject_code" => "CSEU 08205",
                "credit_no" => 12
            ],
            [
                "subject_name" => "Embedded System Design",
                "subject_code" => "CSEU 08201",
                "credit_no" => 9
            ],
            [
                "subject_name" => "High Performance Computing",
                "subject_code" => "CSEU 08202",
                "credit_no" => 9
            ],
            [
                "subject_name" => "Industrial Robotics",
                "subject_code" => "CSEU 08203",
                "credit_no" => 12
            ],
            [
                "subject_name" => "Algebra",
                "subject_code" => "GST 04101",
                "credit_no" => 6
            ],
            [
                "subject_name" => "Communication Skills",
                "subject_code" => "GST 04205",
                "credit_no" => 4
            ],
            [
                "subject_name" => "Engineering Study Skills",
                "subject_code" => "GST 06101",
                "credit_no" => 6          
            ],
            [
                "subject_name" => "Bridge Design and Construction",
                "subject_code" => "CEU 08101",
                "credit_no" => 9          
            ],
            [
                "subject_name" => "Construction Technology Services",
                "subject_code" => "CEU 08102",
                "credit_no" => 12           
            ],
            [
                "subject_name" => "Calculus",
                "subject_code" => "GSU 07101",
                "credit_no" => 6           
            ],
            [
                "subject_name" => "Oil and Gas Drilling",
                "subject_code" => "CMU 07103",
                "credit_no" => 9           
            ],
            [
                "subject_name" => "Petroleum Geosciences",
                "subject_code" => "CMU 07103",
                "credit_no" => 9          
            ],
            [
                "subject_name" => "Petrophysics",
                "subject_code" => "CMU 07106",
                "credit_no" => 7           
            ],
            [
                "subject_name" => "Fluid Mechanics",
                "subject_code" => "CEU 07211",
                "credit_no" => 6          
            ],
            [
                "subject_name" => "Matrial Handilng and Supply",
                "subject_code" => "CMU 0999",
                "credit_no" => 12           
            ]    
        ]);

        DB::table('class_subjects')->insert([
            [
                "class_id" => 1,
                "subject_id" => 1
            ],
            [
                "class_id" => 1,
                "subject_id" => 2
            ],
            [
                "class_id" => 1,
                "subject_id" => 3
            ],
            [
                "class_id" => 1,
                "subject_id" => 4
            ],
            [
                "class_id" => 1,
                "subject_id" => 5
            ],
            [
                "class_id" => 1,
                "subject_id" => 6
            ],
            [
                "class_id" => 2,
                "subject_id" => 7
            ],
            [
                "class_id" => 2,
                "subject_id" => 8
            ],
            [
                "class_id" => 2,
                "subject_id" => 9
            ],
            [
                "class_id" => 2,
                "subject_id" => 12
            ],
            [
                "class_id" => 3,
                "subject_id" => 13
            ],
            [
                "class_id" => 3,
                "subject_id" => 14
            ],
            [
                "class_id" => 3,
                "subject_id" => 15
            ],
            [
                "class_id" => 3,
                "subject_id" => 1
            ],
            [
                "class_id" => 4,
                "subject_id" => 10
            ],
            [
                "class_id" => 4,
                "subject_id" => 11
            ],  [
                "class_id" => 4,
                "subject_id" => 7
            ],  [
                "class_id" => 4,
                "subject_id" => 8
            ],
            [
                "class_id" => 4,
                "subject_id" => 9
            ],
            [
                "class_id" => 4,
                "subject_id" => 12
            ],
            [
                "class_id" => 5,
                "subject_id" => 16
            ],
            [
                "class_id" => 5,
                "subject_id" => 17
            ],
            [
                "class_id" => 5,
                "subject_id" => 1
            ],
            [
                "class_id" => 5,
                "subject_id" => 2
            ]
          
        ]);
    }
}
