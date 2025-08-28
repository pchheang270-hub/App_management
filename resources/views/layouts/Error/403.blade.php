@extends('layouts.app')

@section('title', '403 Forbidden')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="text-center">
        <h1 class="text-6xl font-bold text-red-600">403</h1>
        <p class="mt-4 text-lg text-gray-700">You don’t have permission to access this page.</p>
        <a href="{{ route('/') }}" class="mt-6 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Go Home
        </a>
    </div>
</div>
@endsection
