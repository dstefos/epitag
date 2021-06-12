<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserCards extends Component
{
    public $cards, $user;

    public function render()
    {
        return view('livewire.user-cards');
    }

    public function mount(User $user)
    {
        $this->user=$user;
        $this->cards=$user->cards()->orderBy('sellable', 'desc')->orderBy('title', 'asc')->get();
    }
}
