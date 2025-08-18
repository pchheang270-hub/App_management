<div class="min-h-screen flex flex-col items-center justify-center bg-green-100">
    <div class="text-center max-w-2xl mx-auto px-4">
        <!-- Header -->
        <div class="mb-8">
            <div class="w-24 h-24 mx-auto bg-green-600 rounded-full flex items-center justify-center mb-4">
                <!-- Clock Icon -->
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Attendance Management</h1>
            <p class="text-xl text-gray-600 mb-8">
                Streamline your workforce attendance tracking with our comprehensive management system
            </p>
        </div>

        <!-- Features -->
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <!-- Easy Check-in -->
            <div class="bg-white p-6 rounded-lg   border-2 border-green-100 shadow-md transform transition duration-300 
            ease-in-out hover:shadow-lg hover:-translate-y-2 hover:scale-105">
                <div class="text-blue-600 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto text-blue-600"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2l4-4m6 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Easy Check-in</h3>
                <p class="text-gray-600 text-sm">Quick and simple attendance tracking for all employees</p>
            </div>

            <!-- Real-time Reports -->
            <div class="bg-white p-6 rounded-lg  border-2 border-green-100 shadow-md transform transition duration-300
             ease-in-out hover:shadow-lg hover:-translate-y-2 hover:scale-105">
                <div class="text-green-600 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto text-green-600" 
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-6m4 6v-4m4 4V7M3 3v18h18" />
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Real-time Reports</h3>
                <p class="text-gray-600 text-sm">Comprehensive analytics and attendance reports</p>
            </div>

            <!-- Leave Management -->
            <div class="bg-white p-6 rounded-lg   border-2 border-green-100 shadow-md transform transition
             duration-300 ease-in-out hover:shadow-lg hover:-translate-y-2 hover:scale-105">
                <div class="text-purple-600 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto text-purple-600" 
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 
                               6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M21 7.5a2.5 
                               2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Leave Management</h3>
                <p class="text-gray-600 text-sm">Efficient leave request and approval system</p>
            </div>
        </div>

        <!-- Buttons -->
        <div class="space-y-4 sm:space-y-0 sm:space-x-4 sm:flex sm:justify-center duration-300 ease-in">
            <a href="{{ route('login') }}"
                class="inline-flex items-center justify-center px-8 py-3 border
               border-transparent text-base font-medium rounded-md text-white
               bg-green-600 hover:bg-green-700 transform transition 
               duration-300 ease-in-out hover:scale-105">
                Login
            </a>
            <a href="{{ route('register') }}"
                class="inline-flex items-center justify-center px-8 py-3 border
               border-green-600 text-base font-medium rounded-md 
               text-green-600 bg-white hover:bg-green-50 transform transition 
               duration-300 ease-in-out hover:scale-105">
                Register
            </a>
        </div>
    </div>
</div>
