@extends('layouts.app')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white tracking-tight">Faculty Dashboard</h2>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Review and manage pending student achievements.</p>
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
    <div class="px-6 py-5 border-b border-gray-200 dark:border-[#333333] flex justify-between items-center bg-gray-50/50 dark:bg-[#252526]">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
            <span class="relative flex h-3 w-3 mr-1">
                @if($pendingAchievements->isNotEmpty())
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-zinc-400 opacity-75"></span>
                @endif
                <span class="relative inline-flex rounded-full h-3 w-3 bg-zinc-500 dark:bg-zinc-400"></span>
            </span>
            Pending Reviews
        </h3>
        <span class="bg-zinc-100 dark:bg-[#333333] text-zinc-800 dark:text-zinc-300 border border-zinc-200 dark:border-zinc-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">
            {{ $pendingAchievements->count() }} total
        </span>
    </div>
    
    @if($pendingAchievements->isEmpty())
        <div class="p-12 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 dark:bg-[#333333] text-gray-400 dark:text-gray-500 mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-1">All caught up!</h4>
            <p class="text-gray-500 dark:text-gray-400 text-sm">There are no pending achievements to review right now.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-[#333333]">
                <thead class="bg-gray-50 dark:bg-[#1E1E1E]">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Student</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Roll No</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Title</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Category</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-[#252526] divide-y divide-gray-200 dark:divide-[#333333]">
                    @foreach($pendingAchievements as $achievement)
                        <tr class="hover:bg-gray-50 dark:hover:bg-[#333333]/50 transition-colors group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 rounded-full bg-zinc-800 dark:bg-[#333333] border border-zinc-700 flex items-center justify-center text-white font-medium text-xs">
                                        {{ substr($achievement->user->name, 0, 1) }}
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $achievement->user->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $achievement->user->studentProfile?->roll_number ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ Str::limit($achievement->title, 30) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-zinc-100 text-zinc-800 dark:bg-[#333333] dark:text-zinc-300 border border-zinc-200 dark:border-zinc-700">
                                    {{ $achievement->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $achievement->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <a href="{{ route('faculty.achievements.show', $achievement->id) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-lg shadow-sm text-white bg-zinc-800 hover:bg-zinc-900 dark:bg-zinc-700 dark:hover:bg-zinc-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-500 dark:focus:ring-offset-[#252526] transition-colors">
                                    Review Details
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
