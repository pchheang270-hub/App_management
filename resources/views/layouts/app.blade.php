<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- @livewireStyles --}}

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    {{-- <script src="https://cdn.tiny.cloud/1/YOUR_REAL_API_KEY/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Battambang:wght@100;300;400;700;900&display=swap">
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.0/cropper.css">

    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>
    @livewireStyles
</head>

<body class="bg-green-100">

    {{-- Show header & sidebar only if not on home --}}
    @if (!Request::is('home') && !Request::is('/'))
        <div>
            <livewire:inc.headers.header />
        </div>

        <div class="flex min-h-screen">
            <livewire:inc.sidebar.sidebar />
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    @else
        {{-- Home page (no header, no sidebar) --}}
        <main class="w-full p-6">
            @yield('content')
        </main>
    @endif

</body>


</html>
