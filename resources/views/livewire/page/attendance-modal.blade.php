<div class="flex-1 p-8 overflow-auto">
    {{-- Header --}}
    <div class="">
        <div class="flex items-center justify-between">
            <div class="m-4">
                <h1 class="text-3xl font-bold text-gray-900​">Attendance Management</h1>
                <p class="text-gray-500">Track employee attendance and manage leave requests</p>
            </div>

            <div class="flex gap-2">
                @foreach (['today' => 'Today', 'week' => 'This Week', 'month' => 'This Month', 'year' => 'This Year'] as $key => $label)
                    <button wire:click="setPeriod('{{ $key }}')"
                        class="px-3 py-2 rounded-lg border transition
                        {{ $selectedPeriod === $key
                            ? 'bg-green-600 text-white border-green-600'
                            : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">

            {{-- Total Employees --}}
            <div class="bg-white text-blue-800 p-6 rounded-xl shadow-lg flex items-center space-x-4">
                <div class="text-4xl">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <div class="text-lg font-semibold">Total Employees</div>
                    <div class="text-3xl font-bold">{{ $stats['totalEmployees'] }}</div>
                </div>
            </div>

            {{-- Records in Period --}}
            <div class="bg-white text-blue-800 p-6 rounded-xl shadow-lg flex items-center space-x-4">
                <div class="text-4xl">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div>
                    <div class="text-lg font-semibold">Records in Period</div>
                    <div class="text-3xl font-bold">{{ $stats['totalRecords'] }}</div>
                </div>
            </div>

            {{-- Present --}}
            <div class="bg-white text-green-800 p-6 rounded-xl shadow-lg flex items-center space-x-4">
                <div class="text-4xl">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <div class="text-lg font-semibold">Present</div>
                    <div class="text-3xl font-bold">{{ $stats['present'] }}</div>
                </div>
            </div>

            {{-- Absent --}}
            <div class="bg-white text-red-800 p-6 rounded-xl shadow-lg flex items-center space-x-4">
                <div class="text-4xl">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div>
                    <div class="text-lg font-semibold">Absent</div>
                    <div class="text-3xl font-bold">{{ $stats['absent'] }}</div>
                </div>
            </div>

            {{-- Late --}}
            <div class="bg-white text-yellow-800 p-6 rounded-xl shadow-lg flex items-center space-x-4">
                <div class="text-4xl">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <div class="text-lg font-semibold">Late</div>
                    <div class="text-3xl font-bold">{{ $stats['late'] }}</div>
                </div>
            </div>

            {{-- No Check-Out --}}
            <div class="bg-white text-purple-800 p-6 rounded-xl shadow-lg flex items-center space-x-4">
                <div class="text-4xl">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <div>
                    <div class="text-lg font-semibold">No Check-Out</div>
                    <div class="text-3xl font-bold">{{ $stats['noCheckOut'] }}</div>
                </div>
            </div>

        </div>



        {{-- Tabs --}}
        <div>
            <div class="flex gap-6 border-gray-300 m-6">
                <button wire:click="setTab('attendance')"
                    class="pb-3 -mb-px border-b-2 {{ $activeTab === 'attendance' ? 'border-green-600 text-gray-900' : 'border-transparent text-gray-500' }}">
                    Attendance Records
                </button>
                <button wire:click="setTab('leave')"
                    class="pb-3 -mb-px border-b-2 {{ $activeTab === 'leave' ? 'border-green-600 text-gray-900' : 'border-transparent text-gray-500' }}">
                    Leave Requests
                </button>
            </div>

            {{-- Attendance Table --}}
            @if ($activeTab === 'attendance')
                <div class="bg-white rounded-lg shadow mt-6">
                    <div class="p-2 border-b ">
                        <h2 class="font-semibold">Attendance - {{ ucfirst($selectedPeriod) }}</h2>
                        <p class="text-sm text-gray-500">Detailed records for selected period</p>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse bg-white shadow rounded-lg overflow-hidden">
                            <thead>
                                <tr class="text-left bg-gradient-to-r from-gray-100 to-blue-100 rounded-t-lg">
                                    <th class="text-left px-4 py-3 border">Employee</th>
                                    <th class="text-left px-4 py-3 border">Check-in</th>
                                    <th class="text-left px-4 py-3 border">Check Out</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @forelse ($attendanceRecords as $record)
                                    <tr>
                                        <td class="px-4 py-3 font-medium border">{{ $record->user->name }}</td>
                                        <td class="px-4 py-3 border">{{ $record->check_in_time ?? '-' }}</td>
                                        <td class="px-4 py-3 border">{{ $record->check_out_time ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-gray-500 py-8">
                                            No attendance records found for this period.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $leaveRequests->links() }}
                    </div>
                </div>
            @endif
            
            {{-- Leave Requests Table --}}
            @if ($activeTab === 'leave')
                <div class="bg-white rounded-lg shadow mt-6">
                    <div class="p-2 border-b ">
                        <h2 class="font-semibold">Leave Requests - {{ ucfirst($selectedPeriod) }}</h2>
                        <p class="text-sm text-gray-500">Overlapping the selected period</p>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full  text-canter text-sm">
                            <thead class="bg-gray-50">
                                <tr class="text-left bg-gradient-to-r text-canter from-gray-100 to-blue-100 rounded-t-lg">
                                    <th class="text-left px-4 py-3 border">Employee</th>
                                    <th class="text-left px-4 py-3 border">Start</th>
                                    <th class="text-left px-4 py-3 border">End</th>
                                    <th class="text-left px-4 py-3 border">Status</th>
                                    <th class="text-left px-4 py-3 border">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @forelse ($leaveRequests as $req)
                                    @php
                                        $statusMap = [
                                            'approved' => 'bg-green-100 text-green-700',
                                            'pending' => 'bg-yellow-100 text-yellow-700',
                                            'rejected' => 'bg-red-100 text-red-700',
                                        ];
                                    @endphp
                                    <tr>
                                        <td class="px-4 py-3 font-medium border">{{ $req->user->name }}</td>
                                        <td class="px-4 py-3 border">{{ $req->start_date->format('Y-m-d') }}</td>
                                        <td class="px-4 py-3 border">{{ $req->end_date->format('Y-m-d') }}</td>
                                        <td class="px-4 py-3 border">
                                            <span
                                                class="px-2 py-1 rounded text-xs {{ $statusMap[$req->status] ?? 'bg-gray-100 text-gray-700' }}">
                                                {{ ucfirst($req->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 border">
                                            @if ($req->status === 'pending')
                                                <button wire:click="approveLeave({{ $req->id }})"
                                                    class="px-3 py-1 rounded bg-green-600 text-white hover:bg-green-700">
                                                    Approve
                                                </button>
                                                <button wire:click="rejectLeave({{ $req->id }})"
                                                    class="px-3 py-1 rounded bg-red-600 text-white hover:bg-red-700 ml-2">
                                                    Reject
                                                </button>
                                            @else
                                                <span class="text-gray-500">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-gray-500 py-8">
                                            No leave requests found for this period.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $leaveRequests->links() }}
                    </div>
                </div>
            @endif
        </div>


        @livewireScripts
        @livewireStyles
    </div>

    {{-- Toast (simple) --}}
    {{-- <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('notify', ({
                message
            }) => {
                const el = document.createElement('div');
                el.textContent = message;
                el.className = 'fixed bottom-4 right-4 bg-black text-white px-4 py-2 rounded shadow';
                document.body.appendChild(el);
                setTimeout(() => el.remove(), 2000);
            });
        });
    </script> --}}
</div>
