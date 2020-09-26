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
                'name'=>'Antonio Gison',
                'first_name'=>'Antonio',
                'last_name'=>'Gison',
                'email'=>'antonio.gison@live.it',
                'phone_number'=>'999-888-7654',
                'profile_picture'=>'uploads/user-pic/headshot_full.png',
                'slug'=>'antonio',
                'address'=>'Naples, Italy',
                'bio'=>'This is a bio, empty but always a bio.',
                'password'=> bcrypt('antonio.gison'),
                'created_at'=>'2019-08-07 06:26:02',
                'updated_at'=>'2019-09-20 05:04:13'
            ],
            [
                'name'=>'Akram Chauhan',
                'first_name'=>'Akram',
                'last_name'=>'Chauhan',
                'email'=>'akramchauhan@gmail.com',
                'phone_number'=>'960-110-6151',
                'profile_picture'=>'uploads/user-pic/headshot_akram.jpg',
                'slug'=>'akram-chauhan',
                'address'=>'Gujarat, India',
                'bio'=>'I love Pizzaaa. :) ',
                'password'=> bcrypt('password'),
                'created_at'=>'2019-08-07 06:26:02',
                'updated_at'=>'2019-09-20 05:04:13'
            ]
        ]
    );
    }
}
