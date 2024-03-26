<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\SchoolClass;
use App\Models\SchoolTeacher;
use App\Models\User;
use App\Models\VerificationToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function addToClassRequest(SchoolClass $schoolClass) {

        // dd($schoolClass);

        $old = VerificationToken::where('user', Auth::id())->where('type', 'class_add')->first();

        if ($old && $old->id) {
            $old->delete();
        }

        $token = new VerificationToken();

        $token->user = Auth::id();
        $token->type = 'class_add';
        $token->token = strtoupper(\Str::random(1)).str(mt_rand(1000000, 9999999));
        $token->user = Auth::id();
        $token->class = str($schoolClass->id);
        $token->save();

        return response()->json($token);
    }

    public function getMarks() {
        $marks = Mark::where('user', Auth::id());
    }

    public function info() {
        $user = Auth::user();

        if ($user->role == 'teacher') {
            return response()->json($user->load('teacherProfile.school'));
        } elseif ($user->role == 'pupil') {
            return response()->json($user->load('pupilProfile.schoolClass.school'));
        } elseif ($user->role == 'parent') {
            dd('xDDDD');
        }

        return response()->json($user);
    }
}
