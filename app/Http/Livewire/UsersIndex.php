<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UsersIndex extends Component
{
    public $query, $users, $asc=true;

    public function mount()
    {
        $this->asc=true;

        // Get users with their card count as array, as livewire can't handle collections very well
        $this->users=User::join('cards', 'users.id', '=', 'cards.user_id')
        ->selectRaw('users.id, users.name, users.email, users.balance, users.created_at, count(cards.id) as cards')
        ->groupBy('users.id', 'users.name', 'users.email', 'users.balance', 'users.created_at')
        ->get()->toArray();
        ;
    }
    
    public function render()
    {
        return view('livewire.users-index');
    }
    
    public function sortBy($type)
    {
        
        // Sort users according to given $type and push them into a new array in order to keep the order
        $tempUsers=$this->asc?collect($this->users)->sortByDesc($type):collect($this->users)->sortBy($type);
        $this->asc=!$this->asc;
        $users=[];
        foreach($tempUsers as $user)
            array_push($users, $user);

        $this->users=$users;
        
    }
}