<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EnrollmentStatus;

class EnrollmentStatusController extends Controller
{
    public function getEnrollmentStatuses() {
        $enrollmentStatuses = EnrollmentStatus::get();
        return response()->json([
            'enrollmentStatuses' => $enrollmentStatuses,
        ]);
    }

    public function addEnrollmentStatus(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $enrollmentStatus = EnrollmentStatus::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Enrollment Status Created Successfully!',
            'enrollmentStatus' => $enrollmentStatus,
        ]);
    }

    public function editEnrollmentStatus(Request $request, $id) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $enrollmentStatus = EnrollmentStatus::find($id);

        if (!$enrollmentStatus) {
            return response()->json(['message' => 'Enrollment Status not found'], 404);
        }

        $enrollmentStatus->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Enrollment Status Updated Successfully!',
            'enrollmentStatus' => $enrollmentStatus,
        ]);
    }
    
    public function deleteEnrollmentStatus($id) {
        $enrollmentStatus = EnrollmentStatus::find($id);

        if (!$enrollmentStatus) {
            return response()->json(['message' => 'Enrollment Status not found'], 404);
        }

        $enrollmentStatus->delete();

        return response()->json([
            'message' => 'Enrollment Status Deleted Successfully!',
        ]);
    }
}
