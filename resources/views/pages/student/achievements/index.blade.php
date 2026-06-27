@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white tracking-tight">Submission History</h2>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Track the status of your uploaded achievements.</p>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('student.dashboard') }}" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 dark:border-[#333333] rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-[#252526] hover:bg-gray-50 dark:hover:bg-[#333333] transition-colors shadow-sm">
            Dashboard
        </a>
        <a href="{{ route('student.achievements.create') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-zinc-800 hover:bg-zinc-900 dark:bg-zinc-700 dark:hover:bg-zinc-600 focus:outline-none focus:ring-4 focus:ring-zinc-500/30 transition-all">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            New Submission
        </a>
    </div>
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

<div class="bg-white dark:bg-[#252526] rounded-2xl shadow-sm border border-gray-200 dark:border-[#333333] overflow-hidden">
    @if($achievements->isEmpty())
        <div class="p-12 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-[#333333] text-gray-400 dark:text-gray-500 mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-1">No achievements yet</h4>
            <p class="text-gray-500 dark:text-gray-400 text-sm mb-6">You haven't submitted any achievements for review.</p>
            <a href="{{ route('student.achievements.create') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-zinc-800 hover:bg-zinc-900 dark:bg-zinc-700 dark:hover:bg-zinc-600 transition-all">
                Submit Your First Achievement
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-[#333333]">
                <thead class="bg-gray-50 dark:bg-[#1E1E1E]">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Title</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Category</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date Submitted</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Remarks</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-[#252526] divide-y divide-gray-200 dark:divide-[#333333]">
                    @foreach($achievements as $achievement)
                        <tr class="hover:bg-gray-50 dark:hover:bg-[#333333]/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ Str::limit($achievement->title, 40) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-zinc-100 text-zinc-800 dark:bg-[#333333] dark:text-zinc-300 border border-zinc-200 dark:border-zinc-700">
                                    {{ $achievement->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $achievement->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($achievement->status === 'approved')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-400 border border-green-200 dark:border-green-800">
                                        Approved
                                    </span>
                                @elseif($achievement->status === 'rejected')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-400 border border-red-200 dark:border-red-800">
                                        Rejected
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-400 border border-amber-200 dark:border-amber-800">
                                        Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                @if($achievement->faculty_remark)
                                    <div class="max-w-xs truncate" title="{{ $achievement->faculty_remark }}">
                                        {{ $achievement->faculty_remark }}
                                    </div>
                                @else
                                    <span class="italic text-gray-400 dark:text-gray-600">No remarks</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
