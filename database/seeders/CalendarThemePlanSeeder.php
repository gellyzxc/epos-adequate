<?php

namespace Database\Seeders;

use App\Models\CalendarThemePlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CalendarThemePlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            'География У', 'География Б', 'Алгебра У', 'Алгебра Б', 'Физика У', 'Физика Б', 'Биология'
        ];

        foreach ($subjects as $item) {
            CalendarThemePlan::create([
                'academic_hours' => random_int(1, 5),
                'subject' => $item,
                'class' => 10
            ]);
        }

    }
}
