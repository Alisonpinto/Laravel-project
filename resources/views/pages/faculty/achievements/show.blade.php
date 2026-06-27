@extends('layouts.app')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white tracking-tight">Review Submission</h2>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Inspect and verify student achievement.</p>
    </div>
    <a href="{{ route('faculty.dashboard') }}" class="text-sm font-medium text-zinc-600 dark:text-zinc-400 hover:underline">
        &larr; Back to Dashboard
    </a>
</div>

<form method="POST" action="{{ route('faculty.achievements.update', $achievement->id) }}" class="w-full max-w-4xl mx-auto">
    @csrf
    @method('PUT')
    
    <div class="bg-white dark:bg-[#252526] rounded-2xl shadow-sm border border-gray-200 dark:border-[#333333] overflow-hidden mb-6">
        
        <!-- Header Section -->
        <div class="px-6 py-5 border-b border-gray-200 dark:border-[#333333] bg-gray-50/50 dark:bg-[#252526] flex items-center justify-between">
            <div class="flex items-center">
                <div class="h-10 w-10 rounded-full bg-zinc-800 dark:bg-[#333333] border border-zinc-700 flex items-center justify-center text-white font-semibold shadow-sm text-lg">
                    {{ substr($achievement->user->name, 0, 1) }}
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ $achievement->user->name }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $achievement->user->email }}</p>
                </div>
            </div>
            
            <div class="text-right">
                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $achievement->user->studentProfile?->roll_number ?? 'N/A' }}</div>
                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $achievement->user->studentProfile?->branch ?? 'N/A' }} &bull; {{ $achievement->user->studentProfile?->year ?? 'N/A' }}</div>
            </div>
        </div>

        <!-- Achievement Details -->
        <div class="p-6 sm:p-8 space-y-8">
            <div>
                <h4 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Achievement Details</h4>
                <div class="bg-gray-50 dark:bg-[#1E1E1E] rounded-xl p-5 border border-gray-100 dark:border-[#333333]">
                    <div class="mb-4 flex items-start justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $achievement->title }}</h2>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-zinc-100 text-zinc-800 dark:bg-[#333333] dark:text-zinc-300 border border-zinc-200 dark:border-zinc-700 mt-2">
                                {{ $achievement->category }}
                            </span>
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            Submitted: {{ $achievement->created_at->format('M d, Y') }}
                        </div>
                    </div>
                    
                    <div class="prose dark:prose-invert max-w-none">
                        <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap text-sm leading-relaxed">{{ $achievement->description }}</p>
                    </div>
                </div>
            </div>
            
            @if($achievement->file_path)
                <div>
                    <h4 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Attached Proof</h4>
                    <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-[#333333] rounded-xl bg-white dark:bg-[#252526]">
                        <div class="flex items-center">
                            <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                            </svg>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Secure Attachment</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Available for faculty review</p>
                            </div>
                        </div>
                        <a href="{{ route('faculty.achievements.download', $achievement->id) }}" target="_blank"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-[#333333] rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-[#1E1E1E] hover:bg-gray-50 dark:hover:bg-[#333333] focus:outline-none transition-colors">
                            <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Download
                        </a>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Decision Section -->
        <div class="bg-gray-50 dark:bg-[#1E1E1E] p-6 sm:p-8 border-t border-gray-200 dark:border-[#333333]">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Make a Decision</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Your remarks will be visible to the student.</p>
            
            <div>
                <label for="faculty_remark" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Feedback Remarks (Optional)</label>
                <textarea name="faculty_remark" id="faculty_remark" rows="3" 
                    class="block w-full px-3 py-2 sm:text-sm border border-gray-300 dark:border-[#333333] rounded-lg text-gray-900 dark:text-white bg-white dark:bg-[#252526] focus:outline-none focus:ring-2 focus:ring-zinc-500 dark:focus:ring-zinc-400 transition-shadow placeholder-gray-400 dark:placeholder-gray-500" 
                    placeholder="Provide constructive feedback...">{{ old('faculty_remark', $achievement->faculty_remark) }}</textarea>
                @error('faculty_remark')
                    <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>

    </div>

    <div class="flex gap-4 justify-end">
        <button type="submit" name="status" value="rejected" class="px-6 py-2.5 border border-red-500/30 rounded-lg shadow-sm text-sm font-semibold text-red-400 hover:bg-red-500/10 focus:outline-none transition-all flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            Reject
        </button>
        <button type="submit" name="status" value="approved" class="px-6 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-[#007ACC] hover:bg-[#007ACC]/90 focus:outline-none transition-all flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            Approve
        </button>
    </div>
</form>
@endsection
