<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{
    public function getSections() {
        $sections = Section::get();

        return response()->json([
            'sections' => $sections,
        ]);
    }


    public function addSection(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $section = Section::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Section Created Successfully!',
            'section' => $section,
        ]);
    }

    public function editSection(Request $request, $id) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $section = Section::find($id);

        if (!$section) {
            return response()->json(['message' => 'Section not found'], 404);
        }

        $section->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Section Updated Successfully!',
            'section' => $section,
        ]);
    }
    
    public function deleteSection($id) {
        $section = Section::find($id);

        if (!$section) {
            return response()->json(['message' => 'Section not found'], 404);
        }

        $section->delete();

        return response()->json([
            'message' => 'Section Deleted Successfully!',
        ]);
    }
}
