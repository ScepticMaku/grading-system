<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserStatus;

class UserStatusController extends Controller
{
    public function getUserStatuses() {
        $userStatuses = UserStatus::get();

        return response()->json([
            'userStatuses' => $userStatuses,
        ]);
    }

    public function addUserStatus(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $userStatus = UserStatus::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'User Status Created Successfully!',
            'userStatus' => $userStatus,
        ]);
    }

    public function editUserStatus(Request $request, $id) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $userStatus = UserStatus::find($id);

        if (!$userStatus) {
            return response()->json(['message' => 'User Status not found'], 404);
        }

        $userStatus->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'User Status Updated Successfully!',
            'userStatus' => $userStatus,
        ]);
    }

    public function deleteUserStatus($id) {
        $userStatus = UserStatus::find($id);

        if (!$userStatus) {
            return response()->json(['message' => 'User Status not found'], 404);
        }

        $userStatus->delete();

        return response()->json(['message' => 'User Status Deleted Successfully!']);
    }
}
