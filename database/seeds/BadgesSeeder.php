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
            'name' => '1st place',
            'description' => 'The descrition explains how to achive this badge.',
            'color' => '#f9b940',
            'pic' => 'uploads/badges/1.svg',
            'created_at' => '2019-07-24 06:27:27',
            'updated_at' => '2019-08-05 06:12:00'
        ]);
        Badge::create([
            'name' => '2nd place',
            'description' => 'little description here',
            'color' => '#ae4d00',
            'pic' => 'uploads/badges/2.svg',
            'created_at' => '2019-08-05 05:10:57',
            'updated_at' => '2019-08-05 05:10:57'
        ]);
        Badge::create([
            'name' => '3nd Place',
            'description' => 'If the badge you want to achieve, the second place prize you have to receive.',
            'color' => 'rgba(89, 89, 89, 0.82)',
            'pic' => 'uploads/badges/3.svg',
            'created_at' => '2019-08-24 07:35:06',
            'updated_at' => '2019-08-24 07:35:06'
        ]);
        Badge::create([
            'name' => 'Taste 4 gold',
            'description' => 'little description',
            'color' => 'rgba(89, 89, 89, 0.82)',
            'pic' => 'uploads/badges/4.svg',
            'created_at' => '2019-08-24 07:35:06',
            'updated_at' => '2019-08-24 07:35:06'
        ]);
        Badge::create([
            'name' => 'Taste 4 silver',
            'description' => 'Certificate of pizza eaten',
            'color' => '#df4141',
            'pic' => 'uploads/badges/5.svg',
            'created_at' => '2019-08-24 07:37:02',
            'updated_at' => '2019-08-24 07:37:02'
        ]);
        Badge::create([
            'id' => 6,
            'name' => 'Taste 4 bronze',
            'description' => 'little description',
            'color' => '#df4141',
            'pic' => 'uploads/badges/6.svg',
            'created_at' => '2019-08-24 07:37:02',
            'updated_at' => '2019-08-24 07:37:02'
        ]);
        Badge::create([
            'id' => 7,
            'name' => 'Philanthropist',
            'description' => 'little description',
            'color' => '#df4141',
            'pic' => 'uploads/badges/7.svg',
            'created_at' => '2019-08-24 07:37:02',
            'updated_at' => '2019-08-24 07:37:02'
        ]);
        Badge::create([
            'id' => 8,
            'name' => 'God of internet',
            'description' => 'little description',
            'color' => '#df4141',
            'pic' => 'uploads/badges/8.svg',
            'created_at' => '2019-08-24 07:37:02',
            'updated_at' => '2019-08-24 07:37:02'
        ]);
        Badge::create([
            'name' => 'Lord of machines',
            'description' => 'little description',
            'color' => '#df4141',
            'pic' => 'uploads/badges/9.svg',
            'created_at' => '2019-08-24 07:37:02',
            'updated_at' => '2019-08-24 07:37:02'
        ]);
        Badge::create([
            'name' => 'challenger',
            'description' => 'little description',
            'color' => '#df4141',
            'pic' => 'uploads/badges/10.svg',
            'created_at' => '2019-08-24 07:37:02',
            'updated_at' => '2019-08-24 07:37:02'
        ]);
        Badge::create([
            'name' => 'Most wanted',
            'description' => 'little description',
            'color' => '#df4141',
            'pic' => 'uploads/badges/11.svg',
            'created_at' => '2019-08-24 07:37:02',
            'updated_at' => '2019-08-24 07:37:02'
        ]);
        Badge::create([
            'name' => 'Here 4 Pizza',
            'description' => 'little description',
            'color' => '#df4141',
            'pic' => 'uploads/badges/12.svg',
            'created_at' => '2019-08-24 07:37:02',
            'updated_at' => '2019-08-24 07:37:02'
        ]);
        Badge::create([
            'name' => 'In pizza we crust',
            'description' => 'little description',
            'color' => '#df4141',
            'pic' => 'uploads/badges/13.svg',
            'created_at' => '2019-08-24 07:37:02',
            'updated_at' => '2019-08-24 07:37:02'
        ]);
        Badge::create([
            'name' => 'King of pizza',
            'description' => 'little description',
            'color' => '#df4141',
            'pic' => 'uploads/badges/14.svg',
            'created_at' => '2019-08-24 07:37:02',
            'updated_at' => '2019-08-24 07:37:02'
        ]);
        Badge::create([
            'name' => 'Pizza reaper',
            'description' => 'little description',
            'color' => '#df4141',
            'pic' => 'uploads/badges/15.svg',
            'created_at' => '2019-08-24 07:37:02',
            'updated_at' => '2019-08-24 07:37:02'
        ]);
        Badge::create([
            'name' => 'Pizza bat',
            'description' => 'little description',
            'color' => '#df4141',
            'pic' => 'uploads/badges/16.svg',
            'created_at' => '2019-08-24 07:37:02',
            'updated_at' => '2019-08-24 07:37:02'
        ]);
        Badge::create([
            'name' => 'Pizza o\'lantern',
            'description' => 'little description',
            'color' => '#df4141',
            'pic' => 'uploads/badges/17.svg',
            'created_at' => '2019-08-24 07:37:02',
            'updated_at' => '2019-08-24 07:37:02'
        ]);
        Badge::create([
            'name' => 'Hackaholic',
            'description' => 'little description',
            'color' => '#df4141',
            'pic' => 'uploads/badges/18.svg',
            'created_at' => '2019-08-24 07:37:02',
            'updated_at' => '2019-08-24 07:37:02'
        ]);
        Badge::create([
            'name' => 'Birthday',
            'description' => 'little description',
            'color' => '#df4141',
            'pic' => 'uploads/badges/19.svg',
            'created_at' => '2019-08-24 07:37:02',
            'updated_at' => '2019-08-24 07:37:02'
        ]);
        Badge::create([
            'name' => 'Pizza pirate',
            'description' => 'little description',
            'color' => '#df4141',
            'pic' => 'uploads/badges/20.svg',
            'created_at' => '2019-08-24 07:37:02',
            'updated_at' => '2019-08-24 07:37:02'
        ]);
        Badge::create([
            'name' => 'Verified',
            'description' => 'little description',
            'color' => '#df4141',
            'pic' => 'uploads/badges/21.svg',
            'created_at' => '2019-08-24 07:37:02',
            'updated_at' => '2019-08-24 07:37:02'
        ]);
        Badge::create([
            'name' => 'Early adopter',
            'description' => 'little description',
            'color' => '#df4141',
            'pic' => 'uploads/badges/22.svg',
            'created_at' => '2019-08-24 07:37:02',
            'updated_at' => '2019-08-24 07:37:02'
        ]);
        Badge::create([
            'name' => 'Early adopter+',
            'description' => 'little description',
            'color' => '#df4141',
            'pic' => 'uploads/badges/23.svg',
            'created_at' => '2019-08-24 07:37:02',
            'updated_at' => '2019-08-24 07:37:02'
        ]);
        Badge::create([
            'name' => 'Hackathon Added',
            'description' => 'little description',
            'color' => '#df4141',
            'pic' => 'uploads/badges/24.svg',
            'created_at' => '2019-08-24 07:37:02',
            'updated_at' => '2019-08-24 07:37:02'
        ]);
    }
}
