<div>
    {{-- In work, do what you enjoy. --}}
</div>
<div class="p-6">
    <h1 class="text-2xl font-bold text-blue-600 mb-6">Employee Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-blue-400 text-white p-6 rounded-lg">
            <h3 class="text-lg font-semibold">Today's Status</h3>
            <p class="text-xl">
                @if ($myAttendance)
                    {{-- Check-in: {{ \Carbon\Carbon::parse($myAttendance->check_in_time)->format('g:i A') }}
                    @if ($myAttendance->check_out_time)
                        <br>Check-out: {{ \Carbon\Carbon::parse($myAttendance->check_out_time)->format('g:i A') }}
                    @endif --}}
                @else
                    Not checked in yet
                @endif
            </p>
        </div>

        <div class="bg-green-400 text-white p-6 rounded-lg">
            <h3 class="text-lg font-semibold">Leave Requests</h3>
            <p class="text-3xl font-bold">{{ $myLeaves->count() }}</p>
        </div>
    </div>
</div>
