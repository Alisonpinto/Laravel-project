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
    
    <!-- Force Dark Mode for VS Code look -->
    <script>
        document.documentElement.classList.add('dark');
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
<body class="antialiased bg-[#1E1E1E] text-[#D4D4D4] h-screen w-screen overflow-hidden flex flex-col selection:bg-[#264F78]">
    
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
    <div class="flex-1 flex overflow-hidden">
        


        <!-- 2. Explorer Panel -->
        <div class="w-64 bg-[#181818] border-r border-[#333333] flex flex-col flex-shrink-0 z-10">
            <!-- Explorer Header -->
            <div class="h-9 px-4 flex items-center justify-between text-[11px] font-semibold tracking-wider text-[#CCCCCC] uppercase">
                Explorer
                <i data-lucide="more-horizontal" class="w-4 h-4 cursor-pointer hover:text-white"></i>
            </div>

            <!-- College Info -->
            <div class="px-4 py-6 flex flex-col items-center text-center border-b border-[#333333]">
                <img src="{{ asset('fcritlogo.png') }}" alt="FCRIT" class="w-16 h-16 object-contain mb-3 drop-shadow-md" />
                <h2 class="text-sm font-bold text-white tracking-wide">FCRIT</h2>
                <p class="text-[11px] text-[#969696] leading-tight mt-1 uppercase tracking-wider">Information Management System</p>
            </div>

            <!-- Collapsible Navigation -->
            <div class="flex-1 overflow-y-auto py-2">
                <!-- Section 1 -->
                <div class="group">
                    <div class="px-1 flex items-center cursor-pointer hover:bg-[#2A2D2E] py-1 text-sm text-[#CCCCCC]">
                        <i data-lucide="chevron-down" class="w-4 h-4 mr-1"></i>
                        <span class="font-bold text-[11px] uppercase tracking-wider">Navigation</span>
                    </div>
                    <div class="flex flex-col text-[13px] text-[#CCCCCC]">
                        <a href="/" class="flex items-center px-4 py-1 hover:bg-[#2A2D2E] hover:text-white cursor-pointer {{ $isWelcome ? 'bg-[#37373D] text-white' : '' }}">
                            <i data-lucide="file-code" class="w-4 h-4 mr-2 text-[#519ABA]"></i>
                            welcome.blade.php
                        </a>
                        <a href="{{ route('login') }}" class="flex items-center px-4 py-1 hover:bg-[#2A2D2E] hover:text-white cursor-pointer {{ $isLogin ? 'bg-[#37373D] text-white' : '' }}">
                            <i data-lucide="file-code" class="w-4 h-4 mr-2 text-[#519ABA]"></i>
                            login.blade.php
                        </a>
                        <a href="{{ route('register') }}" class="flex items-center px-4 py-1 hover:bg-[#2A2D2E] hover:text-white cursor-pointer {{ $isRegister ? 'bg-[#37373D] text-white' : '' }}">
                            <i data-lucide="file-code" class="w-4 h-4 mr-2 text-[#519ABA]"></i>
                            signup.blade.php
                        </a>
                        @auth
                        <a href="{{ route('student.dashboard') }}" class="flex items-center px-4 py-1 hover:bg-[#2A2D2E] hover:text-white cursor-pointer {{ $isDashboard ? 'bg-[#37373D] text-white' : '' }}">
                            <i data-lucide="file-code" class="w-4 h-4 mr-2 text-[#519ABA]"></i>
                            dashboard.blade.php
                        </a>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-1 hover:bg-[#2A2D2E] hover:text-white cursor-pointer {{ $isAdminDashboard ? 'bg-[#37373D] text-white' : '' }}">
                            <i data-lucide="file-code" class="w-4 h-4 mr-2 text-[#519ABA]"></i>
                            admin-dashboard.blade.php
                        </a>
                        
                        <!-- Logout Button -->
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="w-full flex items-center px-4 py-1 hover:bg-[#2A2D2E] hover:text-white cursor-pointer text-left text-[#969696] focus:outline-none">
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
        <div class="flex-1 flex flex-col bg-[#1E1E1E] relative min-w-0">
            <!-- Tabs -->
            <div class="h-9 bg-[#252526] flex items-center overflow-x-auto overflow-y-hidden border-b border-[#1E1E1E] scrollbar-hide">
                
                <a href="/" class="h-full px-4 flex items-center {{ $isWelcome ? 'bg-[#1E1E1E] border-t border-t-[#007ACC] text-white' : 'bg-[#2D2D2D] border-t border-transparent text-[#969696] hover:bg-[#1E1E1E]' }} cursor-pointer min-w-fit border-r border-[#333333] group">
                    <i data-lucide="file-code" class="w-4 h-4 mr-2 text-[#519ABA]"></i>
                    <span class="text-[13px] whitespace-nowrap">welcome.blade.php</span>
                    <i data-lucide="x" class="w-3 h-3 ml-3 text-[#969696] hover:text-white hover:bg-[#333333] rounded-md p-0.5 {{ $isWelcome ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }}"></i>
                </a>
                
                <a href="{{ route('login') }}" class="h-full px-4 flex items-center {{ $isLogin ? 'bg-[#1E1E1E] border-t border-t-[#007ACC] text-white' : 'bg-[#2D2D2D] border-t border-transparent text-[#969696] hover:bg-[#1E1E1E]' }} cursor-pointer min-w-fit border-r border-[#333333] group">
                    <i data-lucide="file-code" class="w-4 h-4 mr-2 text-[#519ABA]"></i>
                    <span class="text-[13px] whitespace-nowrap">login.blade.php</span>
                    <i data-lucide="x" class="w-3 h-3 ml-3 text-[#969696] hover:text-white hover:bg-[#333333] rounded-md p-0.5 {{ $isLogin ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }}"></i>
                </a>
                
                <a href="{{ route('register') }}" class="h-full px-4 flex items-center {{ $isRegister ? 'bg-[#1E1E1E] border-t border-t-[#007ACC] text-white' : 'bg-[#2D2D2D] border-t border-transparent text-[#969696] hover:bg-[#1E1E1E]' }} cursor-pointer min-w-fit border-r border-[#333333] group">
                    <i data-lucide="file-code" class="w-4 h-4 mr-2 text-[#519ABA]"></i>
                    <span class="text-[13px] whitespace-nowrap">signup.blade.php</span>
                    <i data-lucide="x" class="w-3 h-3 ml-3 text-[#969696] hover:text-white hover:bg-[#333333] rounded-md p-0.5 {{ $isRegister ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }}"></i>
                </a>
                
                @auth
                <a href="{{ route('student.dashboard') }}" class="h-full px-4 flex items-center {{ $isDashboard ? 'bg-[#1E1E1E] border-t border-t-[#007ACC] text-white' : 'bg-[#2D2D2D] border-t border-transparent text-[#969696] hover:bg-[#1E1E1E]' }} cursor-pointer min-w-fit border-r border-[#333333] group">
                    <i data-lucide="file-code" class="w-4 h-4 mr-2 text-[#519ABA]"></i>
                    <span class="text-[13px] whitespace-nowrap">dashboard.blade.php</span>
                    <i data-lucide="x" class="w-3 h-3 ml-3 text-[#969696] hover:text-white hover:bg-[#333333] rounded-md p-0.5 {{ $isDashboard ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }}"></i>
                </a>
                
                <a href="{{ route('admin.dashboard') }}" class="h-full px-4 flex items-center {{ $isAdminDashboard ? 'bg-[#1E1E1E] border-t border-t-[#007ACC] text-white' : 'bg-[#2D2D2D] border-t border-transparent text-[#969696] hover:bg-[#1E1E1E]' }} cursor-pointer min-w-fit border-r border-[#333333] group">
                    <i data-lucide="file-code" class="w-4 h-4 mr-2 text-[#519ABA]"></i>
                    <span class="text-[13px] whitespace-nowrap">admin-dashboard.blade.php</span>
                    <i data-lucide="x" class="w-3 h-3 ml-3 text-[#969696] hover:text-white hover:bg-[#333333] rounded-md p-0.5 {{ $isAdminDashboard ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }}"></i>
                </a>
                @endauth
            </div>

            <!-- Breadcrumbs -->
            <div class="h-6 flex items-center px-4 text-[13px] text-[#969696] bg-[#1E1E1E] border-b border-[#333333]">
                <span>ims</span>
                <i data-lucide="chevron-right" class="w-3 h-3 mx-1"></i>
                <span>resources</span>
                <i data-lucide="chevron-right" class="w-3 h-3 mx-1"></i>
                <span>views</span>
                <i data-lucide="chevron-right" class="w-3 h-3 mx-1"></i>
                <span class="text-[#CCCCCC]">{{ $currentFile }}</span>
            </div>

            <!-- Editor Content Area -->
            <div class="flex-1 flex overflow-hidden relative bg-[#1E1E1E]">
                
                <!-- Background Grid/Gradient (VS Code aesthetic) -->
                <div class="absolute inset-0 pointer-events-none opacity-[0.03] bg-[linear-gradient(to_right,#ffffff_1px,transparent_1px),linear-gradient(to_bottom,#ffffff_1px,transparent_1px)] bg-[size:48px_48px]"></div>
                
                <!-- Line Numbers -->
                <div class="w-12 flex flex-col items-end py-4 pr-3 bg-[#1E1E1E] text-[#858585] text-sm select-none font-mono border-r border-[#333333] hidden sm:flex z-10 flex-shrink-0 opacity-50">
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
        </div>
    </div>

    <!-- Initialize Lucide Icons & Time -->
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
            document.getElementById('vs-time').innerText = hours + ':' + minutes + ' ' + ampm;
        }
        setInterval(updateTime, 1000);
        updateTime();
    </script>
</body>
</html>
