<?php

namespace Database\Seeders;

use App\Models\School;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $s = School::create([
            'name' => $faker->company(),
            'address' => $faker->address(),
            'mark_max' => 10,
            'data' => '{}'
        ]);

        User::create([
            'first_name' => 'Выберите учителя',
            'last_name' => $s->id,
            'middle_name' => '',
            'email' => random_int(10000000, 9999999999999).'@'. random_int(1, 898123) .'mail.ru',
            'password' => Hash::make('jsjsuurhw'.random_int(1000, 999999)),
            'role' => 'tempForLesson',
        ]);
    }
}
