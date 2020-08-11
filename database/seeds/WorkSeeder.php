<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('works')->insert( [
            [
                'title'=>'Step 1',
                'description'=>'Add the attended hackathon in your collection with all the information you want',
                'pic'=>'1568963004step1.gif',
                'created_at'=>'2019-08-07 06:26:02',
                'updated_at'=>'2019-09-20 05:04:13'
            ],
            [
                'title'=>'Step 2',
                'description'=>'Unlock and collect badges!',
                'pic'=>'1568963909step2.gif',
                'created_at'=>'2019-08-07 06:26:02',
                'updated_at'=>'2019-09-20 05:18:29'
            ],
            [
                'title'=>'Step 3 (coming soon feature)',
                'description'=>'Shares your profile with friends, family and potential Big tech willing to hire you!',
                'pic'=>'1568963723tenor.gif',
                'created_at'=>'2019-08-07 06:26:02',
                'updated_at'=>'2019-09-20 05:15:23'
            ]
        ] );
    }
}
