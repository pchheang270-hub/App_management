<div class="min-h-screen flex items-center justify-center bg-green-100">
    <div class="max-w-md w-full space-y-8 ">
        <div class="bg-gradient-to-br from-blue-50 to-green-50  border border-gray-200 py-8  rounded-lg shadow-md p-4">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-green-800">Attendance Management</h2>
                <p class="mt-2 text-sm text-green-600">Sign in to your account</p>
            </div>
            <form wire:submit.prevent="login" class="mt-8 space-y-6">
                <div class="space-y-4">
                    <div>
                        <label for="email" class="block mb-1 text-gray-700 font-medium">Email</label>
                        <input wire:model="email" type="email" required
                            class="w-full px-3 py-2 border border-gray-300 placeholder-gray-500
                         text-gray-900 rounded-md focus:outline-none
                         focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Email address">
                        @error('email')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block mb-1 text-gray-700 font-medium">Password</label>
                        <input wire:model="password" type="password" required
                            class="w-full px-3 py-2 border border-gray-300 placeholder-gray-500
                            text-gray-900 rounded-md focus:outline-none
                            focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Password">
                        @error('password')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror


                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input wire:model="remember" type="checkbox"
                            class="h-4 w-4 text-blue-600 focus:ring-green-500 border-gray-300 rounded">
                        <label class="ml-2 block text-sm text-gray-900">Remember me</label>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border
                     border-transparent text-sm font-medium rounded-md
                    text-white bg-green-600 hover:bg-green-700 focus:outline-none 
                    focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Login
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-green-500">
                        Don't have an account? Register
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
