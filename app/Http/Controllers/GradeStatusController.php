<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GradeStatus;

class GradeStatusController extends Controller
{
    public function getGradeStatuses() {
        $gradeStatuses = GradeStatus::get();

        return response()->json([
            'gradeStatuses' => $gradeStatuses,
        ]);
    }

    public function addGradeStatus(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $gradeStatus = GradeStatus::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Grade Status Created Successfully!',
            'gradeStatus' => $gradeStatus,
        ]);
    }

    public function editGradeStatus(Request $request, $id) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $gradeStatus = GradeStatus::find($id);

        if (!$gradeStatus) {
            return response()->json(['message' => 'Grade Status not found'], 404);
        }

        $gradeStatus->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Grade Status Updated Successfully!',
            'gradeStatus' => $gradeStatus,
        ]);
    }
    
    public function deleteGradeStatus($id) {
        $gradeStatus = GradeStatus::find($id);

        if (!$gradeStatus) {
            return response()->json(['message' => 'Grade Status not found'], 404);
        }

        $gradeStatus->delete();

        return response()->json([
            'message' => 'Grade Status Deleted Successfully!',
        ]);
    }
}
