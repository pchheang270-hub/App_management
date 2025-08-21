<div class="min-h-screen bg-white-800" >
<aside class="">
        <h1 class="text-2xl font-bold text-blue-800"></h1>

        <nav class="space-y-6 ">
            <a href="{{route(dashboard)}}" class="flex items-center gap-2 text-gray-700 hover:text-blue-600">
                <x-heroicon-o-home class="w-5 h-5" />
                Dashboard
            </a>


            <a href="{{ route('employee') }}" class="flex items-center gap-2 text-gray-700 hover:text-blue-600">
                <x-heroicon-o-users class="w-5 h-5" />
                Employees
            </a>

            <a href="{{ route('') }}" class="flex items-center gap-2 text-gray-700 hover:text-blue-600">
                <x-heroicon-o-clipboard-document class="w-5 h-5" />
                Attendance
            </a>

            <a href="{{ route('leave') }}" class="flex items-center gap-2 text-gray-700 hover:text-blue-600">
                <x-heroicon-o-clipboard-document-check class="w-5 h-5" />
                Leave Requests
            </a>


            <a href="{{ route('') }}" class="flex items-center gap-2 text-gray-700 hover:text-blue-600">
                <x-heroicon-o-cog-6-tooth class="w-5 h-5" />
                Settings
            </a>
        </nav>
    </aside>

    
</div>