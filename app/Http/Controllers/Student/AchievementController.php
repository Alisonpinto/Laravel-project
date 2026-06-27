<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AchievementController extends Controller
{
    /**
     * Display a listing of the student's achievements.
     */
    public function index()
    {
        $achievements = Auth::user()->achievements()->latest()->get();
        return view('pages.student.achievements.index', compact('achievements'));
    }

    /**
     * Show the form for creating a new achievement.
     */
    public function create()
    {
        return view('pages.student.achievements.create');
    }

    /**
     * Store a newly created achievement in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'in:Internship,Certificate,Competition,Paper Publication'],
            'description' => ['required', 'string'],
            'file' => ['required', 'file', 'mimes:pdf,jpeg,png,jpg', 'max:5120'], // Max 5MB
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = Storage::disk('local')->putFile('achievements', $request->file('file'));
        }

        Auth::user()->achievements()->create([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'file_path' => $filePath,
            'status' => 'pending',
        ]);

        return redirect()->route('student.dashboard')->with('success', 'Achievement submitted successfully and is pending review.');
    }
}
