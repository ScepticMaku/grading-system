<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function getCourses() {
        $courses = Course::get();

        return response()->json([
            'courses' => $courses,
        ]);
    }

    public function addCourse(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'course_description' => ['required', 'string'],
        ]);

        $course = Course::create([
            'name' => $request->name,
            'course_description' => $request->course_description,
        ]);

        return response()->json([
            'message' => 'Course Created Successfully!',
            'course' => $course,
        ]);
    }

    public function editCourse(Request $request, $id) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'course_description' => ['required', 'string'],
        ]);

        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        $course->update([
            'name' => $request->name,
            'course_description' => $request->course_description,
        ]);

        return response()->json([
            'message' => 'Course Updated Successfully!',
            'course' => $course,
        ]);
    }

    public function deleteCourse($id) {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        $course->delete();

        return response()->json([
            'message' => 'Course Deleted Successfully!',
        ]);
    }
}
