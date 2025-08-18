<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>

<body class="bg-green-100 flex min-h-screen ">
    <div class="flex min-h-screen">
        {{-- <div class="w-64 bg-white shadow-lg">
        
        </div> --}}

        <aside class="w-64 bg-white shadow-2xl rounded-lg px-6 py-8 space-y-6 ">
            <div class=" border-b">
                <h2 class="text-xl font-bold text-green-800">Admin Dashboard</h2>
            </div>
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-6 py-3 text-gray-700 bg-blue-50 border-r-4 border-blue-500">Dashboard</a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-50">Employees</a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-50">Attendance</a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-50">Leave Requests</a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-50">Settings</a>
            </nav>
        </aside>
        <div class="flex-1 flex flex-col">
            <header class="bg-white shadow-sm border-b px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="text-lg font-semibold">Logo</div>
                        <span class="text-gray-600">Welcome Admin</span>
                    </div>
                    <button wire:click="logout" class="text-red-600 hover:text-red-800">Logout</button>
                </div>
            </header>
            {{-- <main class="flex-1 overflow-y-auto p-6">{{ $slot }}</main> --}}
        </div>
    </div>
    @livewireScripts
    @yield('content')
</body>

</html>
