<?php

namespace Database\Seeders;

use App\Models\ClassPupil;
use App\Models\PupilUser;
use App\Models\User;
use App\Models\VerificationToken;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class PupilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $user = User::create([
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'middle_name' => $faker->jobTitle(),
                'email' => $faker->email(),
                'password' => Hash::make('qweqwe'),
                'role' => 'pupil',
            ]);

            $pupilUser = PupilUser::create([
                'user' => $user->id,
                'school_class' => '9c206626-25e1-48d8-96d4-835e7527909c',
            ]);

            $c = ClassPupil::create([
                'school_class' => '9c206626-25e1-48d8-96d4-835e7527909c',
                'user' => $pupilUser->id
            ]);
        }
    }

}
