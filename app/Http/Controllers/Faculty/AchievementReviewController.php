<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AchievementReviewController extends Controller
{
    /**
     * Display the specified achievement for review.
     */
    public function show(Achievement $achievement)
    {
        // Eager load the user and their student profile
        $achievement->load(['user', 'user.studentProfile']);
        
        return view('pages.faculty.achievements.show', compact('achievement'));
    }

    /**
     * Download the uploaded proof for the achievement.
     */
    public function download(Achievement $achievement)
    {
        if (!$achievement->file_path || !Storage::disk('local')->exists($achievement->file_path)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('local')->download($achievement->file_path);
    }

    /**
     * Update the status and remark of the achievement.
     */
    public function update(Request $request, Achievement $achievement)
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:approved,rejected'],
            'faculty_remark' => ['nullable', 'string', 'max:1000'],
        ]);

        $achievement->update([
            'status' => $validated['status'],
            'faculty_remark' => $validated['faculty_remark'],
        ]);

        return redirect()->route('faculty.dashboard')->with('success', "Achievement {$validated['status']} successfully.");
    }
}
