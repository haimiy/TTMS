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
                "first_name" => "hussna",
                "middle_name" => "ali",
                "last_name" => "Issa",
                "login_id" => "hu10",
                "password" => Hash::make("1234"),
                "role_id" => 2,
                "email" => "hu@gmail.com",
                "phone_no" => "0772675900",
                "dob" => "10/12/1996",
                "gender" => "Female",
                "image" => "assets/images/admin1.jpeg"
            ],
            [
                "first_name" => "bri",
                "middle_name" => "john",
                "last_name" => "steven",
                "login_id" => "bri10",
                "password" => Hash::make("1234"),
                "role_id" => 2,
                "email" => "i@gmail.com",
                "phone_no" => "0742674900",
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
                "first_name" => "salum",
                "middle_name" => "chuwa",
                "last_name" => "nona",
                "login_id" => "sa10",
                "password" => Hash::make("1234"),
                "role_id" => 2,
                "email" => "sal@gmail.com",
                "phone_no" => "0888932",
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
                "email" => "bi@gmail.com",
                "phone_no" => "0772564900",
                "dob" => "01/12/1996",
                "gender" => "Female",
                "image" => "assets/images/user3.jpeg"
            ],
            [
                "first_name" => "rosemary",
                "middle_name" => "Mshanga",
                "last_name" => "bri",
                "login_id" => "r10",
                "password" => Hash::make("1234"),
                "role_id" => 2,
                "email" => "r@gmail.com",
                "phone_no" => "074900",
                "dob" => "01/12/1996",
                "gender" => "Female",
                "image" => "assets/images/user3.jpeg"
            ],
            [
                "first_name" => "tunu",
                "middle_name" => "jembe",
                "last_name" => "isaka",
                "login_id" => "tu10",
                "password" => Hash::make("1234"),
                "role_id" => 2,
                "email" => "tu@gmail.com",
                "phone_no" => "044900",
                "dob" => "01/12/1996",
                "gender" => "Female",
                "image" => "assets/images/user3.jpeg"
            ],
            [
                "first_name" => "Asshsh",
                "middle_name" => "jembe",
                "last_name" => "isaka",
                "login_id" => "a10",
                "password" => Hash::make("1234"),
                "role_id" => 2,
                "email" => "a@gmail.com",
                "phone_no" => "044aaa900",
                "dob" => "01/12/1996",
                "gender" => "Female",
                "image" => "assets/images/user3.jpeg"
            ]
        ]);

        DB::table('students')->insert([
            "user_id" => 8,
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
                "user_id" => 5,
                "dept_id" => 3,
                "lecturer_role_id" => 2
            ],
            [
                "user_id" => 3,
                "dept_id" => 4,
                "lecturer_role_id" => 3
            ],
            [
                "user_id" => 6,
                "dept_id" => 5,
                "lecturer_role_id" => 3
            ],
            [
                "user_id" => 7,
                "dept_id" => 6,
                "lecturer_role_id" => 3
            ],
            [
                "user_id" => 9,
                "dept_id" => 2,
                "lecturer_role_id" => 2
            ],
            [
                "user_id" => 4,
                "dept_id" => 3,
                "lecturer_role_id" => 1
            ]

        ]);

    }
}
