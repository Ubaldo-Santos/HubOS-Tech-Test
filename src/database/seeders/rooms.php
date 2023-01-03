<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support;


class rooms extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // do 100 rooms
        for ($i = 0; $i < 100; $i++) {
            DB::table('rooms')->insert([
                'hotel_id' => 1,
                'name' => 'Room ' . $i,
                'max_occupancy' => rand(1, 4),
                'floor' => rand(1, 5),
            ]);
        }

        for ($i = 0; $i < 100; $i++) {
            DB::table('rooms')->insert([
                'hotel_id' => 2,
                'name' => 'Room ' . $i,
                'max_occupancy' => rand(1, 4),
                'floor' => rand(1, 5),
            ]);
        }

        for ($i = 0; $i < 100; $i++) {
            DB::table('rooms')->insert([
                'hotel_id' => 3,
                'name' => 'Room ' . $i,
                'max_occupancy' => rand(1, 4),
                'floor' => rand(1, 5),
            ]);
        }
    }
}
