<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Artisan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);

        $this->call(SchoolSeeder::class);
        // $this->call(SchoolSeeder::class);
        // $this->call(SchoolSeeder::class);

        $this->call(CalendarThemePlanSeeder::class);

        $this->call(LocalAdminSeeder::class);

        Artisan::call('passport:install');


    }
}
