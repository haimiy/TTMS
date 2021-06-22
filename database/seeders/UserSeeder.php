<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                "first_name" => "khairat",
                "middle_name" => "Makame",
                "last_name" => "Issa",
                "login_id" => "admin",
                "password" => Hash::make("1234"),
                "role_id" => 1,
                "email" => "khairat@gmail.com",
                "phone_no" => "0772674900",
                "dob" => "10/12/1996",
                "gender" => "Female",
                "image" => "assets/images/admin1.jpeg"
            ],
            [
                "first_name" => "gift",
                "middle_name" => "Isack",
                "last_name" => "Msigwa",
                "login_id" => "master",
                "password" => Hash::make("1234"),
                "role_id" => 2,
                "email" => "gisacc@gmail.com",
                "phone_no" => "065888932",
                "dob" => "18/06/1996",
                "gender" => "male",
                "image" => "assets/images/user2.jpeg"
            ],
            [
                "first_name" => "asha",
                "middle_name" => "Hamad",
                "last_name" => "Salum",
                "login_id" => "cordinator",
                "password" => Hash::make("1234"),
                "role_id" => 2,
                "email" => "asha@gmail.com",
                "phone_no" => "0625888932",
                "dob" => "9/06/1996",
                "gender" => "female",
                "image" => "assets/images/user4.jpeg"
            ],
            [
                "first_name" => "ali",
                "middle_name" => "Makame",
                "last_name" => "Issa",
                "login_id" => "normal",
                "password" => Hash::make("1234"),
                "role_id" => 2,
                "email" => "ali@gmail.com",
                "phone_no" => "06556932",
                "dob" => "24/1/1996",
                "gender" => "male",
                "image" => "assets/images/user1.png"
            ],
            [
                "first_name" => "rosemary",
                "middle_name" => "Mshanga",
                "last_name" => "bri",
                "login_id" => "student",
                "password" => Hash::make("1234"),
                "role_id" => 3,
                "email" => "bri@gmail.com",
                "phone_no" => "0772564900",
                "dob" => "01/12/1996",
                "gender" => "Female",
                "image" => "assets/images/user3.jpeg"
            ]
        ]);

        DB::table('students')->insert([
            "user_id" => 3,
            "class_id" => 1
        ]);

        DB::table('lecturers')->insert([
            [
                "user_id" => 2,
                "dept_id" => 1,
                "lecturer_role_id" => 1
            ],
            [
                "user_id" => 3,
                "dept_id" => 2,
                "lecturer_role_id" => 2
            ],
            [
                "user_id" => 4,
                "dept_id" => 3,
                "lecturer_role_id" => 3
            ]

        ]);
    }
}
