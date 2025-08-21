<div>

    <div x-data="{ open: false }" class="relative inline-block text-left">
        <button @click="open = !open"
            class="flex items-center space-x-2 px-4 py-2 bg-gray-100 text-gray-700 rounded hover:bg-gray-200 focus:outline-none">
            <span>{{ Auth::user()->name }}</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- Dropdown Menu -->
        <div x-show="open" @click.away="open = false" x-transition
            class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg z-50">
            <a href="{{ route('profile') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                Profile
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">
                    Logout
                </button>
            </form>
        </div>
    </div>


    <div class="text-center">
        <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-500">
            Already have an account? Login
        </a>
    </div>
</div>
