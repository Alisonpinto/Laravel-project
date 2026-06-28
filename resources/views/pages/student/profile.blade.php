@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white tracking-tight">Student Profile</h2>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Manage your academic details.</p>
    </div>
    <a href="{{ route('student.dashboard') }}" class="text-sm font-medium text-zinc-600 dark:text-zinc-400 hover:underline">
        &larr; Back to Dashboard
    </a>
</div>

@if(session('success'))
    <div class="mb-6 bg-green-50 dark:bg-[#252526] border border-green-200 dark:border-green-900/50 p-4 rounded-lg shadow-sm">
        <div class="flex items-center">
            <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <p class="text-sm font-medium text-green-800 dark:text-green-400">{{ session('success') }}</p>
        </div>
    </div>
@endif

<div class="bg-white dark:bg-[#252526] rounded-2xl shadow-sm border border-gray-200 dark:border-[#333333] overflow-hidden w-full max-w-2xl mx-auto">
    <form action="{{ route('student.profile.update') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="p-6 sm:p-8 space-y-6">
            
            <div class="pb-6 border-b border-gray-200 dark:border-[#333333]">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Account Information</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Basic details linked to your account.</p>
                
                <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name</label>
                        <input type="text" value="{{ Auth::user()->name }}" disabled
                            class="block w-full px-3 py-2 sm:text-sm border border-gray-300 dark:border-[#333333] rounded-lg text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-[#1E1E1E] cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email Address</label>
                        <input type="email" value="{{ Auth::user()->email }}" disabled
                            class="block w-full px-3 py-2 sm:text-sm border border-gray-300 dark:border-[#333333] rounded-lg text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-[#1E1E1E] cursor-not-allowed">
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Academic Profile</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Update your college details here.</p>
                
                <div class="mt-4 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                    
                    <div class="sm:col-span-2">
                        <label for="roll_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Roll Number</label>
                        <input type="text" name="roll_number" id="roll_number" value="{{ old('roll_number', $profile->roll_number ?? '') }}"
                            class="block w-full px-3 py-2 sm:text-sm border border-gray-300 dark:border-[#333333] rounded-lg text-gray-900 dark:text-white bg-white dark:bg-[#1E1E1E] focus:outline-none focus:ring-2 focus:ring-zinc-500 dark:focus:ring-zinc-400 transition-shadow">
                        @error('roll_number')
                            <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="branch" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Branch / Department</label>
                        <select name="branch" id="branch"
                            class="block w-full px-3 py-2 sm:text-sm border border-gray-300 dark:border-[#333333] rounded-lg text-gray-900 dark:text-white bg-white dark:bg-[#1E1E1E] focus:outline-none focus:ring-2 focus:ring-zinc-500 dark:focus:ring-zinc-400 transition-shadow">
                            <option value="">Select Branch</option>
                            <option value="Computer Engineering" {{ (old('branch', $profile->branch ?? '') == 'Computer Engineering') ? 'selected' : '' }}>Computer Engineering</option>
                            <option value="Information Technology" {{ (old('branch', $profile->branch ?? '') == 'Information Technology') ? 'selected' : '' }}>Information Technology</option>
                            <option value="Mechanical Engineering" {{ (old('branch', $profile->branch ?? '') == 'Mechanical Engineering') ? 'selected' : '' }}>Mechanical Engineering</option>
                            <option value="Electrical Engineering" {{ (old('branch', $profile->branch ?? '') == 'Electrical Engineering') ? 'selected' : '' }}>Electrical Engineering</option>
                            <option value="Civil Engineering" {{ (old('branch', $profile->branch ?? '') == 'Civil Engineering') ? 'selected' : '' }}>Civil Engineering</option>
                        </select>
                        @error('branch')
                            <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Current Year</label>
                        <select name="year" id="year"
                            class="block w-full px-3 py-2 sm:text-sm border border-gray-300 dark:border-[#333333] rounded-lg text-gray-900 dark:text-white bg-white dark:bg-[#1E1E1E] focus:outline-none focus:ring-2 focus:ring-zinc-500 dark:focus:ring-zinc-400 transition-shadow">
                            <option value="">Select Year</option>
                            <option value="First Year" {{ (old('year', $profile->year ?? '') == 'First Year') ? 'selected' : '' }}>First Year</option>
                            <option value="Second Year" {{ (old('year', $profile->year ?? '') == 'Second Year') ? 'selected' : '' }}>Second Year</option>
                            <option value="Third Year" {{ (old('year', $profile->year ?? '') == 'Third Year') ? 'selected' : '' }}>Third Year</option>
                            <option value="Final Year" {{ (old('year', $profile->year ?? '') == 'Final Year') ? 'selected' : '' }}>Final Year</option>
                        </select>
                        @error('year')
                            <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            
        </div>
        
        <div class="px-6 py-4 bg-gray-50 dark:bg-[#1E1E1E] border-t border-gray-200 dark:border-[#333333] text-right">
            <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-zinc-800 hover:bg-zinc-900 dark:bg-zinc-700 dark:hover:bg-zinc-600 focus:outline-none focus:ring-4 focus:ring-zinc-500/30 transition-all">
                Save Profile Changes
            </button>
        </div>
    </form>
</div>
@endsection
