<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function getStudents() {
        $students = Student::get();

        return response()->json([
            'students' => $students,
        ]);
    }

    public function addStudent(Request $request) {
        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:13'],
        ]);

        $student = Student::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'contact' => $request->contact,
        ]);

        return response()->json([
            'message' => 'Student Created Successfully!',
            'student' => $student,
        ]);
    }

    public function editStudent(Request $request, $id) {
        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:13'],
        ]);

        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'contact' => $request->contact,
        ]);

        return response()->json([
            'message' => 'Student Updated Successfully!',
            'student' => $student,
        ]);
    }

    public function deleteStudent($id) {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->delete();

        return response()->json(['message' => 'Student Deleted Successfully!']);
    }
}
