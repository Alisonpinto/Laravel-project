@extends('layouts.guest')

@section('content')
<div class="bg-white/80 dark:bg-[#252526]/90 backdrop-blur-xl border border-gray-200 dark:border-[#333333] rounded-3xl shadow-xl overflow-hidden w-full max-w-md mx-auto">
    <div class="px-8 pt-10 pb-8 sm:px-10">
        
        <div class="mb-8 text-center">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Welcome back</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Please enter your details to sign in.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email Address</label>
                <div class="relative">
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="block w-full pl-3 pr-10 py-2.5 sm:text-sm border border-gray-300 dark:border-[#333333] rounded-lg text-gray-900 dark:text-white bg-white dark:bg-[#1E1E1E] focus:outline-none focus:ring-2 focus:ring-zinc-500 dark:focus:ring-zinc-400 focus:border-transparent transition-shadow placeholder-gray-400 dark:placeholder-gray-500" 
                        placeholder="you@example.com">
                </div>
                @error('email')
                    <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password" required
                        class="block w-full pl-3 pr-10 py-2.5 sm:text-sm border border-gray-300 dark:border-[#333333] rounded-lg text-gray-900 dark:text-white bg-white dark:bg-[#1E1E1E] focus:outline-none focus:ring-2 focus:ring-zinc-500 dark:focus:ring-zinc-400 focus:border-transparent transition-shadow placeholder-gray-400 dark:placeholder-gray-500" 
                        placeholder="••••••••">
                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none"
                        onclick="const p = document.getElementById('password'); const eye = document.getElementById('eye-icon-pw-login'); const eyeOff = document.getElementById('eye-off-icon-pw-login'); if (p.type === 'password') { p.type = 'text'; eye.classList.add('hidden'); eyeOff.classList.remove('hidden'); } else { p.type = 'password'; eye.classList.remove('hidden'); eyeOff.classList.add('hidden'); }">
                        <svg id="eye-icon-pw-login" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        <svg id="eye-off-icon-pw-login" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                    </button>
                </div>
                @error('password')
                    <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full flex justify-center items-center px-4 py-3 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-zinc-800 dark:bg-zinc-700 hover:bg-zinc-900 dark:hover:bg-zinc-600 focus:outline-none focus:ring-4 focus:ring-zinc-500/30 transition-all hover:shadow-md">
                    Sign in
                </button>
            </div>
        </form>

        <!-- Quick Login Section -->
        <div class="mt-6 flex flex-col gap-4">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300 dark:border-[#444444]"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-[#F3F4F6] dark:bg-[#252526] text-gray-500 dark:text-gray-400 rounded-full">Or quick login as</span>
                </div>
            </div>
            
            <div class="flex gap-3">
                <button type="button" onclick="document.getElementById('email').value='alisonpinto955@gmail.com'; document.getElementById('password').value='5024148'; document.querySelector('form').submit();" class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 dark:border-[#444444] rounded-lg shadow-sm text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-[#1E1E1E] hover:bg-gray-50 dark:hover:bg-[#2A2D2E] focus:outline-none transition-colors">
                    Student
                </button>
                <button type="button" onclick="document.getElementById('email').value='jawaan2720@gmail.com'; document.getElementById('password').value='5024125'; document.querySelector('form').submit();" class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 dark:border-[#444444] rounded-lg shadow-sm text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-[#1E1E1E] hover:bg-gray-50 dark:hover:bg-[#2A2D2E] focus:outline-none transition-colors">
                    Faculty
                </button>
            </div>
        </div>
    </div>
    
    <div class="px-8 py-5 bg-gray-50 dark:bg-[#1E1E1E] border-t border-gray-200 dark:border-[#333333] text-center">
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Don't have an account? 
            <a href="{{ route('register') }}" class="font-medium text-zinc-800 dark:text-zinc-300 hover:text-zinc-900 dark:hover:text-white transition-colors">Sign up</a>
        </p>
    </div>
</div>
@endsection
