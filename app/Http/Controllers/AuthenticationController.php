<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string','max:255'],
            'email' => ['required', 'string','max:255', 'unique:users'],
            'contact' => ['required', 'string','max:13'],
            'type' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string','min:8'],
            'confirm_password' => ['required', 'same:password'],
            
        ]);

        $user = User::create([
            'username' => $request->username,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'contact' => $request->contact,
            'type' => $request->type,
            'password' => Hash::make($request->password),
            'role_id' => 2,
            'status_id' => 1,
        ]);

        return response()->json(['message' => 'User Created Successfully!', 'user' => $user]);
    }

    public function login(Request $request) {
        $request->validate([
            'username'=> ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('username', $request->username)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid Credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['message' => 'User logged in successfully!', 'user' => $user, 'token' => $token]);

    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'User logged out successfully!']);
    }
}
