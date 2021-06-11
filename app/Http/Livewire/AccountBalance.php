<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AccountBalance extends Component
{
    public $newBalance, $balance;

    protected $listeners = ['refreshBalance'];
    
    protected $rules = [
        'newBalance' => 'numeric|gte:0',
    ];

    public function render()
    {
        return view('livewire.account-balance');
    }

    public function mount()
    {
        $this->balance=Auth::user()->balance;
    }

    public function deposit()
    {
        $this->validate();
        $user=User::find(Auth::id());
        $user->balance+=$this->newBalance;
        $user->save();

        // Refresh the balance depiction
        $this->balance=$user->balance;
    }
    
    // Refresh the balance depiction
    public function refreshBalance()
    {
        $user=User::find(Auth::id());
        $this->balance=$user->balance;       
    }
}
