<div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-blue-50 to-green-50">
    <div class="text-center max-w-2xl mx-auto px-4">
        <div class="mb-8">
            <div class="w-24 h-24 mx-auto bg-blue-600 rounded-full flex items-center justify-center mb-4">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Attendance Management</h1>
            <p class="text-xl text-gray-600 mb-8">Streamline your workforce attendance tracking with our comprehensive
                management system</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="text-blue-600 mb-2">
                    <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Easy Check-in</h3>
                <p class="text-gray-600 text-sm">Quick and simple attendance tracking for all employees</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="text-green-600 mb-2">
                    <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2
                             0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 
                             2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Real-time Reports</h3>
                <p class="text-gray-600 text-sm">Comprehensive analytics and attendance reports</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="text-purple-600 mb-2">
                    <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 
                            6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.
                            5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                        </path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Leave Management</h3>
                <p class="text-gray-600 text-sm">Efficient leave request and approval system</p>
            </div>
        </div>

        <div class="space-y-4 sm:space-y-0 sm:space-x-4 sm:flex sm:justify-center">
            <a href="{{ route('login') }}"
                class="inline-flex items-center justify-center px-8 py-3 border
                   border-transparent text-base font-medium rounded-md text-white
                   bg-blue-600 hover:bg-blue-700 transition-colors duration-200">
                Login
            </a>
            <a href="{{ route('register') }}"
                class="inline-flex items-center justify-center px-8 py-3 border
                 border-blue-600 text-base font-medium rounded-md 
                 text-blue-600 bg-white hover:bg-blue-50 transition-colors duration-200">
                Sigin
            </a>
        </div>
    </div>
</div>
