<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTimetableRequest;
use App\Models\ClassDayTimetable;
use App\Models\SchoolClass;
use App\Models\Timetable;
use Illuminate\Http\Request;

class TimetableController extends Controller
{

    public static function week()
    {
        $date = new \DateTime();
        $week = $date->format("W");
        return $week;
    }
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $data = Timetable::paginate(4);
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SchoolClass $schoolClass, StoreTimetableRequest $request)
    {
        $timetable = Timetable::create($request->validated());

        foreach ($request->days as $day) {
            ClassDayTimetable::create([
                'day' => $day,
                'timetable_id' => $timetable->id,
                'class' => $schoolClass->id
            ]);
        }

        return response()->json($timetable->load('dayTimetable'));
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolClass $schoolClass, string $timetable)
    {
        if ($timetable == 'latest') {
            $timetable = Timetable::where('class', $schoolClass->id)->orderBy('created_at', 'DESC')->first();
        } else {
            $timetable = Timetable::find($timetable);
        }
        $data = $timetable->load('dayTimetable.lessons');

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Timetable $timetable)
    {
        return response()->json([
            'message' => 'operation not permitted'
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Timetable $timetable)
    {
        return response()->json([
            'message' => 'operation not permitted'
        ], 400);
    }
}
