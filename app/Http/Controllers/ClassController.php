<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClassRequest;
use App\Http\Requests\UpdateClassRequest;
use App\Models\School;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{

    public function __construct() {
        // $this->authorizeResource(SchoolClass::class);
    }

    public function store(CreateClassRequest $request, School $school)
    {


        $class = SchoolClass::create([
            'school' => $school->id,
            ...$request->validated()
        ]);

        return response()->json($class);
    }

    public function index(School $school)
    {


        $classes = SchoolClass::where('school', $school->id)->get();

        return response()->json($classes);
    }

    public function show(SchoolClass $schoolClass, School $school)
    {
        $classes = SchoolClass::where('school', $school->id)->where('id', $schoolClass->id)->first();
        dd($schoolClass);
        return response()->json($classes->with('pupils')->get());
    }

    public function update(UpdateClassRequest $request, School $school, SchoolClass $schoolClass)
    {


        $school = School::create($request->validated());

        return response()->json($school);
    }

    public function destroy(School $school, SchoolClass $schoolClass)
    {

        $this->authorize('delete');

        $class = SchoolClass::where(['school' => $school->id, 'id' => $schoolClass->id])->delete();

        return response()->json(['message' => 'deleted']);
    }
}
