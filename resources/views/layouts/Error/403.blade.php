<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="text-center max-w-md mx-auto px-4">
        <div class="mb-8">
            <div class="w-20 h-20 mx-auto bg-red-100 rounded-full flex items-center justify-center mb-4">
                <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                       d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 
                       4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-red-600 mb-4">403</h1>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Access Denied</h2>
            <p class="text-gray-600 mb-8">You don't have permission to access this page.</p>
        </div>
        
        <div class="space-y-4">
            <a href="{{ route('login') }}" class="inline-flex items-center justify-center
                px-6 py-3 border border-transparent text-base font-medium rounded-md 
                text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200">
                Go to Login
            </a>
            <div>
                <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-500">
                    Return to Home
                </a>
            </div>
        </div>
    </div>
</body>
</html>
