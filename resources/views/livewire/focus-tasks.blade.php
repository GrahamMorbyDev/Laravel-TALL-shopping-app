<div class="max-w-xl mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Focus Tasks</h1>

    <form wire:submit.prevent="addTask" class="mb-6">
        <div class="mb-2">
            <label class="block text-sm font-medium text-gray-700">Title</label>
            <input wire:model.defer="title" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="What will you focus on?" />
            @error('title') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-2">
            <label class="block text-sm font-medium text-gray-700">Notes (optional)</label>
            <textarea wire:model.defer="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Any details..."></textarea>
            @error('notes') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Add Task</button>
        </div>
    </form>

    <ul>
        @forelse($tasks as $task)
            <li class="flex items-start justify-between bg-white shadow p-3 mb-2 rounded-md">
                <div>
                    <div class="font-medium">{{ $task->title }}</div>
                    @if($task->notes)
                        <div class="text-sm text-gray-600">{{ $task->notes }}</div>
                    @endif
                    <div class="text-xs text-gray-400 mt-1">Created {{ $task->created_at->diffForHumans() }}</div>
                </div>
                <div class="flex items-center space-x-2">
                    <button wire:click="deleteTask({{ $task->id }})" onclick="confirm('Delete this task?') || event.stopImmediatePropagation()" class="text-red-600 hover:underline text-sm">Delete</button>
                </div>
            </li>
        @empty
            <li class="text-gray-500">No focus tasks yet.</li>
        @endforelse
    </ul>
</div>
