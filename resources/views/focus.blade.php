@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-3xl mx-auto px-4">
        <div x-data="{ filter: 'all' }" class="mb-4">
            <div class="flex items-center space-x-3">
                <div class="text-sm font-medium text-gray-700">Show:</div>
                <div class="flex items-center space-x-2">
                    <button type="button"
                            @click="filter = 'all'"
                            wire:click="$emit('filterChanged', 'all')"
                            :class="filter === 'all' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50'"
                            class="px-3 py-1 rounded-md border border-gray-200 text-sm">
                        All
                    </button>

                    <button type="button"
                            @click="filter = 'active'"
                            wire:click="$emit('filterChanged', 'active')"
                            :class="filter === 'active' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50'"
                            class="px-3 py-1 rounded-md border border-gray-200 text-sm">
                        Active
                    </button>

                    <button type="button"
                            @click="filter = 'completed'"
                            wire:click="$emit('filterChanged', 'completed')"
                            :class="filter === 'completed' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50'"
                            class="px-3 py-1 rounded-md border border-gray-200 text-sm">
                        Completed
                    </button>
                </div>
            </div>
        </div>

        @livewire('focus-tasks')
    </div>
</div>
@endsection
