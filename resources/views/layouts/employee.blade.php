<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <div class="w-64 bg-green-100 shadow-lg">
            <div class="p-4">
                <h2 class="text-xl font-bold text-gray-800">BookBase</h2>
            </div>
            <nav class="mt-8">
                <a href=" " class="flex items-center px-4 py-2 text-gray-700 hover:bg-green-200">Dashboard</a>
                <a href=" " class="flex items-center px-4 py-2 text-gray-700 hover:bg-green-200">Leave & Request</a>
            </nav>
        </div>
        <div class="flex-1 overflow-y-auto"> </div>
    </div>
    @livewireScripts
    @yield('content')
</body>
</html>