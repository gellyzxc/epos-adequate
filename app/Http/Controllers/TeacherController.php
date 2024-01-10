<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProfileRequest;
use App\Models\ClassPupil;
use App\Models\LeaderClass;
use App\Models\ProfileTeacher;
use App\Models\PupilUser;
use App\Models\School;
use App\Models\SchoolClass;
use App\Models\SchoolSubject;
use App\Models\SchoolTeacher;
use App\Models\VerificationToken;
use Auth;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function createProfile(CreateProfileRequest $request, School $school)
    {

        $subject = SchoolSubject::create([
            'school' => $school->id,
            'name' => $request->subjectName,
        ]);

        $profile = ProfileTeacher::create([
            'subject' => $subject->id,
            'teacher' => Auth::id(),
        ]);

        return response()->json($profile);
    }

    public function deleteProfile(ProfileTeacher $profileTeacher)
    {
        //
    }

    public function newToken() {
        $token = VerificationToken::where('user', Auth::id())->where('type', 'teacher_school_add')->first();

        $notification = VerificationToken::create([
            'user' => Auth::id(),
            'token' => strtoupper(\Str::random(2)).str(mt_rand(10000000, 99999998)),
            'type' => 'teacher_school_add',
            'class' => null,
        ]);

        if ($token) {
            $token->delete();
        }

        return response()->json($notification);

    }

    public function getProfiles()
    {
        $profiles = ProfileTeacher::where('teacher', Auth::id())->get();
        $result = [];

        foreach ($profiles as $profile) {
            $result[] = $profile->subjectInfo;
        }

        return response()->json($result);
    }

    public function leaderAccept($token)
    {
        $classRequest = VerificationToken::where('token', $token)->first();

        $pupilUser = PupilUser::create([
            'user' => $classRequest->user,
            'school_class' => $classRequest->class,
        ]);

        $class = ClassPupil::create([
            'school_class' => $classRequest->class,
            'user' => $pupilUser->id,
        ]);

        return response()->json($class);
    }

    public function leaderDeny($token)
    {
        $classRequest = VerificationToken::where('token', $token)->first()->delete();
        return response()->json(['message' => 'ok']);
    }

    public function myClass(School $school) {
        $schoolTeacher = SchoolTeacher::where('teacher', Auth::id())->where('school', $school->id)->first();
        $classes = LeaderClass::where('teacher', $schoolTeacher->id)->get();
        // dd(LeaderClass::all());

        $result = [];

        foreach ($classes as $class) {
            $result[] = $class->class;
        }

        return response()->json($result);
    }

    public function getPeoplesForMyClass(School $school, SchoolClass $schoolClass) {
        $schoolTeacher = SchoolTeacher::where('teacher', Auth::id())->where('school', $school->id)->first();
        $class = LeaderClass::where('teacher', $schoolTeacher->id)->where('class', $schoolClass->id)->first();
        // dd($class);

        return response()->json($class->with('class.pupils')->get());
    }
}
