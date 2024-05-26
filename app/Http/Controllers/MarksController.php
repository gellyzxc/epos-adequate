<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMarkRequest;
use App\Http\Requests\UpdateMarksRequest;
use App\Models\Mark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Auth::user()->profile->marks->with('lessonRel');

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMarkRequest $request)
    {
        $mark = Mark::create($request->validated());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMarksRequest $request, Mark $mark)
    {
        foreach ($request->validated() as $param => $value) {
            $mark->{$param} = $value;
        }

        $mark->save();

        return response()->json($mark);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mark $mark)
    {
        $mark->delete();
    }
}
