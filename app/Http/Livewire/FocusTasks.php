<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\FocusTask;

class FocusTasks extends Component
{
    public $title = '';
    public $notes = '';

    protected $rules = [
        'title' => 'required|string|max:255',
        'notes' => 'nullable|string',
    ];

    public function addTask()
    {
        $this->validate();

        FocusTask::create([
            'title' => $this->title,
            'notes' => $this->notes,
            'is_completed' => false,
        ]);

        $this->reset(['title', 'notes']);
    }

    public function deleteTask($id)
    {
        $task = FocusTask::find($id);

        if ($task) {
            $task->delete();
        }
    }

    public function render()
    {
        $tasks = FocusTask::orderByDesc('created_at')->get();

        return view('livewire.focus-tasks', [
            'tasks' => $tasks,
        ]);
    }
}
