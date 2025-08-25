<div class="min-h-screen flex items-center justify-center bg-green-100">
    <div class="max-w-md w-full space-y-8">
        <div class="bg-gradient-to-br from-blue-50 to-green-50 border border-gray-200 py-8  rounded-lg shadow-md p-6">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-green-700">
                    Create your account
                </h2>
            </div>
            <form wire:submit.prevent="register" class="mt-8 space-y-6">
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block mb-1 text-gray-700 font-medium">Full Name</label>
                        <input wire:model="name" type="text" required
                            class="w-full px-3 py-2 border border-gray-300 
                           placeholder-gray-500 text-gray-900 rounded-md 
                           focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Full Name">
                        @error('name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block mb-1 text-gray-700 font-medium">Email</label>
                        <input wire:model="email" type="email" required
                            class="w-full px-3 py-2 border border-gray-300 
                           placeholder-gray-500 text-gray-900 rounded-md 
                           focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Email address">
                        @error('email')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                        <input wire:model="position" type="text" id="position" name="position" required
                            class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Enter your position (e.g., Software Engineer)">
                        @error('position')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="role" class="block mb-1 text-gray-700 font-medium">Roles</label>
                        <select wire:model="role"
                            class="w-full px-3 py-2 border
                     border-gray-300 text-gray-900 rounded-md focus:outline-none 
                     focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="employee" class="">Employee</option>
                            <option value="admin">Admin</option>
                        </select>
                        @error('role')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block mb-1 text-gray-700 font-medium">Password</label>
                        <input wire:model="password" type="password" required
                            class="w-full px-3 py-2 border border-gray-300 
                           placeholder-gray-500 text-gray-900 rounded-md 
                           focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Password">
                        @error('password')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block mb-1 text-gray-700 font-medium">Confirm Password</label>
                        <input wire:model="password_confirmation" type="password" required
                            class="w-full px-3 py-2 border border-gray-300 
                           placeholder-gray-500 text-gray-900 rounded-md 
                           focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Confirm Password">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="w-full flex justify-center 
                    py-2 px-4 border border-transparent text-sm font-medium rounded-md
                    text-white bg-green-600 hover:bg-green-700 focus:outline-none 
                    focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Register
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-500">
                        Already have an account? Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
