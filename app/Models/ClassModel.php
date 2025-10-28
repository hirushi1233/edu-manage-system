<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'class_id',
        'class_name',
        'grade_id',
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
}
