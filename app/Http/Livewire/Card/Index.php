<?php

namespace App\Http\Livewire\Card;

use App\Models\card;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;
    public $cards, $newTitle, $newImage, $showDialog=false;

    protected $rules = [
        'cards.*.title' => 'required',
        'cards.*.price' => 'numeric',
    ];
    
    public function mount()
    {
        if(Auth::user()->admin)
            $this->cards=card::orderBy('created_at', 'desc')->get();
        else
        {
            $this->cards=card::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
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

    public function submit()
    {
        if(!Auth::user()->admin)
            dd('not authorized');
        $this->showDialog=true;
        $this->validate();
        $this->showDialog=false;
        $newImage=$this->newImage->store('img', ['disk' => 'public']);
        // dd('adsf');
        card::create(
            [
                'title'=>$this->newTitle,
                'image'=>$newImage,
                'price'=>0.00
            ]
        );
        $this->reset();
        $this->cards=card::orderBy('created_at', 'desc')->get();
        session()->flash('message', 'Card created succesfully.');
    }
    
    public function render()
    {
        return view('livewire.card.index');
    }
    
    public function updated()
    {
        $this->showDialog=true;
        
    }
    
    public function delete(card $card)
    {
        if(!Auth::user()->admin)
        dd('not authorized');
        
        card::destroy($card->id);
        $this->cards=card::orderBy('created_at', 'desc')->get();
        session()->flash('message', 'Card deleted.');
    }
}
