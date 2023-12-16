<?php

namespace App\Http\Controllers;

use App\Models\LocalAdminSchool;
use App\Models\School;
use App\Models\SchoolTeacher;
use App\Models\VerificationToken;
use Auth;
use Illuminate\Http\Request;

class LocalAdminController extends Controller
{
    public function getTeachers(School $school)
    {
        $localAdmin = LocalAdminSchool::where('school', $school->id)->where('user', Auth::user()->id)->fristOrFail();

        return response()->json($school->teachers);
    }

    public function addNewTeacher(School $school, $token)
    {
        $localAdmin = LocalAdminSchool::where('school', $school->id)->where('user', Auth::user()->id)->fristOrFail();

        $token = VerificationToken::where('token', $token)->first();

        $schoolTeacher = SchoolTeacher::create([
            'school' => $school->id,
            'teacher' => $token->user,
            'leader' => null
        ]);

        return response()->json($schoolTeacher);

    }
}
