<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\PupilUser;
use App\Models\SchoolClass;
use App\Models\SchoolSubject;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    public function createMark(SchoolClass $schoolClass, PupilUser $pupil, SchoolSubject $schoolSubject, $mark) {
        $newMark = Mark::create([
            'user' => $pupil->id,
            'mark' => $mark == 0 ?? null,
            'present' => $mark == 0 ? false : true,
        ]);

        return response()->json($newMark);
    }

    public function getMarks(SchoolClass $schoolClass) {
        $pupils = $schoolClass->pupils;

        return response()->json($pupils->with('marks'));
    }

}
