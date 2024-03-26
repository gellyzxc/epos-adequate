<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    public $fillable = [
        'date', 'class', 'lessons'
    ];

    public $casts = [
        'lessons' => 'array'
    ];
}
