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
        'course_id'
    ];

    // Relationship: Each subject belongs to one course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Teachers teaching this subject as subject 1
    public function teachersAsSubject1()
    {
        return $this->hasMany(Teacher::class, 'subject_1_id');
    }

    // Teachers teaching this subject as subject 2
    public function teachersAsSubject2()
    {
        return $this->hasMany(Teacher::class, 'subject_2_id');
    }
}
