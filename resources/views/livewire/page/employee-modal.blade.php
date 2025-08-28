<div>
    <main class="flex-1 p-8 overflow-auto">

        <div class="p-6">
            <!-- Search + Add Button -->
            <div class="flex gap-4 justify-between mb-4">
                <input wire:model.debounce.300ms="search" type="text" placeholder="Search..."
                    class="border rounded px-3 py-2 w-full md:w-1/2">
                <button wire:click="openForm" class="bg-green-700 text-white px-4 py-2 rounded">Add New Employee</button>
            </div>

            <!-- Users Table -->
            <table class="w-full table-auto border bg-white">
                <thead>
                    <tr class="text-left bg-gradient-to-r from-green-300 to-blue-300 rounded-t-lg">
                        <th class="p-2 border">Profile</th>
                        <th class="p-2 border">Name</th>
                        <th class="p-2 border">Email</th>
                        <th class="p-2 border">Join Date</th> <!-- Already present ✅ -->
                        <th class="p-2 border">Position</th>
                        <th class="p-2 border">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $emp)
                        <tr>
                            <td class="px-4 p-2 border">
                                <img src="{{ $emp->avatar ? asset('storage/' . $emp->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($emp->name) }}"
                                    class="w-8 h-8 rounded-full" />
                            </td>
                            <td class="px-4 p-2 border">{{ $emp->name }}</td>
                            <td class="px-4 p-2 border">{{ $emp->email }}</td>
                            <td class="px-4 p-2 border">
                                {{ \Carbon\Carbon::parse($emp->join_date)->format('Y-m-d') }}
                            </td>
                            <td class="px-4 p-2 border">{{ $emp->position }}</td>

                            <td class="px-4 py-2 border text-center" x-data="{ open: false }">
                                <button @click="open = !open" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">
                                    <i class="fa-solid fa-ellipsis-vertical"></i> {{-- vertical dots --}}
                                </button>

                                <div x-show="open" @click.outside="open = false"
                                    class="absolute bg-gray-50 border rounded shadow-md mt-2 p-2 z-10 flex flex-col gap-2 w-36 text-left">
                                    <button wire:click="openForm({{ $emp->id }})" class="text-green-500">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        Edit
                                    </button>
                                    <button wire:click="confirmDelete({{ $emp->id }})"class="text-red-500 ml-2">
                                        <i class="fa-solid fa-trash"></i>
                                        Delete
                                    </button>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center p-4 text-gray-500">No employees found.</td>
                        </tr>
                    @endforelse
                </tbody>
                @if ($users->hasPages())
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                @endif

            </table>

            <!-- Add/Edit Modal -->
            @if ($formOpen)
                <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl">
                        <div
                            class="px-6 py-4 bg-gradient-to-r from-green-600 to-blue-300 rounded-t-lg text-white flex justify-between items-center">
                            <h2 class="text-xl font-semibold">{{ $userId ? 'Edit User' : 'Create New User' }}</h2>
                            <button wire:click="$set('formOpen', false)" class="text-white text-2xl">&times;</button>
                        </div>

                        <div class="p-6">
                            <form wire:submit.prevent="save">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Profile Photo Upload -->
                                    <div class="flex flex-col items-center gap-4">
                                        <label class="text-gray-700">Profile Photo</label>
                                        <div
                                            class="w-32 h-32 bg-gray-100 rounded-full overflow-hidden flex items-center justify-center cursor-pointer relative">
                                            @if ($avatar)
                                                <img src="{{ $avatar->temporaryUrl() }}"
                                                    class="w-full h-full object-cover" />
                                            @else
                                                <span class="text-gray-400">Click to upload</span>
                                            @endif
                                            <input type="file" wire:model="avatar" accept="image/*"
                                                class="absolute w-full h-full opacity-0 cursor-pointer" />
                                        </div>
                                        <p class="text-sm text-gray-500">Max 1MB • JPG, PNG</p>
                                    </div>

                                    <!-- User Fields -->
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-gray-700">Username *</label>
                                            <input wire:model="name" type="text" placeholder="Enter username"
                                                class="w-full border px-3 py-2 rounded focus:ring focus:ring-blue-300">
                                        </div>

                                        <div>
                                            <label class="block text-gray-700">Email Address *</label>
                                            <input wire:model="email" type="email" placeholder="Enter email"
                                                class="w-full border px-3 py-2 rounded">
                                        </div>

                                        <div>
                                            <label class="block text-gray-700">Position *</label>
                                            <input wire:model="position" type="text" placeholder="Enter position"
                                                class="w-full border px-3 py-2 rounded">
                                        </div>
                                        {{-- <div>
                                            <label class="block text-gray-700">Department *</label>
                                            <input wire:model="department" type="text" placeholder="Enter department"
                                                class="w-full border px-3 py-2 rounded">
                                        </div> --}}

                                        <div>
                                            <label class="block text-gray-700">Status *</label>
                                            <select wire:model="status" class="w-full border px-3 py-2 rounded">
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                        </div>


                                        <div>
                                            <label class="block text-gray-700">Join Date *</label>
                                            <input wire:model="join_date" type="date"
                                                class="w-full border px-3 py-2 rounded">
                                        </div>

                                        <!-- Optional: Password field for new users -->
                                        @if (!$userId)
                                            <div>
                                                <label class="block text-gray-700">Password *</label>
                                                <input wire:model="password" type="password"
                                                    placeholder="Enter password"
                                                    class="w-full border px-3 py-2 rounded">
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex justify-end mt-6 gap-4">
                                    <button type="button" wire:click="$set('formOpen', false)"
                                        class="px-4 py-2 border border-green-600 rounded hover:bg-gray-100">Cancel</button>
                                    <button type="submit"
                                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                        {{ $userId ? 'Update' : 'Create' }}
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            @endif

            <!-- Delete Modal -->
            @if ($deleteOpen)
                <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
                    <div class="bg-white p-4 rounded shadow w-full max-w-sm">
                        <h2 class="text-red-600 font-semibold mb-2">Delete Employee</h2>
                        <p>Are you sure you want to delete this employee? This action cannot be undone.</p>

                        <div class="mt-4 flex justify-end gap-2">
                            <button wire:click="$set('deleteOpen', false)" class="px-4 py-2 border">Cancel</button>
                            <button wire:click="delete" class="px-4 py-2 bg-red-600 text-white">Delete</button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </main>

    @livewireScripts
    @livewireStyles
</div>
