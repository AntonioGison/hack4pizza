<?php

use Illuminate\Database\Seeder;

class EarnedBadgesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('earned_badges')->insert([
            'user_id'=>1,
            'badge_id'=>1,
            'count'=>3,
            'created_at'=>'2020-04-20 10:13:35',
            'updated_at'=>'2020-04-20 10:16:47'
        ]);
        DB::table('earned_badges')->insert([
            'user_id'=>1,
            'badge_id'=>12,
            'count'=>3,
            'created_at'=>'2020-04-20 10:13:35',
            'updated_at'=>'2020-04-20 10:16:47'
        ]);
        DB::table('earned_badges')->insert([
            'user_id'=>1,
            'badge_id'=>2,
            'count'=>1,
            'created_at'=>'2020-04-20 10:13:35',
            'updated_at'=>'2020-04-20 10:16:47'
        ]);
        DB::table('earned_badges')->insert([
            'user_id'=>1,
            'badge_id'=>22,
            'count'=>1,
            'created_at'=>'2020-04-20 10:13:35',
            'updated_at'=>'2020-04-20 10:16:47'
        ]);
        DB::table('earned_badges')->insert([
            'user_id'=>2,
            'badge_id'=>22,
            'count'=>1,
            'created_at'=>'2020-04-20 10:13:35',
            'updated_at'=>'2020-04-20 10:16:47'
        ]);
    }
}
