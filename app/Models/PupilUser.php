<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PupilUser extends Model
{
    use HasFactory, HasUuids;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user',
        'school_class',
    ];

    public function marks() {
        return $this->hasMany(Mark::class, 'user', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user', 'id');
    }
}
