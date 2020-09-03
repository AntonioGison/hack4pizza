<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(BadgesSeeder::class);
        $this->call(WorkSeeder::class);
        $this->call(MasterBadgesSeeder::class);
        $this->call(PerformanceSeeder::class);
        $this->call(ExperienceSeeder::class);
        $this->call(SettingsSeeder::class);
    }
}