<div class="flex-1 p-8 overflow-auto">
    
    <div>
        {{-- Button to show/hide form --}}
        <button wire:click="toggleForm"
            class="flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg shadow mb-4">
            Leave Request
        </button>

        {{-- Form --}}
       
        <table class="min-w-full border-collapse bg-white">
            <thead>
                <tr class=" text-left  bg-gradient-to-r  from-green-300 to-blue-300 rounded-t-lg">
                    <th class="px-4 py-2 border">Employee Name</th>
                    <th class="px-4 py-2 border">Date Range</th>
                    <th class="px-4 py-2 border">Reason</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leave as $leave)
                    <tr class="border-b">
                        <td class="px-4 py-2 border">{{ $leave->employee?->$this->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2 border">
                            {{ \Carbon\Carbon::parse($leave->start_date)->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse($leave->end_date)->format('d M Y') }}
                        </td>
                        <td class="px-4 py-2 border">{{ $leave->reason }}</td>
                        <td class="px-4 py-2 border">
                            @if ($leave->status === 'pending')
                                <span class="text-yellow-600 font-medium">Pending</span>
                            @elseif($leave->status === 'approved')
                                <span class="text-green-600 font-medium">Approved</span>
                            @else
                                <span class="text-red-600 font-medium">Rejected</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border flex gap-2">
                            @if ($leave->status === 'pending')
                                <button wire:click="approve({{ $leave->id }})"
                                    class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                    Approve
                                </button>
                                <button wire:click="reject({{ $leave->id }})"
                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                    Reject
                                </button>
                            @endif

                            <button wire:click="editLeave({{ $leave->id }})"
                                class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Edit
                            </button>
                            <button wire:click="deleteLeave({{ $leave->id }})"
                                class="px-3 py-1 bg-gray-500 text-white rounded hover:bg-gray-600">
                                Delete
                            </button>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-center text-gray-500">No leave requests found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
         @if ($showForm)
            <div class="border p-2 mb-6 rounded-lg bg-gray-50 shadow">
                <h2 class="text-lg font-semibold mb-2">New Leave Request</h2>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label>Employee Name</label>
                        <select wire:model="users_id" class="w-full border rounded px-2 py-1">
                            <option value="">Select Employee</option>
                            @foreach (\App\Models\User::all() as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('users_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label>Start Date</label>
                        <input type="date" wire:model="start_date" class="w-full border rounded px-2 py-1">
                        @error('start_date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label>End Date</label>
                        <input type="date" wire:model="end_date" class="w-full border rounded px-2 py-1">
                        @error('end_date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label>Reason</label>
                        <input type="text" wire:model="reason" class="w-full border rounded px-2 py-1">
                        @error('reason')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <button wire:click="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow">Submit</button>
            </div>
        @endif
    </div>
@livewireScripts
@livewireStyles

</div>