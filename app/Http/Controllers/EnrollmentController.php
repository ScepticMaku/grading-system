<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;

class EnrollmentController extends Controller
{
    public function getEnrollments() {
        $enrollments = Enrollment::with(['student', 'program', 'userStatus'])->get();

        return response()->json([
            'enrollments' => $enrollments,
        ]);
    }

    public function addEnrollment(Request $request) {
        $request->validate([
            'student_id' => ['required', 'integer'],
            'program_id' => ['required', 'integer'],
            'course_id' => ['required', 'integer'],
            'section_id' => ['required', 'integer'],
            'status_id' => ['required', 'integer'],
            'year_level' => ['required', 'string'],
            'semester' => ['required', 'string'],
            'date_enrolled' => ['required', 'date'],
        ]);

        $enrollment = Enrollment::create([
            'student_id' => $request->student_id,
            'program_id' => $request->program_id,
            'course_id' => $request->course_id,
            'section_id' => $request->section_id,
            'status_id' => $request->status_id,
            'year_level' => $request->year_level,
            'semester' => $request->semester,
            'date_enrolled' => $request->date_enrolled,
        ]);

        return response()->json([
            'message' => 'Enrollment Created Successfully!',
            'enrollment' => $enrollment,
        ]);
    }

    public function editEnrollment(Request $request, $id) {
        $request->validate([
            'student_id' => ['required', 'integer'],
            'program_id' => ['required', 'integer'],
            'course_id' => ['required', 'integer'],
            'section_id' => ['required', 'integer'],
            'status_id' => ['required', 'integer'],
            'year_level' => ['required', 'string'],
            'semester' => ['required', 'string'],
            'date_enrolled' => ['required', 'date'],
        ]);

        $enrollment = Enrollment::find($id);

        if (!$enrollment) {
            return response()->json(['message' => 'Enrollment not found'], 404);
        }

        $enrollment->update([
            'student_id' => $request->student_id,
            'program_id' => $request->program_id,
            'course_id' => $request->course_id,
            'section_id' => $request->section_id,
            'status_id' => $request->status_id,
            'year_level' => $request->year_level,
            'semester' => $request->semester,
            'date_enrolled' => $request->date_enrolled,
        ]);

        return response()->json([
            'message' => 'Enrollment Updated Successfully!',
            'enrollment' => $enrollment,
        ]);
    }
    
    public function deleteEnrollment($id) {
        $enrollment = Enrollment::find($id);

        if (!$enrollment) {
            return response()->json(['message' => 'Enrollment not found'], 404);
        }

        $enrollment->delete();

        return response()->json(['message' => 'Enrollment Deleted Successfully!']);
    }
}
