<div>
    <div class="bg-white shadow sm:rounded-lg p-4 mb-4">
        <form wire:submit.prevent="createTask" class="flex space-x-2 items-start">
            <input
                type="text"
                wire:model.defer="newTaskTitle"
                placeholder="What will you focus on?"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            />

            <select wire:model.defer="newTaskPriority" class="px-3 py-2 border border-gray-300 rounded-md">
                <option value="medium">Medium</option>
                <option value="high">High</option>
                <option value="low">Low</option>
            </select>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Add</button>
        </form>
    </div>

    <div class="space-y-3">
        @forelse($tasks as $task)
            <div class="bg-white shadow sm:rounded-lg p-4 flex items-start justify-between space-x-4">
                <div class="flex items-start space-x-3">
                    <button wire:click="toggleComplete({{ $task->id }})" class="mt-1">
                        @if($task->completed)
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        @else
                            <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        @endif
                    </button>

                    <div>
                        <div class="flex items-center space-x-2">
                            <h3 class="text-sm font-medium {{ $task->completed ? 'line-through text-gray-400' : 'text-gray-900' }}">{{ $task->title }}</h3>

                            @if($task->priority === 'high')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">High</span>
                            @elseif($task->priority === 'medium')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Medium</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Low</span>
                            @endif
                        </div>

                        <div class="text-xs text-gray-500 mt-1">Added {{ $task->created_at->diffForHumans() }}</div>
                    </div>
                </div>

                <div class="flex items-center space-x-2">
                    <button wire:click="deleteTask({{ $task->id }})" class="text-sm text-red-600 hover:underline">Delete</button>
                </div>
            </div>
        @empty
            <div class="bg-white shadow sm:rounded-lg p-4 text-gray-600">No tasks found.</div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $tasks->links() ?? '' }}
    </div>
</div>
