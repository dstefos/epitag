<?php

namespace App\Http\Livewire;

use App\Models\card;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Marketplace extends Component
{

    public $cards;

    public function mount()
    {
        $this->cards=card::where([['user_id', '!=', Auth::id()],['sellable', true]])->get();
    }

    public function render()
    {
        return view('livewire.marketplace');
    }
    
    public function buy(card $card)
    {
        if(Auth::user()->balance<$card->price)
            session()->flash('error', 'You cannot afford this transaction');        
        else if($card->trade(Auth::user())==true)                   
            session()->flash('message', 'Trade completed succesfully.');
        
        $this->cards=card::where([['user_id', '!=', Auth::id()],['sellable', true]])->get();
    }
}
