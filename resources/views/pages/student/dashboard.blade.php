@extends('layouts.app')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white tracking-tight">Student Dashboard</h2>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Welcome back to the College IMS Student Portal.</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Profile Card -->
    <div class="bg-white dark:bg-[#252526] rounded-2xl shadow-sm border border-gray-200 dark:border-[#333333] p-6 hover:shadow-md transition-shadow group">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                <div class="p-2 bg-zinc-100 dark:bg-[#333333] text-zinc-800 dark:text-zinc-300 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                My Profile
            </h3>
        </div>
        <p class="text-gray-600 dark:text-gray-400 mb-6 text-sm">
            Manage your personal information, update your branch, year, and roll number to keep your academic records accurate.
        </p>
        <a href="{{ route('student.profile') }}" class="inline-flex items-center justify-center w-full px-4 py-2.5 text-sm font-medium text-white bg-zinc-800 hover:bg-zinc-900 dark:bg-zinc-700 dark:hover:bg-zinc-600 rounded-xl transition-colors">
            Manage Profile
            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>

    <!-- Achievements Card -->
    <div class="bg-white dark:bg-[#252526] rounded-2xl shadow-sm border border-gray-200 dark:border-[#333333] p-6 hover:shadow-md transition-shadow group">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                <div class="p-2 bg-zinc-100 dark:bg-[#333333] text-zinc-800 dark:text-zinc-300 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
                My Achievements
            </h3>
        </div>
        <p class="text-gray-600 dark:text-gray-400 mb-6 text-sm">
            Submit new certificates, view your past submissions, and track the review status from your faculty members.
        </p>
        <a href="{{ route('student.achievements.index') }}" class="inline-flex items-center justify-center w-full px-4 py-2.5 text-sm font-medium text-white bg-zinc-800 hover:bg-zinc-900 dark:bg-zinc-700 dark:hover:bg-zinc-600 rounded-xl transition-colors">
            View Achievements
            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>
</div>
@endsection
