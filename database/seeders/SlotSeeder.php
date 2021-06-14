<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slots')->insert([
            [
                "start_time" => "08:00",
                "end_time" => "08:50"
            ],
            [   "start_time" => "08:55",
                "end_time" => "09:45"
            ],
            [
                "start_time" => "09:50",
                "end_time" => "10:40"
            ],
            [
                "start_time" => "10:45",
                "end_time" => "11:35"
            ],
            [
                "start_time" => "11:40",
                "end_time" => "12:30"
            ],
            [
                "start_time" => "12:35",
                "end_time" => "13:25"
            ],
            [
                "start_time" => "13:30",
                "end_time" => "14:20"
            ]

        ]);
    }
}
