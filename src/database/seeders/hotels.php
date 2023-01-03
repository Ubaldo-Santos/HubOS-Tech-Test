<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class hotels extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hotels')->insert([
            'name' => 'W Barcelona',
            'address_Street' => 'Plaça Rosa Del Vents 1, Final, Pg. de Joan de Borbó',
            'address_PostalCode' => '08039',
            'address_City' => 'Barcelona',
            'address_Country' => 'Spain',
            'contact_Phone' => '932 95 28 00',
            'contact_Email' => 'customer@whotels.com',
        ]);

        DB::table('hotels')->insert([
            'name' => 'Hampton Inn Manhattan/Times Square Central',
            'address_Street' => '220 W 41st St',
            'address_PostalCode' => '10036',
            'address_City' => 'New York',
            'address_Country' => 'United States',
            'contact_Phone' => '212-221-1188',
            'contact_Email' => 'customer@hilton.com',
        ]);

        DB::table('hotels')->insert([
            'name' => 'JO&JOE Paris Gentilly',
            'address_Street' => '89-93 Av. Paul Vaillant Couturier',
            'address_PostalCode' => '94250 ',
            'address_City' => 'Paris',
            'address_Country' => 'France',
            'contact_Phone' => '1 84 23 37 60',
            'contact_Email' => 'customer@accor.com',
        ]);
    }
}
