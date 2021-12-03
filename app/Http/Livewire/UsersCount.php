<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UsersCount extends Component
{
    public int $count = 0;

    protected $listeners = [
        'handleCount' => 'manageCount',
    ];

    public function mount()
    {
        $this->count = User::count();
    }

    public function render()
    {
        return view('livewire.users-count');
    }

    public function manageCount()
    {
        $this->count = User::count();
    }
}
