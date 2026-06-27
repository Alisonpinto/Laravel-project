<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Achievement;

class FacultyController extends Controller
{
    public function dashboard()
    {
        $pendingAchievements = Achievement::with(['user', 'user.studentProfile'])
            ->where('status', 'pending')
            ->latest()
            ->get();
            
        return view('pages.faculty.dashboard', compact('pendingAchievements'));
    }
}
