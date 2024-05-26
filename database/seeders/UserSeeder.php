<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        User::create([
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'middle_name' => $faker->jobTitle(),
            'email' => 'admin@mail.ru',
            'password' => Hash::make('qweqwe'),
            'role' => 'local_admin',
        ]);

        User::create([
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'middle_name' => $faker->jobTitle(),
            'email' => 'teacher@mail.ru',
            'password' => Hash::make('qweqwe'),
            'role' => 'teacher',
        ]);

        User::create([
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'middle_name' => $faker->jobTitle(),
            'email' => 'pupil@mail.ru',
            'password' => Hash::make('qweqwe'),
            'role' => 'pupil']);
    }
}
