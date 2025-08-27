<div class="bg-white rounded-lg shadow p-6 max-w-md mx-auto">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Livewire Counter Example</h3>
    
    <div class="text-center mb-4">
        <p class="text-2xl font-bold text-blue-600">{{ $count }}</p>
    </div>
    
    <div class="flex space-x-2 mb-4">
        <button wire:click="decrement" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
            -
        </button>
        <button wire:click="increment" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
            +
        </button>
        <button wire:click="resetCount" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            Reset
        </button>
    </div>
    
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
        <input wire:model.live="name" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
    
    @if($name)
        <div class="text-center">
            <p class="text-gray-600">Hello, <span class="font-semibold">{{ $name }}</span>!</p>
        </div>
    @endif
</div>
