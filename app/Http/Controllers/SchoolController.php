<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{

    public function __construct() {
        $this->authorizeResource(School::class);
    }

    public function store(CreateSchoolRequest $request) {
        $school = School::create($request->validated());

        return response()->json($school);
    }

    public function index() {
        return response()->json(School::all());
    }

    public function show(School $school) {
        return response()->json($school->with('classes')->get());
    }

    public function update(UpdateSchoolRequest $request, School $school) {
        $school = School::create($request->validated());

        return response()->json($school);
    }

    public function destroy(School $school) {

        $school->delete();

        return response()->json(['message' => 'deleted']);
    }
}
