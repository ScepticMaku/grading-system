<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;

class GradeController extends Controller
{
    public function getGrades() {
        $grades = Grade::with(['student', 'course', 'gradeStatus'])->get();
        return response()->json([
            'grades' => $grades,
        ]);
    }
    
    public function addGrade(Request $request) {
        $request->validate([
            'student_id' => ['required', 'integer'],
            'course_id' => ['required', 'integer'],
            'status_id' => ['required', 'integer'],
            'prelim' => ['required', 'numeric'],
            'midterm' => ['required', 'numeric'],
            'prefinal' => ['required', 'numeric'],
            'final' => ['required', 'numeric'],
            'average' => ['required', 'numeric'],
        ]);

        $grade = Grade::create([
            'student_id' => $request->student_id,
            'course_id' => $request->course_id,
            'status_id' => $request->status_id,
            'prelim' => $request->prelim,
            'midterm' => $request->midterm,
            'prefinal' => $request->prefinal,
            'final' => $request->final,
            'average' => $request->average,
        ]);
        return response()->json([
            'message' => 'Grade Created Successfully!',
            'grade' => $grade,
        ]);
    }

    public function editGrade(Request $request, $id) {
        $request->validate([
            'student_id' => ['required', 'integer'],
            'course_id' => ['required', 'integer'],
            'status_id' => ['required', 'integer'],
            'prelim' => ['required', 'numeric'],
            'midterm' => ['required', 'numeric'],
            'prefinal' => ['required', 'numeric'],
            'final' => ['required', 'numeric'],
            'average' => ['required', 'numeric'],
        ]);

        $grade = Grade::find($id);

        if (!$grade) {
            return response()->json(['message' => 'Grade not found'], 404);
        }

        $grade->update([
            'student_id' => $request->student_id,
            'course_id' => $request->course_id,
            'status_id' => $request->status_id,
            'prelim' => $request->prelim,
            'midterm' => $request->midterm,
            'prefinal' => $request->prefinal,
            'final' => $request->final,
            'average' => $request->average,
        ]);

        return response()->json([
            'message' => 'Grade Updated Successfully!',
            'grade' => $grade,
        ]);
    }

    public function deleteGrade($id) {
        $grade = Grade::find($id);

        if (!$grade) {
            return response()->json(['message' => 'Grade not found'], 404);
        }

        $grade->delete();

        return response()->json(['message' => 'Grade Deleted Successfully!']);
    }
}
