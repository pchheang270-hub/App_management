
    <div class=" flex-auto flex-col">

        {{-- <main class="flex-1 overflow-y-auto p-6">{{ $slot }}</main> --}}
    </div>
    <div class="flex-1 p-8 overflow-auto mt-6 ml-6">

        {{-- Role Greeting --}}
       
        <!-- Main Widgets -->

        <!-- Main Widgets -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            @if (session('user_role') === 'admin')
                <!-- Total Employees -->
                <div class="bg-white rounded-lg p-6 border-2 border-green-100 shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full text-blue-600">
                            <!-- SVG icon -->
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Total Employees</h3>
                            <p class="text-3xl font-bold text-blue-600">{{ $totalEmployees }}</p>
                        </div>
                    </div>
                </div>

                <!-- Today's Attendance -->
                <div class="bg-white rounded-lg p-6 border-green-100 shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <!-- SVG icon -->
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Today's Attendance</h3>
                            <p class="text-3xl font-bold text-green-600">{{ $todayAttendance }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Pending Leave Requests (admin only) -->
            @if (session('user_role') === 'admin')
                <div class="bg-white rounded-lg p-6 border-green-100 shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                            <!-- SVG icon -->
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Pending Leave Requests</h3>
                            <p class="text-3xl font-bold text-yellow-600">{{ $pendingLeaves }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>


        <!-- Check-In / Out + Attendance Table (shared for all roles) -->
        <div class="flex flex-col gap-6">
           {{-- {{ dd($attendanceRecords) }} --}}
         

            <div class="flex gap-4 justify-center mt-6">
                <button wire:click="checkIn" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg shadow">
                    ✅ Check-In
                 
                </button>

                <button wire:click="checkOut" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg shadow">
                    ⛔️ Check-Out
                </button>
            </div>

            @if (session()->has('message'))
                <div class="mt-4 p-4 bg-blue-100 border border-blue-300 text-blue-800 rounded text-center">
                    {{ session('message') }}
                </div>
            @endif




            <!-- Attendance Table -->
            <div class="bg-white rounded-lg shadow mt-6">
                <div class="px-6 py-4 border-b bg-blue-200 border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Today's Attendance List</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-green-300">
                            <tr>
                                <th class="px-4 py-2 text-left">Name</th>
                                <th class="px-4 py-2 text-left">Check-In</th>
                                <th class="px-4 py-2 text-left">Check-Out</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($attendanceRecords as $record)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $record->user->name }}</td>
                                    <td class="px-6 py-4">
                                        {{ $record->check_in ? \Carbon\Carbon::parse($record->check_in)->format('g:i A') : '-' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $record->check_out ? \Carbon\Carbon::parse($record->check_out)->format('g:i A') : '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                        No attendance records for today
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
       

            <!-- Link to Leave Request Page for Employee -->
            {{-- @if (session('user_role') === 'employee')
                <div class="mt-4 text-right">
                    <a href="{{ route('employee') }}" class="text-blue-600 hover:underline font-medium">
                        👉 View Your Leave Requests
                    </a>
                </div>
            @endif --}}
        </div>
        @livewireScripts
        @livewireStyles

    </div>
