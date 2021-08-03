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
        DB::table('programmes')->insert([
            [
                'programme_name'=>"BASIC TECHNICIAN CERTIFICATE IN CIVIL ENGINEERING",
                'programme_code'=>"BTC",
                'dept_id'=>1,
                
            ],
            [
                'programme_name'=>"ORDINARY DIPLOMA IN CIVIL ENGINEERING",
                'programme_code'=>"OD",
                'dept_id'=>1
            ],
            [
                'programme_name'=>"BASIC TECHNICIAN CERTIFICATE IN MINING",
                'programme_code'=>"BTC",
                'dept_id'=>1
            ],
            [
                'programme_name'=>"BACHELOR DEGREE IN OIL AND GAS",
                'programme_code'=>"OG",
                'dept_id'=>1
            ],
            [
                'programme_name'=>"BACHELOR DEGREE IN CIVIL ENGINEERING",
                'programme_code'=>"CE",
                'dept_id'=>1
            ],
            [
                'programme_name'=>"ORDINARY DIPLOMA IN COMPUTER ENGINEERING",
                'programme_code'=>"OD",
                'dept_id'=>2
            ],
            [
                'programme_name'=>"BACHELOR OF COMPUTER ENGINNERING",
                'programme_code'=>"COE",
                'dept_id'=>2
            ],
            [
                'programme_name'=>"BACHELOR DEGREE IN ELECTRICAL ENGINEERING",
                'programme_code'=>"EE",
                'dept_id'=>3
            ],
            [
                'programme_name'=>"BACHELOR DEGREE IN TELECOMMUNICATION ENGINEERING",
                'programme_code'=>"ETE",
                'dept_id'=>3
            ]
        ]);

        DB::table('subjects')->insert([
            [
                "subject_name" => "Entrepreneurship for Engineers",
                "subject_code" => "GSU 08201",
                "credit_no" => 3,
                "dept_id"=>7,
                "academic_level_id"=>1
            ],
            [   "subject_name" => "Project Realization",
                "subject_code" => "COU 082014",
                "credit_no" => 18,
                "dept_id"=>2,
                "academic_level_id"=>1     
            ],
            [
                "subject_name" => "Wireless Networks",
                "subject_code" => "CSEU 08205",
                "credit_no" => 12,
                "dept_id"=>2,
                "academic_level_id"=>1
            ],
            [
                "subject_name" => "Embedded System Design",
                "subject_code" => "CSEU 08201",
                "credit_no" => 9,
                "dept_id"=>2,
                "academic_level_id"=>1
            ],
            [
                "subject_name" => "High Performance Computing",
                "subject_code" => "CSEU 08202",
                "credit_no" => 9,
                "dept_id"=>2,
                "academic_level_id"=>1
            ],
            [
                "subject_name" => "Industrial Robotics",
                "subject_code" => "CSEU 08203",
                "credit_no" => 12,
                "dept_id"=>2,
                "academic_level_id"=>1
            ],
            [
                "subject_name" => "Algebra",
                "subject_code" => "GST 04101",
                "credit_no" => 6,
                "dept_id"=>7,
                "academic_level_id"=>2
            ],
            [
                "subject_name" => "Communication Skills",
                "subject_code" => "GST 04205",
                "credit_no" => 4,
                "dept_id"=>7,
                "academic_level_id"=>2
            ],
            [
                "subject_name" => "Engineering Study Skills",
                "subject_code" => "GST 06101",
                "credit_no" => 6,
                "dept_id"=>7,
                "academic_level_id"=>2        
            ],
            [
                "subject_name" => "Bridge Design and Construction",
                "subject_code" => "CEU 08101",
                "credit_no" => 9,
                "dept_id"=>1,
                "academic_level_id"=>2         
            ],
            [
                "subject_name" => "Construction Technology Services",
                "subject_code" => "CEU 08102",
                "credit_no" => 12,
                "dept_id"=>1,
                "academic_level_id"=>2           
            ],
            [
                "subject_name" => "Calculus",
                "subject_code" => "GSU 07101",
                "credit_no" => 6,
                "dept_id"=>7,
                "academic_level_id"=>2          
            ],
            [
                "subject_name" => "Oil and Gas Drilling",
                "subject_code" => "CMU 07103",
                "credit_no" => 9,
                "dept_id"=>1,
                "academic_level_id"=>1          
            ],
            [
                "subject_name" => "Petroleum Geosciences",
                "subject_code" => "CMU 07103",
                "credit_no" => 9,
                "dept_id"=>1,
                "academic_level_id"=>1        
            ],
            [
                "subject_name" => "Petrophysics",
                "subject_code" => "CMU 07106",
                "credit_no" => 7,
                "dept_id"=>1,
                "academic_level_id"=>1           
            ],
            [
                "subject_name" => "Fluid Mechanics",
                "subject_code" => "CEU 07211",
                "credit_no" => 6,
                "dept_id"=>1,
                "academic_level_id"=>1         
            ],
            [
                "subject_name" => "Matrial Handilng and Supply",
                "subject_code" => "CMU 0999",
                "credit_no" => 12,
                "dept_id"=>1,
                "academic_level_id"=>1           
            ]    
        ]);

        DB::table('programmes_modules')->insert([
            [
                'subject_id'=>1,
                'programme_id'=>4
            ],
            [
                'subject_id'=>1,
                'programme_id'=>5
            ],
            [
                'subject_id'=>1,
                'programme_id'=>7
            ],
            [
                'subject_id'=>1,
                'programme_id'=>8
            ],
            [
                'subject_id'=>1,
                'programme_id'=>9
            ],
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

        DB::table('lecturer_subjecs')->insert([
            [
                "lecturer_id" => 1,
                "subject_id" => 1
            ],
            [
                "lecturer_id" => 2,
                "subject_id" => 2
            ],
            [
                "lecturer_id" => 3,
                "subject_id" => 3
            ],
            [
                "lecturer_id" => 4,
                "subject_id" => 4
            ],
            [
                "lecturer_id" => 5,
                "subject_id" => 5
            ],
            [
                "lecturer_id" => 6,
                "subject_id" => 6
            ],
            [
                "lecturer_id" => 7,
                "subject_id" => 7
            ],
            [
                "lecturer_id" => 8,
                "subject_id" => 8
            ],
            [
                "lecturer_id" => 1,
                "subject_id" => 9
            ],
            [
                "lecturer_id" => 2,
                "subject_id" => 10
            ],
            [
                "lecturer_id" => 3,
                "subject_id" => 11
            ],
            [
                "lecturer_id" => 4,
                "subject_id" => 12
            ],
            [
                "lecturer_id" => 5,
                "subject_id" => 13
            ],
            [
                "lecturer_id" => 6,
                "subject_id" => 14
            ],
            [
                "lecturer_id" => 7,
                "subject_id" => 15
            ],
            [
                "lecturer_id" => 8,
                "subject_id" => 16
            ],
            [
                "lecturer_id" => 1,
                "subject_id" => 17
            ]
          
          
        ]);
    }
}
