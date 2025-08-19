
<div>
    {{-- Delete Employee Modal --}}
    @if($deleteOpen)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h2 class="text-xl font-semibold text-red-600 flex items-center gap-2">
                    ⚠ Delete Employee
                </h2>
                <p class="mt-2">Are you sure you want to delete <strong>{{ $employeeName }}</strong>?  
                This action cannot be undone.</p>

                <div class="flex justify-end gap-3 mt-6">
                    <button wire:click="$set('deleteOpen', false)" class="px-4 py-2 border rounded">Cancel</button>
                    <button wire:click="delete" class="px-4 py-2 bg-red-600 text-white rounded">Delete Employee</button>
                </div>
            </div>
        </div>
    @endif

    {{-- Add/Edit Employee Modal --}}
    @if($formOpen)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6">
                <h2 class="text-xl font-semibold mb-4">
                    {{ $employeeId ? 'Edit Employee' : 'Add Employee' }}
                </h2>

                <form wire:submit.prevent="save" class="space-y-4">
                    <div class="flex justify-center">
                        <img class="w-20 h-20 rounded-full"
                            src="{{ $avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode($name) }}"
                            alt="avatar">
                    </div>

                    <div>
                        <label class="block">Full Name *</label>
                        <input type="text" wire:model="name" class="w-full border rounded px-3 py-2">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block">Email *</label>
                        <input type="email" wire:model="email" class="w-full border rounded px-3 py-2">
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block">Position *</label>
                        <input type="text" wire:model="position" class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block">Department *</label>
                        <select wire:model="department" class="w-full border rounded px-3 py-2">
                            <option value="">Select Department</option>
                            <option value="Engineering">Engineering</option>
                            <option value="Product">Product</option>
                            <option value="Design">Design</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Sales">Sales</option>
                            <option value="HR">HR</option>
                            <option value="Finance">Finance</option>
                            <option value="Operations">Operations</option>
                        </select>
                    </div>

                    <div>
                        <label class="block">Join Date *</label>
                        <input type="date" wire:model="joinDate" class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block">Status *</label>
                        <select wire:model="status" class="w-full border rounded px-3 py-2">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <div>
                        <label class="block">Avatar URL (optional)</label>
                        <input type="text" wire:model="avatar" class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="flex justify-end gap-3">
                        <button type="button" wire:click="$set('formOpen', false)"
                            class="px-4 py-2 border rounded">Cancel</button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded">
                            {{ $employeeId ? 'Update Employee' : 'Add Employee' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
