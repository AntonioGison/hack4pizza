<?php

use Illuminate\Database\Seeder;

class PerformanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('performances')->insert( [
            [
                'pitch'=>6,
                'front_end'=>2,
                'back_end'=>1,
                'team_player'=>4,
                'problem_solving'=>7,
                'ux_design'=>8,
                'user_id'=>1,
                'created_at'=>'2019-08-07 06:26:02',
                'updated_at'=>'2019-09-20 05:04:13'
            ]
        ]);
    }
}
