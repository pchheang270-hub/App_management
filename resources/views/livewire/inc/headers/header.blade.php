<header class="bg-gray-100 shadow-md px-6 py-4 flex justify-between items-center">
    <!-- Logo / Brand -->
    <div class="flex items-center gap-2">
        <img src="image/image.png" alt="Logo" class="h-10 w-10 rounded-full">



        <div class="mb-2 ">
            <div class="flex items-center  space-x-4">
                {{-- <div class="text-lg font-semibold">Logo</div> --}}
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
        <!-- Example nav links -->
        <nav class="hidden md:flex gap-6 items-center">
            <a href="/" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 transition">
                <i class="fas fa-house"></i>
                {{-- <span>Home</span> --}}
            </a>

            <a href="/profile" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 transition">
                <i class="fas fa-user-circle"></i>
                {{-- <span>Profile</span> --}}
            </a>

            <a href="/settings" class="flex items-center gap-2 text-gray-600 hover:text-gray-900 transition">
                <i class="fas fa-cog"></i>
                {{-- <span>Settings</span> --}}
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
