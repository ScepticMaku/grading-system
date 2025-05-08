<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getUsers() {
        $users = User::get();

        return response()->json([
            'users' => $users,
        ]);
    }

    public function addUser(Request $request) {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:13'],
            'password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'same:password'],
            'security_question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string', 'max:255'],
            'role_id' => ['required', 'integer'],
            'status_id' => ['required', 'integer'],
        ]);

        $user = User::create([
            'username' => $request->username,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'contact' => $request->contact,
            'password' => bcrypt($request->password),
            'security_question' => $request->security_question,
            'answer' => bcrypt($request->answer),
            'role_id' => $request->role_id,
            'status_id' => $request->status_id,
        ]);

        return response()->json([
            'message' => 'User Created Successfully!',
            'user' => $user,
        ]);
    }

    public function editUser(Request $request, $id) {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:13'],
            'role_id' => ['required', 'integer'],
            'status_id' => ['required', 'integer'],
        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->update([
            'username' => $request->username,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'contact' => $request->contact,
            'role_id' => $request->role_id,
            'status_id' => $request->status_id,
        ]);

        return response()->json([
            'message' => 'User Updated Successfully!',
            'user' => $user,
        ]);
    }
    
    public function deleteUser($id) {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User Deleted Successfully!']);
    }
}
