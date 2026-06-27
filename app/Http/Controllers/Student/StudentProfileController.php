<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentProfileController extends Controller
{
    /**
     * Show the form for editing the student's profile.
     */
    public function edit()
    {
        $user = Auth::user();
        // Load the relationship so we can display existing values
        $user->load('studentProfile');
        
        return view('pages.student.profile', compact('user'));
    }

    /**
     * Update the student's profile.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'roll_number' => ['nullable', 'string', 'max:50'],
            'branch' => ['nullable', 'string', 'max:100'],
            'year' => ['nullable', 'integer', 'min:1', 'max:6'],
        ]);

        $user = Auth::user();
        
        // Update user core fields
        $user->update(['name' => $validated['name']]);

        // Update or create student profile
        $user->studentProfile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'roll_number' => $validated['roll_number'],
                'branch' => $validated['branch'],
                'year' => $validated['year'],
            ]
        );

        return redirect()->route('student.profile')->with('success', 'Profile updated successfully.');
    }
}
