<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            [
                "room_name" => "D2",
                "room_capacity" => 33
            ],
            [
                "room_name" => "T1",
                "room_capacity" => 50           
            ],
            [
                "room_name" => "TT10",
                "room_capacity" => 100            
            ],
            [
                "room_name" => "C1",
                "room_capacity" => 63            
            ],
            [
                "room_name" => "W9F",
                "room_capacity" => 25            
            ]
            
        ]);
    }
}
