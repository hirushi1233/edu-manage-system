<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'name',
        'address',
        'nic',
        'phone_1',
        'phone_2',
        'subject_1_id',
        'subject_2_id',
        'grade_1',
        'grade_2',
        'nic_front_image',
        'nic_back_image',
    ];

    // Relationship for Subject 1
    public function subject1()
    {
        return $this->belongsTo(Subject::class, 'subject_1_id');
    }

    // Relationship for Subject 2
    public function subject2()
    {
        return $this->belongsTo(Subject::class, 'subject_2_id');
    }
}
