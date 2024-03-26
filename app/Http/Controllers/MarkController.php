<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMarkRequest;
use App\Models\Lessons;
use App\Models\Mark;
use App\Models\PupilUser;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    public function createMark(SchoolClass $schoolClass, PupilUser $pupil, Lessons $lesson, CreateMarkRequest $request) {
        $newMark = Mark::create([
            'user' => $pupil->id,
            'mark' => $request->mark,
            'present' => $request->present,
            'lesson' => $lesson->id
        ]);

        return response()->json($newMark);
    }

    public function getMarks(SchoolClass $schoolClass) {
        $pupils = $schoolClass->pupils;

        return response()->json($pupils->with('marks'));
    }

}
