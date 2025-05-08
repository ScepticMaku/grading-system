<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'program_id',
        'course_id',
        'section_id',
        'status_id',
        'year_level',
        'semester',
        'date_enrolled',
    ];

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function program() {
        return $this->belongsTo(Program::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function section() {
        return $this->belongsTo(Section::class);
    }

    public function enrollmentStatus() {
        return $this->belongsTo(EnrollmentStatus::class);
    }
}
