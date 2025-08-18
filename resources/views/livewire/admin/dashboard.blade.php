@extends('layouts.admin')   {{-- your master layout (sardar) --}}

@section('content')
<div class="flex-1 p-8 overflow-auto mt-6 ml-6">   {{-- added margin --}}
    <!-- Main Panel Widgets -->
    <div class="mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card 1: Total Employees -->
            <div class="bg-white rounded-lg p-6 border-2 border-green-100 shadow-md transform transition duration-300 ease-in-out">
                <div class="flex items-center ">
                    <div class="p-3 rounded-full text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 
                                0 0112 0v1zm0 0h6v-1a6 6 
                                0 00-9-5.197m13.5-9a2.5 2.5 
                                0 11-5 0 2.5 2.5 0 015 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">Total Employees</h3>
                        <p class="text-3xl font-bold text-blue-600">{{ $totalEmployees }}</p>
                    </div>
                </div>
            </div>

            <!-- Card 2: Today's Attendance Count -->
            <div class="bg-white rounded-lg p-6 border-green-100 shadow-md transform transition duration-300 ease-in-out">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 
                                0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4 ">
                        <h3 class="text-lg font-semibold text-gray-900">Today's Attendance Count</h3>
                        <p class="text-3xl font-bold text-green-600">{{ $todayAttendance }}</p>
                    </div>
                </div>
            </div>

            <!-- Card 3: Pending Leave Requests -->
            <div class="bg-white rounded-lg  p-6 border-green-100 shadow-md transform transition duration-300 ease-in-out">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 
                                0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">Pending Leave Requests</h3>
                        <p class="text-3xl font-bold text-yellow-600">{{ $pendingLeaves }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today's Attendance Table -->
        <div class="bg-white rounded-lg shadow mt-6">
            <div class="px-6 py-4 border-b bg-blue-200 border-gray-200">
                <h3 class="text-lg font-semibold  text-gray-900">Today's Attendance List</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-in</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-out</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($attendanceRecords as $record)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $record->user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $record->check_in_time ? \Carbon\Carbon::parse($record->check_in_time)->format('g:i A') : '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $record->check_out_time ? \Carbon\Carbon::parse($record->check_out_time)->format('g:i A') : '-' }}
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
    </div>
</div>
@endsection
