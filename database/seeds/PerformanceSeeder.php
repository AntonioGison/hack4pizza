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
                'pitch'=>8,
                'front_end'=>9,
                'back_end'=>8,
                'team_player'=>7,
                'problem_solving'=>9,
                'ux_design'=>6,
                'user_id '=>1,
                'created_at'=>'2019-08-07 06:26:02',
                'updated_at'=>'2019-09-20 05:04:13'
            ]
        ]);
    }
}
