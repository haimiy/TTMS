<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('days')->insert([
            [
                "day_name" => "Monday"
            ],
            [
                "day_name" => "Tuesday"   
            ],
            [
                "day_name" => "Wednesday" 
            ],
            [
                "day_name" => "Thursady" 
            ],
            [
                "day_name" => "Friday" 
            ]
            
        ]);
    }
}
