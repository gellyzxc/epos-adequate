<?php

namespace App\Http\Controllers;

use App\Models\ClassDayTimetable;
use App\Models\Lesson;
use App\Models\SchoolClass;
use App\Models\Timetable;
use Illuminate\Http\Request;

class LessonsController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(SchoolClass $schoolClass, ClassDayTimetable $classDayTimetable, Request $request)
    {
        $lessons = $classDayTimetable->lessons()->delete();

        $data = $request->lessons_data;

        foreach ($data as $item) {
            Lesson::create([
                'class_day_timetable_id' => $classDayTimetable->id,
                'duration' => 40,
                'teacher_profile_id' => $item['teacher'],
                'number' => $item['number'],
                'type' => $item['type'],
                'cabinet' => $item['cabinet']
            ]);
        }

        return response()->json($classDayTimetable->load('lessons'));

    }

    /**
     * Display the specified resource.
     */
    public function show(ClassDayTimetable $classDayTimetable)
    {
        $data = $classDayTimetable->lessons;

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        $data = $lesson->delete();
    }
}
