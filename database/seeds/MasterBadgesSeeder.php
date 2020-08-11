<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterBadgesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_badges')->insert([
            [
                'name'=>'Master 1',
                'number'=>5,
                'pic'=>'1566300835badge-3.jpg',
                'description'=>'Coming soon..',
                'badge_id'=>3,
                'created_at'=>'2019-08-20 16:33:55',
                'updated_at'=>'2019-09-20 05:46:12'
            ]
        ]);
    }
}
