<?php

namespace App\Http\Controllers;

use App\Models\LeaderClass;
use App\Models\LocalAdminSchool;
use App\Models\School;
use App\Models\SchoolClass;
use App\Models\SchoolClassTeacher;
use App\Models\SchoolTeacher;
use App\Models\User;
use App\Models\VerificationToken;
use Auth;
use Illuminate\Http\Request;

class LocalAdminController extends Controller
{
    public function getTeachers(School $school)
    {
        // dd(auth()->user());
        $localAdmin = LocalAdminSchool::where('school', $school->id)->where('user', Auth::user()->id)->firstOrFail();

        $result = [];

        foreach ($school->teachers as $teacher) {
            $result[] = $teacher->with('user', 'leader.schoolClass', 'profile.subjectInfo')->get();
        }

        return response()->json($result);
    }

    public function addNewTeacher(School $school, $token)
    {
        $localAdmin = LocalAdminSchool::where('school', $school->id)->where('user', Auth::user()->id)->firstOrFail();

        $token = VerificationToken::where('token', $token)->first();

        $schoolTeacher = SchoolTeacher::create([
            'school' => $school->id,
            'teacher' => $token->user,
        ]);

        return response()->json($schoolTeacher);

    }

    public function makeLeader(School $school, User $schoolTeacher, SchoolClass $schoolClass)
    {
        $localAdmin = LocalAdminSchool::where('school', $school->id)->where('user', Auth::user()->id)->first();
        // dd($localAdmin);

        $teacher = SchoolTeacher::where('teacher', $schoolTeacher->id)->firstOrFail();

        if ($teacher->school !== $school->id) {
            return response()->json(['message' => 'fail'], 403);
        }

        $leader = LeaderClass::create([
            'class' => $schoolClass->id,
            'teacher' => $teacher->id,
        ]);

        // dd($schoolClass);

        return response()->json(['message' => 'ok']);
    }

    public function addNewLocalAdmin(School $school, SchoolTeacher $schoolTeacher) {
        $localAdmin = LocalAdminSchool::where('school', $school->id)->where('user', Auth::user()->id)->firstOrFail();

        $localAdmin = LocalAdminSchool::create([
            'school' => $school->id,
            'user' => $schoolTeacher->teacher,
        ]);

        $user = User::where('id', $schoolTeacher->teacher)->update([
            'role' => 'local_admin'
        ]);

        return response()->json($localAdmin);

    }

    public function assignTeacher(SchoolTeacher $schoolTeacher, SchoolClass $schoolClass) {
        $teacherClass = SchoolClassTeacher::create([
            'class' => $schoolClass->id,
            'teacher' => $schoolTeacher->teacher,
        ]);

        return response()->json($teacherClass);
    }

    public function removeTeacher(SchoolClassTeacher $schoolClassTeacher) {
        $schoolClassTeacher->delete();
        return response()->json(['message' => 'ok']);
    }

    public function updateTeacher(SchoolClassTeacher $schoolClassTeacher, Request $request) {
        $schoolClassTeacher->update($request->all());

        return response()->json(SchoolClassTeacher::find($schoolClassTeacher->id));
    }
}
