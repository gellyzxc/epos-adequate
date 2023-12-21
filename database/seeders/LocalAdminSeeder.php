<?php

namespace Database\Seeders;

use App\Models\LocalAdminSchool;
use App\Models\School;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocalAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        LocalAdminSchool::create([
            'school' => School::all()->random(1)->first()->id,
            'user' => User::where('role', 'local_admin')->first()->id,
        ]);
    }
}
