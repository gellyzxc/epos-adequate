<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lessons extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'school',
        'class',
        'subject',
        'day',
        'number',
        'type',
        'minutes',
        'week',
        'year'
    ];

    public function classes() {
        return $this->hasOne(SchoolClass::class, 'class', 'id');
    }
}
