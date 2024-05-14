<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassDayTimetable extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'day', 'timetable_id', 'class'
    ];

    public function lessons() {
        return $this->hasMany(Lesson::class, 'class_day_timetable_id', 'id');
    }
}
