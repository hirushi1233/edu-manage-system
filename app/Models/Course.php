<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'course_name',
        'course_code',
        'field',
    ];

    // Relationship: One course has many subjects
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}