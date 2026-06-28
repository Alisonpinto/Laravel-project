@extends('layouts.app')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Review Submission</h2>
        <p class="text-gray-500 mt-1.5 text-sm font-medium">Inspect and verify student achievement.</p>
    </div>
    <a href="{{ route('faculty.dashboard') }}" class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-gray-900 bg-white border border-gray-200 px-4 py-2 rounded-xl shadow-sm transition-all self-start sm:self-auto">
        &larr; Back to Dashboard
    </a>
</div>

<form method="POST" action="{{ route('faculty.achievements.update', $achievement->id) }}" class="w-full max-w-4xl mx-auto pb-12">
    @csrf
    @method('PUT')
    
    <div class="bg-white rounded-3xl shadow-[0_2px_20px_-4px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden mb-8">
        
        <!-- Header Section -->
        <div class="px-8 py-6 border-b border-gray-100 bg-white flex flex-col sm:flex-row sm:items-center justify-between gap-6">
            <div class="flex items-center">
                <div class="h-14 w-14 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 font-bold shadow-sm text-2xl">
                    {{ substr($achievement->user->name, 0, 1) }}
                </div>
                <div class="ml-5">
                    <h3 class="text-xl font-bold text-gray-900">{{ $achievement->user->name }}</h3>
                    <p class="text-sm font-medium text-gray-500 mt-0.5 flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        {{ $achievement->user->email }}
                    </p>
                </div>
            </div>
            
            <div class="sm:text-right flex flex-col sm:items-end gap-1.5">
                <div class="inline-flex items-center px-3 py-1.5 rounded-lg bg-gray-50 border border-gray-100 text-sm font-bold text-gray-700">
                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                    {{ $achievement->user->studentProfile?->roll_number ?? 'N/A' }}
                </div>
                <div class="text-xs font-semibold text-gray-400 flex items-center gap-1.5">
                    <span class="px-2 py-1 bg-gray-50 rounded-md border border-gray-100">{{ $achievement->user->studentProfile?->branch ?? 'N/A' }}</span>
                    <span>&bull;</span>
                    <span class="px-2 py-1 bg-gray-50 rounded-md border border-gray-100">{{ $achievement->user->studentProfile?->year ?? 'N/A' }}</span>
                </div>
            </div>
        </div>

        <!-- Achievement Details -->
        <div class="p-8 space-y-10">
            <div>
                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-[0.2em] mb-5 flex items-center">
                    <span class="bg-gray-100 h-px flex-1 mr-4"></span>
                    Achievement Details
                    <span class="bg-gray-100 h-px flex-1 ml-4"></span>
                </h4>
                <div class="bg-white">
                    <div class="mb-5 flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                        <div>
                            <h2 class="text-2xl font-black text-gray-900 leading-tight">{{ $achievement->title }}</h2>
                            <div class="flex items-center gap-3 mt-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100 uppercase tracking-wide">
                                    {{ $achievement->category }}
                                </span>
                            </div>
                        </div>
                        <div class="text-xs font-bold text-gray-500 bg-gray-50 px-3.5 py-2.5 rounded-xl border border-gray-100 flex items-center whitespace-nowrap h-fit shadow-sm">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Submitted: {{ $achievement->created_at->format('M d, Y') }}
                        </div>
                    </div>
                    
                    <div class="prose max-w-none mt-6 bg-gray-50/50 p-6 rounded-2xl border border-gray-100/80">
                        <p class="text-gray-700 whitespace-pre-wrap text-sm leading-relaxed">{{ $achievement->description }}</p>
                    </div>
                </div>
            </div>
            
            @if($achievement->file_path)
                <div>
                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-[0.2em] mb-5 flex items-center">
                        <span class="bg-gray-100 h-px flex-1 mr-4"></span>
                        Attached Proof
                        <span class="bg-gray-100 h-px flex-1 ml-4"></span>
                    </h4>
                    <div class="flex items-center justify-between p-5 border border-gray-100 rounded-2xl bg-white shadow-[0_1px_4px_rgba(0,0,0,0.02)] hover:shadow-md transition-all duration-200">
                        <div class="flex items-center">
                            <div class="p-3 bg-rose-50 rounded-xl mr-4 border border-rose-100 text-rose-500">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">Secure Attachment</p>
                                <p class="text-xs font-medium text-gray-500 mt-1">Available for faculty review</p>
                            </div>
                        </div>
                        <a href="{{ route('faculty.achievements.download', $achievement->id) }}" target="_blank"
                            class="inline-flex items-center px-4 py-2 border border-gray-200 rounded-xl shadow-sm text-sm font-bold text-gray-700 bg-white hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-all">
                            <svg class="-ml-1 mr-2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Download Proof
                        </a>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Decision Section -->
        <div class="bg-gray-50/50 p-8 border-t border-gray-100">
            <h3 class="text-lg font-bold text-gray-900 mb-1 flex items-center">
                <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                Faculty Remarks
            </h3>
            <p class="text-sm font-medium text-gray-500 mb-5">Provide feedback on this submission (optional). The student will be able to see this.</p>
            
            <div>
                <textarea name="faculty_remark" id="faculty_remark" rows="3" 
                    class="block w-full px-4 py-3 sm:text-sm border border-gray-200 rounded-2xl text-gray-900 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-shadow placeholder-gray-400 shadow-sm" 
                    placeholder="E.g. Great achievement, keep it up! / Please provide a clearer certificate...">{{ old('faculty_remark', $achievement->faculty_remark) }}</textarea>
                @error('faculty_remark')
                    <p class="mt-2 text-sm font-medium text-red-600 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>

    </div>

    <!-- Action Buttons -->
    <div class="flex gap-4 justify-end">
        <button type="submit" name="status" value="rejected" class="px-7 py-3 border border-red-200 bg-white rounded-xl shadow-sm text-sm font-bold text-red-600 hover:bg-red-50 hover:border-red-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            Reject
        </button>
        <button type="submit" name="status" value="approved" class="px-7 py-3 border border-transparent rounded-xl shadow-[0_2px_10px_-3px_rgba(79,70,229,0.5)] text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            Approve
        </button>
    </div>
</form>
@endsection
