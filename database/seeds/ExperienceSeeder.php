<?php

use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('experiences')->insert([
            'name'=>'Happiness Hack Day',
            'organized_by'=>'Tech Nation Visa Alumni Network',
            'from'=>'2019-06-21',
            'to'=>'2019-06-22',
            'description'=>'In this event you find a lot of startup people, I feel like home when I go in the collar factory for a Hackathon! It\'s my first \"mind sprititual\" hackathon, I picked the happiness challenge and I made a quick prototype! Really helpful was my team, two IT Engineers who helped me to find out the app structure, even if I pitched by myself because everyone left, was a really nice experience, to repeat!',
            'pic'=>'uploads/hackathon/1.png',
            'user_id'=>1,
            'badge_id'=>12,
            'created_at' => '2019-08-24 07:35:06',
            'updated_at' => '2019-08-24 07:35:06'
        ]);
        DB::table('experiences')->insert([
            'name'=>'Heritage Science Hackathon',
            'organized_by'=>'UCL',
            'from'=>'2019-05-18',
            'to'=>'2019-05-19',
            'description'=>'My team? First place!?\nThat day I really learned what does it mean \"the idea is not everything\". Thanks to my fellas who made the Business model and a real screen prototype we won the 1st place! ah... and also because the design of my app was cool, but I decided to be humble today ? ?',
            'pic'=>'uploads/hackathon/2.png',
            'user_id'=>1,
            'badge_id'=>1,
            'created_at'=>'2019-08-29 15:59:00',
            'updated_at'=>'2019-08-29 15:59:00'
        ]);
        DB::table('experiences')->insert([
            'name'=>'SMART CITY HACK DAY',
            'organized_by'=>'Tech Nation Visa Ambassadors',
            'from'=>'2018-06-16',
            'to'=>'2018-06-16',
            'description'=>'My first hackathon!',
            'pic'=>'uploads/hackathon/3.png',
            'user_id'=>1,
            'badge_id'=>12,
            'created_at'=>'2019-08-29 16:04:12',
            'updated_at'=>'2019-08-29 16:10:23'
        ]);
        
        DB::table('experiences')->insert([
            'name'=>'HackZurich 5th Edition',
            'organized_by'=>'Digitalfestival',
            'from'=>'2018-09-14',
            'to'=>'2018-09-16',
            'description'=>'HackZurich is the fifth edition of Europe\'s biggest hackathon. 550 top engineering students hackers and then me. Nothing to add just amazing experience!',
            'pic'=>'uploads/hackathon/4.png',
            'user_id'=>1,
            'badge_id'=>12,
            'created_at'=>'2019-08-29 16:09:08',
            'updated_at'=>'2019-08-29 16:09:08'
        ]);
        
        DB::table('experiences')->insert([
            'name'=>'BAPRAS Hackathon 2019',
            'organized_by'=>'PA Consulting',
            'from'=>'2019-10-05',
            'to'=>'2019-10-06',
            'description'=>'I really enjoyed this hackathon especially because I was with my girlfriend \nWe made a simple app able to help the doctor to locate items and tool. The app is connected to a camera with computer vision. <a href="https://docs.google.com/presentation/d/1NRSTbh3DGItH4KfsrpKMDzS-MKE-E5ImgRXm1PhRSuI/edit?usp=sharing">Here\'s our pitch</a> and  more information abou the project!',
            'pic'=>'uploads/hackathon/5.png',
            'user_id'=>1,
            'badge_id'=>2,
            'created_at'=>'2019-10-10 09:59:27',
            'updated_at'=>'2019-10-10 10:00:00'
        ]);
        
        DB::table('experiences')->insert([
            'name'=>'Mobilising Blockchain',
            'organized_by'=>'Monet and General Assembly',
            'from'=>'2019-12-07',
            'to'=>'2019-12-08',
            'description'=>'I enjoyed this challenge totally new for me the Blockchain. After we understood the opportunities using this technology we came up with an idea for a self Notary service.',
            'pic'=>'uploads/hackathon/6.png',
            'user_id'=>1,
            'badge_id'=>1,
            'created_at'=>'2019-12-23 15:55:18',
            'updated_at'=>'2019-12-23 15:55:18'
        ]);
        
        DB::table('experiences')->insert([
            'name'=>'Startup Weekend COVID-19 Italy',
            'organized_by'=>'Techstars',
            'from'=>'2020-04-17',
            'to'=>'2020-04-19',
            'description'=>'I\'ve been a <pizza style=\"color:green;\">Mentor</pizza> at this event. I just loved the experience. Due the coronavirus the event was online <a href="http://communities.techstars.com/italy/roma/startup-weekend/16171">Startup Weekend</a>',
            'pic'=>'uploads/hackathon/7.png',
            'user_id'=>1,
            'badge_id'=>1,
            'created_at'=>'2020-04-20 10:13:35',
            'updated_at'=>'2020-04-20 10:16:47'
        ]);
    }
}
