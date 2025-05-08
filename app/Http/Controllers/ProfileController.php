<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function getProfile() {
        $user = Auth::user();

        return response()->json([
            'user' => $user,
        ]);
    }

    public function editProfile(Request $request) {
        $user = Auth::user();

        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string','max:255'],
            'email' => ['required', 'string','max:255'],
            'contact' => ['required', 'string','max:13'],
        ]);

        $user = User::find($user->id);

        if(!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->update([
            'username' => $request->username,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'contact' => $request->contact,
        ]);

        return response()->json(['message' => 'Profile Updated Successfully!', 'user' => $user]);
    }

    public function changePassword(Request $request) {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'same:new_password'],
        ]);

        $user = User::find($user->id);

        if(!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if(!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'Current Password is incorrect'], 401);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return response()->json(['message' => 'Password Changed Successfully!']);
    }
}
