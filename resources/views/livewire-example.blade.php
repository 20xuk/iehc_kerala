@extends('layouts.app')

@section('title', 'Livewire Counter Example')

@section('content')
<div class="space-y-6">
    <div class="text-center">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Livewire Examples</h1>
        <p class="text-gray-600 mb-8">This demonstrates the difference between traditional Laravel controllers and Livewire components.</p>
    </div>
    
    <!-- Simple Counter Component -->
    @livewire('counter')
    
    <!-- Navigation -->
    <div class="text-center mt-8">
        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800 mr-4">← Back to Traditional Dashboard</a>
        <a href="{{ route('dashboard.livewire') }}" class="text-blue-600 hover:text-blue-800">View Livewire Dashboard →</a>
    </div>
</div>
@endsection
