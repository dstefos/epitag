<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserCards extends Component
{
    public $cards;

    public function render()
    {
        return view('livewire.user-cards');
    }

    public function mount(User $user)
    {
        $this->cards=$user->cards()->orderBy('sellable', 'desc')->orderBy('title', 'asc')->get();
    }
}
