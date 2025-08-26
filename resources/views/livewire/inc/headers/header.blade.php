<header class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
    <!-- Logo / Brand -->
    <div class="flex items-center  gap-8">
        <img src="image/image.png" alt="Logo" class="h-10 w-10 rounded-full">
        <h1 class="text-xl font-bold text-gray-800">PTD</h1>


         <div class="mb-2 px-8  ">
        <div class="flex items-center  space-x-8">
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
        <nav class="hidden md:flex gap-4">
            <a href="/" class="text-gray-600 hover:text-gray-900 transition">Home</a>
            <a href="#" class="text-gray-600 hover:text-gray-900 transition">Profile</a>
            <a href="#" class="text-gray-600 hover:text-gray-900 transition">Settings</a>
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
