<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UsersIndex extends Component
{
    public $users;

    public function mount()
    {
        $this->users=User::where('admin',false)->get();
    }

    public function render()
    {
        return view('livewire.users-index');
    }

    public function sortBy($type)
    {
        $this->users=User::where('admin',false)->orderBy($type)->get();
    }
}
