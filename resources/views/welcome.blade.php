@extends('layouts.app')

@section('content')
<div class="h-full flex flex-col items-center justify-center py-10 text-center animate-fade-in">
    
    <!-- Hero Header -->
    <div class="mb-16">
        <h1 class="text-4xl sm:text-5xl md:text-4xl font-extrabold tracking-tight text-white leading-tight mb-6">
            Information Management System (IMS)
        </h1>
        <p class="text-[15px] text-[#858585]">
            by <a href="https://fcrit.ac.in" target="_blank" rel="noopener noreferrer" class="text-[#007ACC] hover:text-[#519ABA] hover:underline transition-colors">FCRIT</a>
        </p>
    </div>

    <!-- Cards Container -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full max-w-4xl px-4">
        
        <!-- Student Portal Card -->
        <div class="group relative rounded-2xl bg-[#252526] border border-[#333333] p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_0_20px_rgba(0,122,204,0.2)] hover:border-[#007ACC]/50 flex flex-col items-center text-center">
            
            <div class="w-16 h-16 rounded-xl bg-[#1E1E1E] flex items-center justify-center mb-6 text-[#007ACC] shadow-inner group-hover:scale-110 transition-transform duration-300 border border-[#333333]">
                <i data-lucide="graduation-cap" class="w-8 h-8"></i>
            </div>
            
            <h3 class="text-2xl font-bold text-white mb-3">Student Portal</h3>
            
            <ul class="text-[#969696] text-[15px] mb-8 flex-grow space-y-2">
                <li>Access profile</li>
                <li>Submit achievements</li>
                <li>Track approval status</li>
            </ul>
            
            <a href="{{ route('student.dashboard') }}" class="inline-flex items-center justify-center w-full py-2.5 px-4 bg-[#007ACC] hover:bg-[#006EBA] text-white rounded font-medium transition-colors text-[14px]">
                Continue <i data-lucide="arrow-right" class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <!-- Faculty Portal Card -->
        <div class="group relative rounded-2xl bg-[#252526] border border-[#333333] p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_0_20px_rgba(147,51,234,0.2)] hover:border-purple-500/50 flex flex-col items-center text-center">
            
            <div class="w-16 h-16 rounded-xl bg-[#1E1E1E] flex items-center justify-center mb-6 text-purple-500 shadow-inner group-hover:scale-110 transition-transform duration-300 border border-[#333333]">
                <i data-lucide="shield-user" class="w-8 h-8"></i>
            </div>
            
            <h3 class="text-2xl font-bold text-white mb-3">Faculty Portal</h3>
            
            <ul class="text-[#969696] text-[15px] mb-8 flex-grow space-y-2">
                <li>Review submissions</li>
                <li>Approve or Reject</li>
                <li>View reports</li>
            </ul>
            
            <a href="{{ route('faculty.dashboard') }}" class="inline-flex items-center justify-center w-full py-2.5 px-4 bg-[#1E1E1E] hover:bg-[#2A2D2E] border border-purple-500/30 text-white rounded font-medium transition-colors text-[14px] group-hover:border-purple-500">
                Continue <i data-lucide="arrow-right" class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform text-purple-400"></i>
            </a>
        </div>

    </div>
    
    <!-- Code comment decorative footer -->
    <div class="mt-16 text-[#6A9955] font-mono text-[13px]">
        // Select a portal to begin your session
    </div>
</div>

<style>
    .animate-fade-in {
        animation: fadeIn 0.5s ease-out forwards;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
