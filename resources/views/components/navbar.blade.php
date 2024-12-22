<header class="shadow-lg p-4 flex items-center justify-between">
    <a href="{{route('index')}}" class="text-xl font-semibold">Track rental</a>
    <div class="gap-5 flex">
        @auth

            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <a href="#" onclick="document.getElementById('logout-form').submit();">
                    Log out
                </a>
            </form>
        @endauth
        @guest
            <a href="{{ route('login') }}">Log in</a>
            <a href="{{ route('register') }}">Register</a>
        @endguest
    </div>

    <button id="hamburger-btn" class="text-gray-700 focus:outline-none md:hidden" onclick="toggleSidebar()">
        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</header>

<script>
    function toggleSidebar(){
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    }
</script>
