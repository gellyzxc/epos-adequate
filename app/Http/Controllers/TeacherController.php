<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProfileRequest;
use App\Models\ClassPupil;
use App\Models\ProfileTeacher;
use App\Models\PupilUser;
use App\Models\SchoolSubject;
use App\Models\VerificationToken;
use Auth;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function createProfile(CreateProfileRequest $request) {

        $subject = SchoolSubject::create([
            'school' => '',
            'name' => $request->subjectName,
        ]);

        $profile = ProfileTeacher::create([
            'subject' => $subject->id,
            'teacher' => Auth::id(),
        ]);

        return response()->json($profile);
    }

    public function deleteProfile(ProfileTeacher $profileTeacher) {
        //
    }

    public function getProfiles() {
        $profiles = ProfileTeacher::where('teacher', Auth::id())->get();

        return response()->json($profiles);
    }

    public function leaderAccept($token) {
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

    public function leaderDeny($token) {
        $classRequest = VerificationToken::where('token', $token)->first()->delete();
        return response()->json(['message' => 'ok']);
    }
}
