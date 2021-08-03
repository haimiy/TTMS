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
                "end_time" => "08:50",
                "s_time"=> 1
            ],
            [   "start_time" => "08:55",
                "end_time" => "09:45",
                "s_time"=> 1
            ],
            [
                "start_time" => "09:50",
                "end_time" => "10:40",
                "s_time"=> 1
            ],
            [
                "start_time" => "10:45",
                "end_time" => "11:35",
                "s_time"=> 1
            ],
            [
                "start_time" => "11:40",
                "end_time" => "12:30",
                "s_time"=> 1
            ],
            [
                "start_time" => "12:35",
                "end_time" => "13:25",
                "s_time"=> 1
            ],
            [
                "start_time" => "13:30",
                "end_time" => "14:20",
                "s_time"=> 2
            ],
            [
                "start_time" => "13:30",
                "end_time" => "14:20",
                "s_time"=> 2
            ],
            [
                "start_time" => "14:30",
                "end_time" => "15:20",
                "s_time"=> 2
            ],
            [
                "start_time" => "15:25",
                "end_time" => "16:15",
                "s_time"=> 2
            ],
            [
                "start_time" => "16:20",
                "end_time" => "17:10",
                "s_time"=> 2
            ],
            [
                "start_time" => "17:15",
                "end_time" => "18:05",
                "s_time"=> 2
            ],
            [
                "start_time" => "18:10",
                "end_time" => "19:00",
                "s_time"=> 3
            ],
            [
                "start_time" => "19:05",
                "end_time" => "19:55",
                "s_time"=> 3
            ],
            [
                "start_time" => "20:00",
                "end_time" => "20:50",
                "s_time"=> 3
            ],
        ]);
    }
}
