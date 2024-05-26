<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'mark',
        'present',
        'lesson'
    ];

    public function lessonRel() {
        return $this->belongsTo(Lesson::class, 'lesson', 'id');
    }
}
