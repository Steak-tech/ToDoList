<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
        public function login()
    {
        return redirect()->route('login');
    }
    public function render()
    {
        return view('livewire.home');
    }
}
