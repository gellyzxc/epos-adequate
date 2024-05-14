<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    public $fillable = [
        'week', 'class', 'lessons', 'year'
    ];

    public $casts = [
        'lessons' => 'array'
    ];

    public function dayTimetable() {
        return $this->hasMany(ClassDayTimetable::class, 'timetable_id', 'id');
    }
}
