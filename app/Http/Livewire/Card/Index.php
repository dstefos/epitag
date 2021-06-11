<?php

namespace App\Http\Livewire\Card;

use App\Models\card;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $cards;

    protected $rules = [
        'cards.*.title' => 'required',
        'cards.*.price' => 'numeric',
    ];

    public function mount()
    {
        if(Auth::user()->admin)
           $this->cards=card::get();
        else
        {
            $this->cards=card::where('user_id', Auth::id())->get();
        }
    }

    public function sell(card $card, $index)
    {
        $this->validate();
        $this->cards[$index]->sellable=true;
        $this->cards[$index]->save();
        $this->mount();
    }

    public function unsell(card $card)
    {
        $card->sellable=false;
        $card->save();
        $this->mount();
    }

    public function render()
    {
        return view('livewire.card.index');
    }
}
