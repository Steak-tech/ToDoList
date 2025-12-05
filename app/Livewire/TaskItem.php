<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TodoItem;

class TaskItem extends Component
{
    public $listId;
    public $tasks;

    public function mount($listId)
    {
        $this->listId = $listId; 
        $this->tasks = TodoItem::where('todo_list_id', $this->listId)->get();
        $allCompleted = $this->tasks->every(fn($t) => $t->is_completed);
        $this->dispatch('allTasksCompleted', listId: $this->listId, completed: $allCompleted);

    }

    public function toggleComplete($taskId)
    {
        $task = TodoItem::find($taskId);
        if ($task) {
            $task->is_completed = !$task->is_completed;
            $task->save();

            $this->tasks = TodoItem::where('todo_list_id', $this->listId)->get();

            $allCompleted = $this->tasks->every(fn($t) => $t->is_completed);
            $this->dispatch('allTasksCompleted', listId: $this->listId, completed: $allCompleted);
        }
    }

    public function render()
    {
        return view('livewire.task-item', [
            'tasks' => $this->tasks,
        ]);
    }
}

