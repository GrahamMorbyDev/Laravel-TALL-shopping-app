<div class="max-w-2xl mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Focus Tasks</h1>

    <form wire:submit.prevent="addTask" class="mb-6">
        <div class="flex space-x-2">
            <input
                type="text"
                name="title"
                wire:model.defer="title"
                placeholder="What do you want to focus on today?"
                class="flex-1 px-4 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
            />

            <button
                type="submit"
                class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 focus:outline-none"
            >
                Add
            </button>
        </div>

        @error('title')
            <p class="text-red-600 mt-2 text-sm">{{ $message }}</p>
        @enderror

        <div class="mt-3">
            <textarea
                name="notes"
                wire:model.defer="notes"
                placeholder="Notes (optional)"
                class="w-full px-4 py-2 border rounded shadow-sm mt-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                rows="3"
            ></textarea>
            @error('notes')
                <p class="text-red-600 mt-2 text-sm">{{ $message }}</p>
            @enderror
        </div>
    </form>

    <div>
        <h2 class="text-lg font-medium mb-3">Today's Tasks</h2>
        <ul class="space-y-2">
            @forelse ($tasks as $task)
                <li class="flex items-start justify-between p-3 border rounded bg-white">
                    <div>
                        <div class="flex items-center space-x-3">
                            <input
                                type="checkbox"
                                wire:click="toggleComplete({{ $task->id }})"
                                {{ $task->is_completed ? 'checked' : '' }}
                                class="h-4 w-4"
                            />

                            <span class="{{ $task->is_completed ? 'line-through text-gray-500' : 'text-gray-900' }} font-medium">{{ $task->title }}</span>
                        </div>

                        @if($task->notes)
                            <p class="text-sm text-gray-600 mt-1">{{ $task->notes }}</p>
                        @endif

                        <p class="text-xs text-gray-400 mt-1">Added {{ $task->created_at->diffForHumans() }}</p>
                    </div>

                    <div class="flex items-center space-x-2">
                        <button
                            type="button"
                            onclick="if(!confirm('Delete this task?')) event.stopImmediatePropagation();"
                            wire:click="deleteTask({{ $task->id }})"
                            class="text-red-600 hover:text-red-800 focus:outline-none"
                        >
                            Delete
                        </button>
                    </div>
                </li>
            @empty
                <li class="p-3 text-gray-500">No tasks yet — add one above.</li>
            @endforelse
        </ul>
    </div>

    <script>
        document.addEventListener('livewire:load', function () {
            // Focus the title input after a task is added (emit 'taskAdded' from the Livewire component after add)
            if (window.Livewire) {
                Livewire.on('taskAdded', function () {
                    var el = document.querySelector('input[name="title"]');
                    if (el) { el.focus(); }
                });
            }
        });
    </script>
</div>
