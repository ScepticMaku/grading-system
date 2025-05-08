<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'status_id',
        'prelim',
        'midterm',
        'prefinal',
        'final',
        'average',
    ];

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function gradeStatus() {
        return $this->belongsTo(GradeStatus::class);
    }
}
