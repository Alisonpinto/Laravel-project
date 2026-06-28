@extends('layouts.app')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white tracking-tight">Submit Achievement</h2>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Upload a new certificate or record.</p>
    </div>
    <a href="{{ route('student.achievements.index') }}" class="text-sm font-medium text-zinc-600 dark:text-zinc-400 hover:underline">
        &larr; Back to History
    </a>
</div>

<div class="bg-white dark:bg-[#252526] rounded-2xl shadow-sm border border-gray-200 dark:border-[#333333] overflow-hidden w-full max-w-3xl mx-auto">
    <form action="{{ route('student.achievements.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="p-6 sm:p-8 space-y-6">
            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <span class="font-medium">Please fix the following errors:</span>
                    <ul class="mt-1.5 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Achievement Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                    class="block w-full px-3 py-2 sm:text-sm border border-gray-300 dark:border-[#333333] rounded-lg text-gray-900 dark:text-white bg-white dark:bg-[#1E1E1E] focus:outline-none focus:ring-2 focus:ring-zinc-500 dark:focus:ring-zinc-400 transition-shadow" 
                    placeholder="e.g. AWS Certified Solutions Architect">
                @error('title')
                    <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                <select name="category" id="category" required
                    class="block w-full px-3 py-2 sm:text-sm border border-gray-300 dark:border-[#333333] rounded-lg text-gray-900 dark:text-white bg-white dark:bg-[#1E1E1E] focus:outline-none focus:ring-2 focus:ring-zinc-500 dark:focus:ring-zinc-400 transition-shadow">
                    <option value="" disabled selected>Select Category</option>
                    <option value="Internship" {{ old('category') == 'Internship' ? 'selected' : '' }}>Internship</option>
                    <option value="Certificate" {{ old('category') == 'Certificate' ? 'selected' : '' }}>Certificate</option>
                    <option value="Competition" {{ old('category') == 'Competition' ? 'selected' : '' }}>Competition</option>
                    <option value="Paper Publication" {{ old('category') == 'Paper Publication' ? 'selected' : '' }}>Paper Publication</option>
                </select>
                @error('category')
                    <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                <textarea name="description" id="description" rows="4" required
                    class="block w-full px-3 py-2 sm:text-sm border border-gray-300 dark:border-[#333333] rounded-lg text-gray-900 dark:text-white bg-white dark:bg-[#1E1E1E] focus:outline-none focus:ring-2 focus:ring-zinc-500 dark:focus:ring-zinc-400 transition-shadow" 
                    placeholder="Provide details about your achievement...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Upload Proof (PDF/Image)</label>
                <label for="file" id="drop-zone" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-[#333333] border-dashed rounded-xl bg-gray-50 dark:bg-[#1E1E1E] hover:bg-gray-100 dark:hover:bg-[#333333]/50 transition-colors cursor-pointer relative">
                    <div class="space-y-1 text-center pointer-events-none">
                        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex flex-col text-sm text-gray-600 dark:text-gray-400 justify-center items-center">
                            <div class="flex items-center">
                                <span class="text-[#007ACC] font-medium">Upload a file</span>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p id="file-name" class="mt-2 text-xs font-bold text-[#007ACC] dark:text-[#519ABA]"></p>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-500">
                            PNG, JPG, PDF up to 5MB
                        </p>
                    </div>
                    <input id="file" name="file" type="file" class="sr-only" accept=".pdf,.png,.jpg,.jpeg" onchange="document.getElementById('file-name').textContent = this.files[0] ? 'Selected: ' + this.files[0].name : ''">
                </label>
                @error('file')
                    <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
        </div>
        
        <div class="px-6 py-4 bg-gray-50 dark:bg-[#1E1E1E] border-t border-gray-200 dark:border-[#333333] text-right">
            <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-zinc-800 hover:bg-zinc-900 dark:bg-zinc-700 dark:hover:bg-zinc-600 focus:outline-none focus:ring-4 focus:ring-zinc-500/30 transition-all">
                Submit Achievement
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('file');
    const fileNameDisplay = document.getElementById('file-name');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults (e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        dropZone.classList.add('border-[#007ACC]', 'bg-[#E4E6F1]', 'dark:bg-[#2A2D2E]');
    }

    function unhighlight(e) {
        dropZone.classList.remove('border-[#007ACC]', 'bg-[#E4E6F1]', 'dark:bg-[#2A2D2E]');
    }

    dropZone.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        if(files.length > 0) {
            fileInput.files = files;
            fileNameDisplay.textContent = 'Selected: ' + files[0].name;
        }
    }
</script>
@endsection
