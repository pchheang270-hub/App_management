<div class="flex-1 p-8 overflow-auto">

    <!-- ========================== HEADER ========================== -->
    <div class="m-4">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard Management</h1>
        <p class="text-gray-500">Track employee attendance and manage leave requests</p>
    </div>

    <!-- ========================== TOP STATS (Only for Admin) ========================== -->
    @if (auth()->user()->role === 'admin')
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

            <!-- Total Employees -->
            <div class="bg-white rounded-lg shadow p-6 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Total Employees</h3>
                    <p class="text-2xl font-bold text-blue-600">{{ $totalEmployees }}</p>
                    <span class="text-xs text-green-600">+2 this month</span>
                </div>
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-users text-xl"></i>
                </div>
            </div>

            <!-- Today's Attendance -->
            <div class="bg-white rounded-lg shadow p-6 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Today's Attendance</h3>
                    <p class="text-2xl font-bold text-green-600">{{ $todayAttendance }}</p>
                    <span class="text-xs text-green-600">75% present</span>
                </div>
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-calendar-check text-xl"></i>
                </div>
            </div>

            <!-- Pending Leaves -->
            <div class="bg-white rounded-lg shadow p-6 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Pending Leave Requests</h3>
                    <p class="text-2xl font-bold text-yellow-600">{{ $pendingLeaves }}</p>
                    <span class="text-xs text-orange-600">Needs review</span>
                </div>
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-hourglass-half text-xl"></i>
                </div>
            </div>

            <!-- This Month Hours -->
            <div class="bg-white rounded-lg shadow p-6 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">This Month Hours</h3>
                    <p class="text-2xl font-bold text-purple-600">{{ $thisMonthHours }}</p>
                    <span class="text-xs {{ $monthComparison >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $monthComparison >= 0 ? '+' : '' }}{{ $monthComparison }}% vs last month
                    </span>
                </div>
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-chart-line text-xl"></i>
                </div>
            </div>

        </div>
    @endif

    <!-- ========================== QUICK ACTION BUTTONS ========================== -->
    <div class="bg-white rounded-lg shadow p-4 mb-8 flex flex-wrap items-center gap-4">
        <button wire:click="checkIn" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg shadow">
            ✅ Check-In
        </button>

        <button wire:click="checkOut" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg shadow">
            ⛔️ Check-Out
        </button>

        <button class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded-lg shadow">
            <i class="fas fa-user-plus"></i> Add Employee
        </button>

        <button class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded-lg shadow">
            <i class="fas fa-download"></i> Export Report
        </button>
    </div>

    <!-- ========================== FLASH MESSAGES ========================== -->
    @if (session()->has('message'))
        <div class="mt-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded text-center">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mt-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded text-center">
            {{ session('error') }}
        </div>
    @endif

    <!-- ========================== CONTENT GRID ========================== -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- ====== LEFT SIDE: Attendance List ====== -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow">
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="text-lg font-semibold">Today's Attendance List</h2>
                <div class="flex items-center gap-2">
                    <button class="text-gray-500 text-sm border bg-green-200 px-2 py-1 rounded">Filter</button>
                    <button class="text-gray-500 text-sm border bg-red-300 px-2 py-1 rounded">View All</button>
                </div>
            </div>

            <!-- Attendance Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Employee</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Check-In</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Check-Out</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($attendanceRecords as $record)
                            <tr>
                                <!-- Employee Name + Avatar -->
                                <td class="px-4 py-2 flex items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name={{ $record->user->name }}"
                                        class="w-8 h-8 rounded-full">
                                    {{ $record->user->name }}
                                </td>

                                <!-- Check-In Time -->
                                <td class="px-4 py-2">
                                    {{ $record->check_in_time ? \Carbon\Carbon::parse($record->check_in_time)->format('g:i A') : '-' }}
                                </td>

                                <!-- Check-Out Time -->
                                <td class="px-4 py-2">
                                    {{ $record->check_out_time ? \Carbon\Carbon::parse($record->check_out_time)->format('g:i A') : '-' }}
                                </td>

                                <!-- Status -->
                                <td class="px-4 py-2">
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-600">
                                        Present
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-2 text-center text-gray-500">
                                    No attendance records for today
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ====== RIGHT SIDE: Sidebar (Admin only) ====== -->
        @if (auth()->user()->role === 'admin')
            <div class="flex flex-col gap-6">

                <!-- Recent Leave Requests -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-4 border-b">
                        <h2 class="text-lg font-semibold">Recent Leave Requests</h2>
                    </div>
                    <div class="p-4 space-y-3">
                        @forelse($recentLeaves as $leave)
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="font-medium">{{ $leave->user->name }}</p>
                                    <p class="text-sm text-gray-500">
                                        {{ ucfirst($leave->type) }} - {{ $leave->days }} days
                                        ({{ \Carbon\Carbon::parse($leave->start_date)->format('M d') }}
                                        - {{ \Carbon\Carbon::parse($leave->end_date)->format('M d') }})
                                    </p>
                                </div>
                                <!-- Status Badge -->
                                <span
                                    class="px-2 py-1 text-xs rounded
                                    @if ($leave->status === 'pending') bg-yellow-100 text-yellow-600
                                    @elseif($leave->status === 'approved') bg-green-100 text-green-600
                                    @else bg-red-100 text-red-600 @endif">
                                    {{ ucfirst($leave->status) }}
                                </span>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">No recent leave requests</p>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-lg font-semibold mb-3">Recent Activities</h2>
                    @forelse ($recentActivities as $activity)
                        <div class="flex items-start space-x-2 mb-2">
                            <!-- Colored Dot -->
                            <div class="mt-1">
                                <span class="inline-block w-2 h-2 rounded-full bg-{{ $activity['color'] }}-500"></span>
                            </div>
                            <!-- Activity Info -->
                            <div>
                                <p class="font-medium">{{ $activity['description'] }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ $activity['name'] }} —
                                    {{ \Carbon\Carbon::parse($activity['created_at'])->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No recent activities</p>
                    @endforelse
                </div>

            </div>
        @endif

    </div>
</div>

<!-- Livewire Assets -->
@livewireScripts
@livewireStyles
