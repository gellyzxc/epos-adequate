<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolTeacher extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'school',
        'teacher',
        'leader'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'teacher', 'id');
    }
    public function leader() {
        return $this->hasMany(LeaderClass::class, 'teacher', 'id');
    }

    public function profile() {
        return $this->hasMany(ProfileTeacher::class, 'teacher', 'teacher');
    }

    public function school() {
        return $this->belongsTo(School::class, 'school', 'id');
    }
}
