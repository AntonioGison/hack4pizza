<?php

use Illuminate\Database\Seeder;
use App\Badge;

class BadgesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Badge::create([
            'id' => 1,
            'name' => '1st place',
            'description' => 'The descrition explains how to achive this badge.',
            'color' => '#f9b940',
            'pic' => '1564999601badge-2.png',
            'created_at' => '2019-07-24 06:27:27',
            'updated_at' => '2019-08-05 06:12:00'
        ]);
        Badge::create([
            'id' => 2,
            'name' => '3rd place',
            'description' => 'little description here',
            'color' => '#ae4d00',
            'pic' => '1564999857badge-6.png',
            'created_at' => '2019-08-05 05:10:57',
            'updated_at' => '2019-08-05 05:10:57'
        ]);
        Badge::create([
            'id' => 3,
            'name' => '2nd Place',
            'description' => 'If the badge you want to achieve, the second place prize you have to receive.',
            'color' => 'rgba(89, 89, 89, 0.82)',
            'pic' => '15666393061.jpg',
            'created_at' => '2019-08-24 07:35:06',
            'updated_at' => '2019-08-24 07:35:06'
        ]);
        Badge::create([
            'id' => 4,
            'name' => 'Not Classified',
            'description' => 'Certificate of pizza eaten',
            'color' => '#df4141',
            'pic' => '1566639422only-pizza.jpg',
            'created_at' => '2019-08-24 07:37:02',
            'updated_at' => '2019-08-24 07:37:02'
        ]);
    }
}
