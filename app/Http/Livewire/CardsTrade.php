<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\card;
use App\Models\TradeJob;
use Illuminate\Support\Facades\Auth;
class CardsTrade extends Component
{
    public $cards, $card_id, $bundle_id, $whenTime, $whenPriceBigger, $whenPriceSmaller;

    protected $listeners=['buy', 'setId', 'createTradeJob', 'resetForm'];

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
    
    public function setId($card_id)
    {
        $this->card_id=$card_id;
    }
    
    public function createTradeJob($cardId)
    {
        TradeJob::create(
            [
                "card_id"=>$cardId,
                "user_id"=>Auth::id(),
                "whenTime"=>$this->whenTime,
                "whenPriceBigger"=>$this->whenPriceBigger,
                "whenPriceSmaller"=>$this->whenPriceSmaller,
                ]
        );

        $this->resetForm();
        
        session()->flash('message', 'Job created succesfully.');
    }
    
    public function resetForm()
    {
        $this->whenTime=null;
        $this->whenPriceBigger=null;
        $this->whenPriceSmaller=null;
    }
}
