<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarThemePlan extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'class', 'subject', 'academic_hours'
    ];
}
