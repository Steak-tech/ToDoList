<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class Notes extends Component
{
    public $newContent = '';
    public $selectedColor = 'yellow';

    // Liste des couleurs disponibles pour l'UI
    public $colors = [
        'yellow' => 'bg-yellow-200 text-yellow-900',
        'blue'   => 'bg-blue-200 text-blue-900',
        'green'  => 'bg-green-200 text-green-900',
        'pink'   => 'bg-pink-200 text-pink-900',
        'purple' => 'bg-purple-200 text-purple-900',
    ];

    public function addNote()
    {
        $this->validate(['newContent' => 'required|max:200']);

        Note::create([
            'user_id' => Auth::id(),
            'content' => $this->newContent,
            'color'   => $this->selectedColor,
        ]);

        $this->reset('newContent');
    }

    public function deleteNote($id)
    {
        Note::where('id', $id)->where('user_id', Auth::id())->delete();
    }

    public function render()
    {
        return view('livewire.notes', [
            'notes' => Note::where('user_id', Auth::id())->latest()->get()
        ]);
    }
}