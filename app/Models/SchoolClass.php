<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = 'school_classes';


    protected $fillable = [
        'school',
        'name',
        'number',
    ];

    protected $hidden = [];

    protected $casts = [];

    // public function pupils()
    // {
    //     return $this->hasMany(PupilUser::class, 'school_class', 'id');
    // }

    public function pupils() {
        return $this->hasManyThrough(User::class, PupilUser::class, 'school_class', 'id', 'id', 'user');
    }

    public function school() {
        return $this->belongsTo(School::class, 'school', 'id');
    }
}
