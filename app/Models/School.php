<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'schools';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'address',
        'mark_max',
        'data'
    ];

    protected $hidden = [];

    protected $casts = [
        'data' => 'array',
    ];

    public function classes()
    {
        return $this->hasMany(SchoolClass::class, 'school', 'id');
    }

    public function teachers() {
        return $this->hasMany(SchoolTeacher::class, 'school', 'id');
    }

}
