<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLessonRequest;
use App\Models\Lessons;
use App\Models\School;
use App\Models\SchoolClass;
use App\Models\Timetable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TimetableController extends Controller
{
    public static function week() {
        $date = new \DateTime();
        $week = $date->format("W");
        return $week;
    }

    public function createLesson(School $school, SchoolClass $schoolClass, CreateLessonRequest $request) {
        // dd($request->all());
        // $lesson = Lessons::create([
        //     'teacher' => $request->teacher,
        //     'subject' => $request->subject,
        //     'class' => $schoolClass->id,
        //     'day' => $request->day,
        //     'number' => $request->number,
        //     'minutes' => $request->minutes,
        //     'week' => $request->week,
        // ]);

        // return response()->json($lesson);
    }

    public function getLessons(School $school, SchoolClass $schoolClass, $week) {
        // $lessons = Lessons::where('school', $school->id)->where('week', $week)->where('class', $schoolClass->id)->get();

        // return response()->json($lessons->with('classes'));
    }

    public function makeTimetable(Request $request, SchoolClass $schoolClass) {
        $timetable = Timetable::create([
            'date' => $request->date,
            'class' => $schoolClass->id,
            'lessons' => $schoolClass->lessons->toArray(),
        ]);
    }
}
