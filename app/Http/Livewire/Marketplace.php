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
    

}
