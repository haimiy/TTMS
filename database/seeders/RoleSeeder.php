<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                "user_role_name" => "admin"
            ],
            [
                "user_role_name" => "lecturer"
            ],
            [
                "user_role_name" => "student"
            ]
        ]);

        DB::table('lecturers_roles')->insert([
            [
                "lecturer_role_name" => "master"
            ],
            [
                "lecturer_role_name" => "coordinator"
            ],
            [
                "lecturer_role_name" => "normal"
            ]
        ]);
    }
}
