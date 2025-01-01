<!-- Top Bar -->
<header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 lg:px-8">
    <!-- Page Title -->
    <div class="flex items-center">
        <button type="button" class="lg:hidden -ml-2 mr-2 p-2 rounded-md text-gray-500 hover:text-gray-600">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <!-- Right Section -->
    <div class="flex items-center space-x-4 relative">
        <!-- User Profile Dropdown -->
        <div class="relative">
            <button id="userMenuButton" class="flex items-center space-x-3 focus:outline-none">
                <div class="w-8 h-8 rounded-full bg-black flex items-center justify-center text-white font-semibold">
                    F
                </div>
            </button>
            <!-- Dropdown Menu -->
            <div id="userDropdown" class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5">
                <div class="px-4 py-2 border-b border-gray-100">
                    <div class="text-sm font-medium text-gray-900"></div>
                    <div class="text-sm text-gray-500">{{Auth::User()->name}}</div>
                </div>
                <a href="{{route('dashboard.profile.edit')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Perfil
                </a>
                <a href="{{route('dashboard.profile.edit.password')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Alterar senha
                </a>
                <a href="{{route('logout')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Sair
                </a>
            </div>
        </div>
    </div>
</header>
