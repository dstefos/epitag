<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UsersIndex extends Component
{
    public $query, $users, $asc=true, $newPassword, $type;

    public function mount()
    {
        $this->asc=true;

        // Get users with their card count as array, as livewire can't handle collections very well
        $this->users=User::leftjoin('cards', 'users.id', '=', 'cards.user_id')
        ->selectRaw('users.id, users.name, users.email, users.balance, users.admin, users.created_at, SUM(CASE WHEN cards.sellable THEN 1 ELSE 0 END) as sellables, count(cards.id) as cards')
        ->groupBy('users.id', 'users.name', 'users.email', 'users.balance', 'users.admin', 'users.created_at')
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
        $this->type=$type;
        $users=[];
        foreach($tempUsers as $user)
            array_push($users, $user);

        $this->users=$users;
        
    }

    public function updatePassword(User $user)
    {
        $psw=$this->newPassword;
        $this->newPassword=null;
        $user->password=bcrypt($psw);
        $user->save();
        session()->flash('message', 'Password Updated successfully.');
    }

    public function deleteUser($userId)
    {
        User::deleteAndDessociate($userId);
        session()->flash('message', 'User Deleted successfully.');
        return redirect()->to('/users');
    }
}