<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert( [
            [
                'name'=>'Antonio',
                'email'=>'test@gmail.com',
                'password'=>bcrypt('password'),
                'created_at'=>'2019-08-07 06:26:02',
                'updated_at'=>'2019-09-20 05:04:13'
            ],
            [
                'name'=>'Akram Chauhan',
                'email'=>'akram@hack4pizza.com',
                'password'=>bcrypt('password'),
                'created_at'=>'2019-08-07 06:26:02',
                'updated_at'=>'2019-09-20 05:18:29'
            ],
        ],
    );
    }
}
