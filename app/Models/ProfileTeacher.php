<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileTeacher extends Model
{
    use HasFactory, HasUuids;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'teacher',
        'subject'
    ];

    protected function subjectRelation() {
        return $this->belongsTo(SchoolSubject::class, 'subject', 'id');
    }
}
