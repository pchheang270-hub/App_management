<div class="flex-1 p-8 overflow-auto">

    <div>
        {{-- Button to show/hide form --}}
        <button wire:click="toggleForm"
            class="flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg shadow mb-4">
            Leave Request
        </button>

        {{-- Leave Requests Table --}}

        <div class="bg-white rounded-lg shadow mt-6">
            <div class="p-2  white m-2">
                <h2 class="text-lg font-semibold">Leaves & Request</h2>
            </div>
            <table class="min-w-full border-collapse bg-white shadow rounded-lg overflow-hidden">
                <thead>
                    <tr class="text-left bg-gradient-to-r from-gray-100 to-blue-100 text-gray-700">
                        <th class="px-4 py-2 border">Employee Name</th>
                        <th class="px-4 py-2 border">Date Range</th>
                        <th class="px-4 py-2 border">Reason</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leaveRequests as $leave)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $leave->user?->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">
                                {{ \Carbon\Carbon::parse($leave->start_date)->format('d M Y') }}
                                -
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
                            <td class="px-4 py-2 border text-center" x-data="{ open: false }">
                                <button @click="open = !open" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">
                                    <i class="fa-solid fa-ellipsis-vertical"></i> {{-- vertical dots --}}
                                </button>

                                <div x-show="open" @click.outside="open = false"
                                    class="absolute bg-gray-50 border rounded shadow-md mt-2 p-2 z-10 flex flex-col gap-2 w-36 text-left">

                                    @if ($leave->status === 'pending')
                                        <button wire:click="approve({{ $leave->id }})"
                                            class="flex items-center gap-2 px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                            <i class="fa-solid fa-circle-check"></i>
                                            Approve
                                        </button>

                                        <button wire:click="reject({{ $leave->id }})"
                                            class="flex items-center gap-2 px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                            <i class="fa-solid fa-circle-xmark"></i>
                                            Reject
                                        </button>
                                    @endif

                                    <button wire:click="editLeave({{ $leave->id }})"
                                        class="flex items-center gap-2 px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        Edit
                                    </button>

                                    <button wire:click="deleteLeave({{ $leave->id }})"
                                        class="flex items-center gap-2 px-3 py-1 bg-gray-500 text-white rounded hover:bg-gray-600">
                                        <i class="fa-solid fa-trash"></i>
                                        Delete
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-2 text-center text-gray-500">No leave requests found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Leave Request Form --}}
            @if ($showForm)
                <div class="relative border p-4 mt-6 rounded-lg bg-gray-50 shadow">
                    {{-- Close (×) button --}}
                    <button wire:click="toggleForm"
                        class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl font-bold focus:outline-none">
                        &times;
                    </button>

                    <h2 class="text-lg font-semibold mb-4">New Leave Request</h2>

                    <form wire:submit.prevent="submit">
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block mb-1 font-medium">Employee Name</label>

                                @if (auth()->user()->is_admin)
                                    <select wire:model="user_id" class="w-full border rounded px-2 py-1">
                                        <option value="">Select Employee</option>
                                        @foreach (\App\Models\User::all() as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="text"
                                        class="w-full border rounded px-2 py-1 bg-gray-100 cursor-not-allowed"
                                        value="{{ auth()->user()->name }}" disabled>
                                    <input type="hidden" wire:model="user_id">
                                @endif

                                @error('user_id')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- other fields --}}
                            <div>
                                <label class="block mb-1 font-medium">Start Date</label>
                                <input type="date" wire:model="start_date" class="w-full border rounded px-2 py-1">
                                @error('start_date')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block mb-1 font-medium">End Date</label>
                                <input type="date" wire:model="end_date" class="w-full border rounded px-2 py-1">
                                @error('end_date')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-span-2">
                                <label class="block mb-1 font-medium">Reason</label>
                                <textarea wire:model="reason" rows="5" class="w-full border rounded px-2 py-1"
                                    placeholder="Type your message here..."></textarea>
                                @error('reason')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
                            Submit
                        </button>
                    </form>
                </div>
            @endif
        </div>

    </div>

    @livewireScripts
    @livewireStyles
</div>
