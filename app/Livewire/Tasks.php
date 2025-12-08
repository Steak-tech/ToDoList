<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TodoItem;
use App\Models\TodoList;
use Illuminate\Support\Facades\Auth;

class Tasks extends Component
{
    public $todoList;
    public $canFinish = [];
    public $UserId;

    public $showCreateModal = false;

    public $newTitle = '';
    public $newDescription = '';

    public $showItemModal = false;

    public $newItemTitle = '';
    public $newItemDescription = '';
    public $currentListId;

    public function openCreateModal()
    {
        $this->reset(['newTitle', 'newDescription']); // On vide les champs
        $this->showCreateModal = true;
    }

    public function closeCreateModal()
    {
        $this->showCreateModal = false;
    }

    // Créer la liste
    public function createTodoList()
    {
        $this->validate([
            'newTitle' => 'required|min:3|max:50',
            'newDescription' => 'nullable|string|max:255',
        ]);

        // Création en base de données
        TodoList::create([
            'title' => $this->newTitle,
            'description' => $this->newDescription,
            'user_id' => Auth::id(),
        ]);

        $this->showCreateModal = false;
        $this->todoList = TodoList::all()->where('user_id', Auth::id());

        session()->flash('message', 'ToDoList créée avec succès !');
    }

    protected $listeners = ['allTasksCompleted' => 'showFinishButton'];

    public function showFinishButton($listId, $completed) {
        $tasksCount = TodoItem::where('todo_list_id', $listId)->count();
        if ($tasksCount == 0) {
            $completed = false;
        }
        $this->canFinish[$listId] = $completed;
    }

    public function completeList($listId)
    {
        $list = TodoList::find($listId);
        TodoList::destroy($listId);
        TodoItem::where('todo_list_id', $listId)->delete();
        $this->todoList = TodoList::all()->where('user_id', Auth::id());
        session()->flash('message', 'Liste "' . $list->title . '" terminée et supprimée avec succès !');
    }

    public function openItemModal($listId)
    {
        $this->reset(['newItemTitle', 'newItemDescription']); 
        $this->currentListId = $listId;
        $this->showItemModal = true;
    }

    public function closeItemModal()
    {
        $this->showItemModal = false;
    }

    public function addTaskItem()
    {
        $this->validate([
            'newItemTitle' => 'required|min:3|max:50',
            'newItemDescription' => 'nullable|string|max:255',
        ]);

        // Création en base de données
        TodoItem::create([
            'title' => $this->newItemTitle,
            'description' => $this->newItemDescription,
            'todo_list_id' => $this->currentListId,
            'is_completed' => false,
        ]);

        $this->showItemModal = false;
        $this->todoList = TodoList::all()->where('user_id', Auth::id());
        $this->dispatch('task-added', listId: $this->currentListId);

        session()->flash('message', 'Tâche ajoutée avec succès !');
    }

    public function mount()
    {
        $this->UserId = Auth::id();
        $this->todoList = TodoList::all()->where('user_id', $this->UserId);
    }

    public function render()
    {
        return view('livewire.tasks', [
            'todoList' => $this->todoList,
            'UserId' => $this->UserId,
        ]);
    }
}
