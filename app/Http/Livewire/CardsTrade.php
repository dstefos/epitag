<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\card;
use Illuminate\Support\Facades\Auth;
class CardsTrade extends Component
{
    public $cards;

    protected $listeners=['buy'];

    public $currentUrl;

    public function mount()
    {
        $this->currentUrl = url()->current();
    }

    public function render()
    {
        return view('livewire.cards-trade');
    }

    public function buy(card $card)
    {
        if(Auth::user()->balance<$card->price)
            session()->flash('error', 'You cannot afford this transaction');        
        else if($card->trade(Auth::user())==true)                   
            session()->flash('message', 'Trade completed succesfully.');
        
        $this->cards=card::where([['user_id', '!=', Auth::id()],['sellable', true]])->get();
        $this->emit('refreshBalance');
        return redirect()->to($this->currentUrl);
    }
}
