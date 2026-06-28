<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'IMS') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Theme setup -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* VS Code Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(121, 121, 121, 0.4);
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(100, 100, 100, 0.7);
        }
        /* Hide scrollbar for tabs */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="antialiased bg-white dark:bg-[#1E1E1E] text-[#333333] dark:text-[#D4D4D4] h-screen w-screen overflow-hidden flex flex-col selection:bg-[#ADD6FF] dark:selection:bg-[#264F78] transition-colors duration-200">
    
    @php
        $isWelcome = request()->is('/');
        $isLogin = request()->routeIs('login');
        $isRegister = request()->routeIs('register');
        $isDashboard = request()->routeIs('student.dashboard') || request()->routeIs('faculty.dashboard');
        $isAdminDashboard = request()->routeIs('admin.dashboard');
        
        $currentFile = 'unknown.blade.php';
        if($isWelcome) $currentFile = 'welcome.blade.php';
        elseif($isLogin) $currentFile = 'login.blade.php';
        elseif($isRegister) $currentFile = 'signup.blade.php';
        elseif($isDashboard) $currentFile = 'dashboard.blade.php';
        elseif($isAdminDashboard) $currentFile = 'admin-dashboard.blade.php';
        else $currentFile = 'page.blade.php';
    @endphp

    <!-- Main Workspace -->
    <div class="flex-1 flex overflow-hidden relative">
        
        <!-- Mobile Overlay -->
        <div id="mobile-overlay" class="absolute inset-0 bg-black/50 z-20 hidden md:hidden cursor-pointer"></div>

        <!-- 2. Explorer Panel -->
        <div id="explorer-panel" class="w-64 bg-[#F3F3F3] dark:bg-[#181818] border-r border-[#E5E5E5] dark:border-[#333333] flex flex-col flex-shrink-0 z-30 transition-transform duration-300 absolute md:relative h-full -translate-x-full md:translate-x-0">
            <!-- Explorer Header -->
            <div class="h-9 px-4 flex items-center justify-between text-[11px] font-semibold tracking-wider text-[#6F6F6F] dark:text-[#CCCCCC] uppercase">
                Explorer
                <i data-lucide="more-horizontal" class="w-4 h-4 cursor-pointer hover:text-black dark:hover:text-white"></i>
            </div>

            <!-- College Info -->
            <div class="px-4 py-6 flex flex-col items-center text-center border-b border-[#E5E5E5] dark:border-[#333333] transition-colors duration-200">
                <img src="{{ asset('fcritlogo.png') }}" alt="FCRIT" class="w-16 h-16 object-contain mb-3 drop-shadow-md" />
                <h2 class="text-sm font-bold text-black dark:text-white tracking-wide">FCRIT</h2>
                <p class="text-[11px] text-black font-bold dark:text-[#969696] leading-tight mt-1 uppercase tracking-wider">Information Management System (IMS)</p>
            </div>

            <!-- Collapsible Navigation -->
            <div class="flex-1 overflow-y-auto py-2">
                <!-- Section 1 -->
                <div class="group">
                    <div class="px-1 flex items-center cursor-pointer hover:bg-[#E4E6F1] dark:hover:bg-[#2A2D2E] py-1 text-sm text-[#333333] dark:text-[#CCCCCC]">
                        <i data-lucide="chevron-down" class="w-4 h-4 mr-1"></i>
                        <span class="font-bold text-[11px] uppercase tracking-wider">Navigation</span>
                    </div>
                    <div class="flex flex-col text-[13px] text-[#333333] dark:text-[#CCCCCC]">
                        <a href="/" class="flex items-center px-4 py-1 hover:bg-[#E4E6F1] dark:hover:bg-[#2A2D2E] hover:text-black dark:hover:text-white cursor-pointer {{ $isWelcome ? 'bg-[#E4E6F1] dark:bg-[#37373D] text-black dark:text-white' : '' }}">
                            <i data-lucide="file-code" class="w-4 h-4 mr-2 text-[#519ABA]"></i>
                            welcome.blade.php
                        </a>
                        <a href="{{ route('login') }}" class="flex items-center px-4 py-1 hover:bg-[#E4E6F1] dark:hover:bg-[#2A2D2E] hover:text-black dark:hover:text-white cursor-pointer {{ $isLogin ? 'bg-[#E4E6F1] dark:bg-[#37373D] text-black dark:text-white' : '' }}">
                            <i data-lucide="file-code" class="w-4 h-4 mr-2 text-[#519ABA]"></i>
                            login.blade.php
                        </a>
                        <a href="{{ route('register') }}" class="flex items-center px-4 py-1 hover:bg-[#E4E6F1] dark:hover:bg-[#2A2D2E] hover:text-black dark:hover:text-white cursor-pointer {{ $isRegister ? 'bg-[#E4E6F1] dark:bg-[#37373D] text-black dark:text-white' : '' }}">
                            <i data-lucide="file-code" class="w-4 h-4 mr-2 text-[#519ABA]"></i>
                            signup.blade.php
                        </a>
                        @auth
                        <a href="{{ route('student.dashboard') }}" class="flex items-center px-4 py-1 hover:bg-[#E4E6F1] dark:hover:bg-[#2A2D2E] hover:text-black dark:hover:text-white cursor-pointer {{ $isDashboard ? 'bg-[#E4E6F1] dark:bg-[#37373D] text-black dark:text-white' : '' }}">
                            <i data-lucide="file-code" class="w-4 h-4 mr-2 text-[#519ABA]"></i>
                            dashboard.blade.php
                        </a>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-1 hover:bg-[#E4E6F1] dark:hover:bg-[#2A2D2E] hover:text-black dark:hover:text-white cursor-pointer {{ $isAdminDashboard ? 'bg-[#E4E6F1] dark:bg-[#37373D] text-black dark:text-white' : '' }}">
                            <i data-lucide="file-code" class="w-4 h-4 mr-2 text-[#519ABA]"></i>
                            admin-dashboard.blade.php
                        </a>
                        
                        <!-- Logout Button -->
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="w-full flex items-center px-4 py-1 hover:bg-[#E4E6F1] dark:hover:bg-[#2A2D2E] hover:text-black dark:hover:text-white cursor-pointer text-left text-[#6F6F6F] dark:text-[#969696] focus:outline-none">
                                <i data-lucide="log-out" class="w-4 h-4 mr-2 text-[#F48771]"></i>
                                logout
                            </button>
                        </form>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Main Editor Area -->
        <div class="flex-1 flex flex-col bg-white dark:bg-[#1E1E1E] relative min-w-0 transition-colors duration-200">
            <!-- Tabs -->
            <div class="h-9 bg-[#ECECEC] dark:bg-[#252526] flex items-center overflow-x-auto overflow-y-hidden border-b border-[#E5E5E5] dark:border-[#1E1E1E] scrollbar-hide transition-colors duration-200">
                
                <!-- Hamburger Menu Button (Mobile Only) -->
                <button id="mobile-menu-btn" class="md:hidden sticky left-0 z-10 flex-shrink-0 px-3 h-full flex items-center justify-center bg-[#ECECEC] dark:bg-[#252526] text-[#969696] hover:text-black dark:hover:text-white border-r border-[#E5E5E5] dark:border-[#333333] hover:bg-[#D4D4D4] dark:hover:bg-[#333333] transition-colors">
                    <i data-lucide="menu" class="w-4 h-4"></i>
                </button>

                <!-- IMS Title (Mobile Only) -->
                <div class="md:hidden flex items-center px-4 font-bold text-sm tracking-wider text-[#333333] dark:text-[#CCCCCC]">
                    IMS
                </div>
                
                <!-- Tabs Wrapper -->
                <div class="hidden md:flex h-full items-center">
                    <a href="/" class="h-full px-4 flex items-center {{ $isWelcome ? 'bg-white dark:bg-[#1E1E1E] border-t border-t-[#007ACC] text-[#333333] dark:text-white' : 'bg-[#ECECEC] dark:bg-[#2D2D2D] border-t border-transparent text-[#969696] hover:bg-white dark:hover:bg-[#1E1E1E]' }} cursor-pointer min-w-fit border-r border-[#E5E5E5] dark:border-[#333333] group transition-colors">
                    <i data-lucide="file-code" class="w-4 h-4 mr-2 text-[#519ABA]"></i>
                    <span class="text-[13px] whitespace-nowrap">welcome.blade.php</span>
                    <i data-lucide="x" class="w-3 h-3 ml-3 text-[#969696] hover:text-black dark:hover:text-white hover:bg-[#D4D4D4] dark:hover:bg-[#333333] rounded-md p-0.5 {{ $isWelcome ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }}"></i>
                </a>
                
                <a href="{{ route('login') }}" class="h-full px-4 flex items-center {{ $isLogin ? 'bg-white dark:bg-[#1E1E1E] border-t border-t-[#007ACC] text-[#333333] dark:text-white' : 'bg-[#ECECEC] dark:bg-[#2D2D2D] border-t border-transparent text-[#969696] hover:bg-white dark:hover:bg-[#1E1E1E]' }} cursor-pointer min-w-fit border-r border-[#E5E5E5] dark:border-[#333333] group transition-colors">
                    <i data-lucide="file-code" class="w-4 h-4 mr-2 text-[#519ABA]"></i>
                    <span class="text-[13px] whitespace-nowrap">login.blade.php</span>
                    <i data-lucide="x" class="w-3 h-3 ml-3 text-[#969696] hover:text-black dark:hover:text-white hover:bg-[#D4D4D4] dark:hover:bg-[#333333] rounded-md p-0.5 {{ $isLogin ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }}"></i>
                </a>
                
                <a href="{{ route('register') }}" class="h-full px-4 flex items-center {{ $isRegister ? 'bg-white dark:bg-[#1E1E1E] border-t border-t-[#007ACC] text-[#333333] dark:text-white' : 'bg-[#ECECEC] dark:bg-[#2D2D2D] border-t border-transparent text-[#969696] hover:bg-white dark:hover:bg-[#1E1E1E]' }} cursor-pointer min-w-fit border-r border-[#E5E5E5] dark:border-[#333333] group transition-colors">
                    <i data-lucide="file-code" class="w-4 h-4 mr-2 text-[#519ABA]"></i>
                    <span class="text-[13px] whitespace-nowrap">signup.blade.php</span>
                    <i data-lucide="x" class="w-3 h-3 ml-3 text-[#969696] hover:text-black dark:hover:text-white hover:bg-[#D4D4D4] dark:hover:bg-[#333333] rounded-md p-0.5 {{ $isRegister ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }}"></i>
                </a>
                
                @auth
                <a href="{{ route('student.dashboard') }}" class="h-full px-4 flex items-center {{ $isDashboard ? 'bg-white dark:bg-[#1E1E1E] border-t border-t-[#007ACC] text-[#333333] dark:text-white' : 'bg-[#ECECEC] dark:bg-[#2D2D2D] border-t border-transparent text-[#969696] hover:bg-white dark:hover:bg-[#1E1E1E]' }} cursor-pointer min-w-fit border-r border-[#E5E5E5] dark:border-[#333333] group transition-colors">
                    <i data-lucide="file-code" class="w-4 h-4 mr-2 text-[#519ABA]"></i>
                    <span class="text-[13px] whitespace-nowrap">dashboard.blade.php</span>
                    <i data-lucide="x" class="w-3 h-3 ml-3 text-[#969696] hover:text-black dark:hover:text-white hover:bg-[#D4D4D4] dark:hover:bg-[#333333] rounded-md p-0.5 {{ $isDashboard ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }}"></i>
                </a>
                
                <a href="{{ route('admin.dashboard') }}" class="h-full px-4 flex items-center {{ $isAdminDashboard ? 'bg-white dark:bg-[#1E1E1E] border-t border-t-[#007ACC] text-[#333333] dark:text-white' : 'bg-[#ECECEC] dark:bg-[#2D2D2D] border-t border-transparent text-[#969696] hover:bg-white dark:hover:bg-[#1E1E1E]' }} cursor-pointer min-w-fit border-r border-[#E5E5E5] dark:border-[#333333] group transition-colors">
                    <i data-lucide="file-code" class="w-4 h-4 mr-2 text-[#519ABA]"></i>
                    <span class="text-[13px] whitespace-nowrap">admin-dashboard.blade.php</span>
                    <i data-lucide="x" class="w-3 h-3 ml-3 text-[#969696] hover:text-black dark:hover:text-white hover:bg-[#D4D4D4] dark:hover:bg-[#333333] rounded-md p-0.5 {{ $isAdminDashboard ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }}"></i>
                </a>
                @endauth
                </div>
                
                <!-- Theme Toggle Button in Tabs Bar -->
                <div class="ml-auto pr-4 flex items-center h-full">
                    <button id="theme-toggle" class="text-[#969696] hover:text-black dark:hover:text-white transition-colors p-1.5 rounded-md hover:bg-[#D4D4D4] dark:hover:bg-[#333333]">
                        <i data-lucide="moon" class="w-4 h-4 hidden" id="theme-toggle-dark-icon"></i>
                        <i data-lucide="sun" class="w-4 h-4 hidden" id="theme-toggle-light-icon"></i>
                    </button>
                </div>
            </div>

            <!-- Breadcrumbs -->
            <div class="hidden md:flex h-6 items-center px-4 text-[13px] text-[#6F6F6F] dark:text-[#969696] bg-white dark:bg-[#1E1E1E] border-b border-[#E5E5E5] dark:border-[#333333] transition-colors duration-200">
                <span>ims</span>
                <i data-lucide="chevron-right" class="w-3 h-3 mx-1"></i>
                <span>resources</span>
                <i data-lucide="chevron-right" class="w-3 h-3 mx-1"></i>
                <span>views</span>
                <i data-lucide="chevron-right" class="w-3 h-3 mx-1"></i>
                <span class="text-[#333333] dark:text-[#CCCCCC]">{{ $currentFile }}</span>
            </div>

            <!-- Global Flash Messages -->
            @if(session('success'))
            <div class="bg-[#007ACC]/10 border-b border-[#007ACC]/30 px-6 py-2 flex items-center text-[#519ABA] text-sm font-medium">
                <i data-lucide="check-circle" class="w-4 h-4 mr-2"></i>
                {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div class="bg-red-500/10 border-b border-red-500/30 px-6 py-2 flex items-center text-red-500 dark:text-red-400 text-sm font-medium">
                <i data-lucide="alert-circle" class="w-4 h-4 mr-2"></i>
                {{ session('error') }}
            </div>
            @endif

            <!-- Editor Content Area -->
            <div class="flex-1 flex overflow-hidden relative bg-white dark:bg-[#1E1E1E] transition-colors duration-200">
                
                <!-- Background Grid/Gradient (VS Code aesthetic) -->
                <div class="absolute inset-0 pointer-events-none opacity-[0.03] dark:opacity-[0.03] opacity-[0.05] bg-[linear-gradient(to_right,#000000_1px,transparent_1px),linear-gradient(to_bottom,#000000_1px,transparent_1px)] dark:bg-[linear-gradient(to_right,#ffffff_1px,transparent_1px),linear-gradient(to_bottom,#ffffff_1px,transparent_1px)] bg-[size:48px_48px]"></div>
                
                <!-- Line Numbers -->
                <div class="w-12 flex flex-col items-end py-4 pr-3 bg-white dark:bg-[#1E1E1E] text-[#237893] dark:text-[#858585] text-sm select-none font-mono border-r border-[#E5E5E5] dark:border-[#333333] hidden sm:flex z-10 flex-shrink-0 opacity-70 dark:opacity-50 transition-colors duration-200">
                    @for ($i = 1; $i <= 35; $i++)
                        <div class="leading-[1.7rem]">{{ $i }}</div>
                    @endfor
                </div>

                <!-- Actual View Content (Scrollable) -->
                <div class="flex-1 overflow-auto relative z-10 p-4 sm:p-8">
                    @yield('content')
                </div>
            </div>
        </div>

    </div>

    <!-- 5. Bottom Status Bar -->
    <div class="h-[22px] bg-[#007ACC] text-white flex items-center justify-between px-2 text-[12px] font-medium select-none z-30 flex-shrink-0">
        <!-- Left Side -->
        <div class="flex items-center gap-2 sm:gap-4 h-full">
            <a href="#" class="flex items-center gap-1 hover:bg-white/20 px-1.5 rounded cursor-pointer transition-colors h-full">
                <i data-lucide="users" class="w-3.5 h-3.5"></i>
                <span>Developer Team</span>
            </a>
        </div>
        
        <!-- Right Side -->
        <div class="flex items-center gap-2 sm:gap-4 h-full">
            <span class="flex items-center gap-1 px-1.5"><i data-lucide="clock" class="w-3.5 h-3.5"></i> <span id="vs-time"></span></span>
        </div>
    </div>

    <!-- Initialize Lucide Icons & Time & Theme Toggle -->
    <script>
        lucide.createIcons();
        
        function updateTime() {
            const now = new Date();
            let hours = now.getHours();
            let minutes = now.getMinutes();
            const ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12;
            minutes = minutes < 10 ? '0' + minutes : minutes;
            const timeEl = document.getElementById('vs-time');
            if(timeEl) timeEl.innerText = hours + ':' + minutes + ' ' + ampm;
        }
        setInterval(updateTime, 1000);
        updateTime();

        // Theme Toggle Logic
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        const themeToggleBtn = document.getElementById('theme-toggle');

        if (document.documentElement.classList.contains('dark')) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        themeToggleBtn.addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
        });

        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const explorerPanel = document.getElementById('explorer-panel');
        const mobileOverlay = document.getElementById('mobile-overlay');

        function toggleMenu() {
            if (explorerPanel) {
                explorerPanel.classList.toggle('-translate-x-full');
            }
            if (mobileOverlay) {
                mobileOverlay.classList.toggle('hidden');
            }
        }

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', toggleMenu);
        }
        if (mobileOverlay) {
            mobileOverlay.addEventListener('click', toggleMenu);
        }
    </script>
</body>
</html>
