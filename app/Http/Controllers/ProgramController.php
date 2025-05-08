<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;

class ProgramController extends Controller
{
    public function getPrograms() {
        $programs = Program::get();
        return response()->json([
            'programs' => $programs,
        ]);
    }

    public function addProgram(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $program = Program::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Program Created Successfully!',
            'program' => $program,
        ]);
    }
    public function editProgram(Request $request, $id) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $program = Program::find($id);

        if (!$program) {
            return response()->json(['message' => 'Program not found'], 404);
        }

        $program->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Program Updated Successfully!',
            'program' => $program,
        ]);
    }
    public function deleteProgram($id) {
        $program = Program::find($id);

        if (!$program) {
            return response()->json(['message' => 'Program not found'], 404);
        }

        $program->delete();

        return response()->json([
            'message' => 'Program Deleted Successfully!',
        ]);
    }
}
