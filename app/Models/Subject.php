<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_code',
        'subject_name',
    ];

    public function courses()
    {
        return $this->belongsToMany(
            Course::class,
            'course_subject',
            'subject_id',
            'course_id'
        );
    }

    public function teachersAsSubject1()
    {
        return $this->hasMany(Teacher::class, 'subject_1_id');
    }

    public function teachersAsSubject2()
    {
        return $this->hasMany(Teacher::class, 'subject_2_id');
    }
}
