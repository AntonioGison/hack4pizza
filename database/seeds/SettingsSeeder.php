<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'name'=>'site_title',
                'value'=>'Hack4Pizza', 
                'created_at'=>'2019-09-28 05:50:07', 
                'updated_at'=>'2019-09-28 05:50:07'
            ],
            [
                'name'=>'meta_keywords',
                'value'=>'Meta key',
                'created_at'=> '2019-09-28 05:50:07', 
                'updated_at'=>'2019-09-28 05:50:07'
            ],
            [
                'name'=>'meta_desc',
                'value'=>'Meta Descripion',
                'created_at'=> '2019-09-28 05:50:07', 
                'updated_at'=>'2019-09-28 05:50:07'
            ],
            [
                'name'=>'link1_text',
                'value'=>'LInk1', 
                'created_at'=>'2019-09-28 05:50:07', 
                'updated_at'=>'2019-09-28 05:50:07'
            ],
            [
                'name'=>'link1_url',
                'value'=>'#',
                'created_at'=>'2019-09-28 05:50:07', 
                'updated_at'=>'2019-09-28 05:50:07'
            ],
            [
                'name'=>'link2_text',
                'value'=>'LInk2', 
                'created_at'=>'2019-09-28 05:50:07', 
                'updated_at'=>'2019-09-28 05:50:07'
            ],
            [
                'name'=>'link2_url',
                'value'=>'#',
                'created_at'=>'2019-09-28 05:50:07', 
                'updated_at'=>'2019-09-28 05:50:07'
            ],
            [
                'name'=>'link3_text',
                'value'=>'LInk3', 
                'created_at'=>'2019-09-28 05:50:07', 
                'updated_at'=>'2019-09-28 05:50:07'
            ],
            [
                'name'=>'link3_url',
                'value'=>'#',
                'created_at'=>'2019-09-28 05:50:07', 
                'updated_at'=>'2019-09-28 05:50:07'
            ],
            [
                'name'=>'link4_text',
                'value'=>'LInk4', 
                'created_at'=>'2019-09-28 05:50:07', 
                'updated_at'=>'2019-09-28 05:50:07'
            ],
            [
                'name'=>'link4_url',
                'value'=>'#',
                'created_at'=>'2019-09-28 05:50:07', 
                'updated_at'=>'2019-09-28 05:50:07'
            ],
            [
                'name'=>'footer_text',
                'value'=>'Hack4.pizza 2019 a website made for fun.',
                'created_at'=>'2019-09-28 05:50:07', 
                'updated_at'=>'2019-09-28 05:50:07'
            ],
            [
                'name'=>'logo',
                'value'=>'1567107724logo2.png',
                'created_at'=> '2019-09-28 05:50:07', 
                'updated_at'=>'2019-09-28 05:50:07'
            ],
            [
                'name'=>'favicon',
                'value'=>'1566607504-kind-of-logo - Copy.jpg',
                'created_at'=>'2019-09-28 05:50:07',
                'updated_at'=>'2019-09-28 05:50:07'
            ],
            [
                'name'=>'stripe_enable',
                'value'=>'0', 
                'created_at'=>'2019-09-28 05:50:07', 
                'updated_at'=>'2019-09-28 05:50:07'
            ],
            [
                'name'=>'paypal_enable',
                'value'=>'0', 
                'created_at'=>'2019-09-28 05:50:07', 
                'updated_at'=>'2019-09-28 05:50:07'
            ]
        ]);
    }
}
