<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TodoItem;
use App\Models\TodoList;

class Tasks extends Component
{
    public $todoList;
    public $canFinish = [];

    protected $listeners = ['allTasksCompleted' => 'showFinishButton'];

    public function showFinishButton($listId, $completed) {
        $this->canFinish[$listId] = $completed;
    }

    public function mount()
    {
        $this->todoList = TodoList::all();
    }

    public function render()
    {
        return view('livewire.tasks', [
            'todoList' => $this->todoList,
        ]);
    }
}
