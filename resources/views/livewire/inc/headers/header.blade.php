<div class="ml-64">
<header
    class="fixed top-0 left-64 right-0 h-16 bg-white shadow flex items-center justify-between px-6 z-50">
    <!-- Logo / Brand -->
    <div class="flex items-center gap-2">
        <img src="image/image.png" alt="Logo" class="h-10 w-10 rounded-full">

        <div>
            <div class="flex items-center space-x-4">
                @if (session('user_role') === 'admin')
                    <h1 class="text-2xl font-bold text-gray-800">Welcome Admin</h1>
                @elseif (session('user_role') === 'employee')
                    <h1 class="text-2xl font-bold text-gray-800">Welcome Employee</h1>
                @endif
            </div>
        </div>
    </div>

    <!-- Navigation & Logout -->
    <div class="flex items-center gap-4">
        <!-- Nav links -->
        <nav class="hidden md:flex gap-6 items-center">
            <a href="/profile" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 transition">
                <i class="fas fa-user-circle"></i>
            </a>
            <a href="/settings" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 transition">
                <i class="fas fa-cog"></i>
            </a>
        </nav>

        <!-- Logout Button -->
        <div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg text-red-600 hover:bg-red-100 transition">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
</header>
</div>