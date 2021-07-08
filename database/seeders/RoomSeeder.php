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
    {   DB::table('blocks')->insert([
        [
            "block_name" => "Block A",
            "t_floor" =>0,
            "room_count"=>13
        ],
        [
            "block_name" => "Block B",
            "t_floor" => 0,
            "room_count"=>5
        ],
        [
            "block_name" => "Block C",
            "t_floor" => 0,
            "room_count"=>4
        ],
        [
            "block_name" => "Block D",
            "t_floor" => 0,
            "room_count"=>5
        ],
        [
            "block_name" => "Block T",
            "t_floor" => 0,
            "room_count"=>6
        ],
        [
            "block_name" => "Block TT",
            "t_floor" => 10,
            "room_count"=>2
        ],
    ]);

        DB::table('rooms')->insert([
            [
                "room_name" => "D2",
                "room_capacity" => 33,
                "room_no"=>2,
                "floor_name"=>0,
                "block_id"=>4
            ],
            [
                "room_name" => "T1",
                "room_capacity" => 50,
                "room_no"=>1,
                "floor_name"=>0,
                "block_id"=>5
            ],
            [
                "room_name" => "TT10",
                "room_capacity" => 100,
                "room_no"=>10,
                "floor_name"=>10,
                "block_id"=>6
            ],

        ]);
    }
}
