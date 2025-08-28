<div class="min-h-screen w-64 bg-gray-100 shadow-xl flex flex-col" style="box-shadow: 0 4px 12px rgba(0,0,0,0.3);">
    <!-- Logo / Title -->
    <div class="px-6 py-4 border-b">
        <h1 class="text-xl font-extrabold text-blue-800 tracking-wide">
            @if(auth()->user()->role === 'admin')
                Admin Dashboard
            @else
                Employee Dashboard
            @endif
        </h1>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-2">
        <!-- Dashboard - Available to all authenticated users -->
        <a href="{{route('dashboard')}}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition">
            <i class="fa-solid fa-house"></i>
            <span>Dashboard</span>
        </a>
       
        <!-- Admin-only menu items -->
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('employee') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition">
                <i class="fa-solid fa-users"></i>
                <span>Employees</span>
            </a>

            <a href="#"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition">
                <i class="fa-solid fa-calendar-check"></i>
                <span>Attendance</span>
            </a>
        @endif

        <!-- Leave Requests - Available to all authenticated users -->
        <a href="{{ route('leave') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition">
            <i class="fa-solid fa-file-circle-check"></i>
            <span>Leave Requests</span>
        </a>

        <!-- Admin-only Settings -->
        @if(auth()->user()->role === 'admin')
            <a href="#"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition">
                <i class="fa-solid fa-gear"></i>
                <span>Settings</span>
            </a>
        @endif
    </nav>

    <!-- Footer -->
    <div class="px-4 py-4 border-t">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-3 w-full px-3 py-2 rounded-lg text-red-600 hover:bg-red-100 transition">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</div>


