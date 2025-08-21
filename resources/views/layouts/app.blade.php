<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Battambang:wght@100;300;400;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.0/cropper.css">

    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>
</head>

<body>
    <div class="flex ">


        <aside class="w-64 bg-white shadow-2xl rounded-lg px-6 py-8 space-y-6 ">
            <div class=" border-b">
                <h2 class="text-xl font-bold text-green-800">Admin Dashboard</h2>
            </div>
            <nav class="mt-6">


                {{-- <a href="{{ route('dashboard') }}"
                    class="flex items-center p-2 bg-green-200 rounded-l-lg border-l-4 border-green-500 font-semibold">🏠
                    Dashboard</a> --}}
                <a href="{{ route('employee') }}" class="flex items-center p-2">👤 Employees</a>
                <a href="#" class="flex items-center p-2">📈 Attendance</a>
                <a href="{{ route('leave') }}" class="flex items-center p-2">📋 Leave Requests</a>
                <a href="#" class="flex items-center p-2">⚙️ Settings</a>


            </nav>
        </aside>


    </div>
    @livewireScripts
    @yield('content')
</body>


</html>
