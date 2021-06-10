<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\card;

class bundle extends Model
{
    use HasFactory;

    public function boughtBy(User $user)
    {
        // if user cant afford this bundle, then return false
        if($user->balance-$this->price<0)
        return 'balance';
        
        // Get available cards
        $cards=card::where('user_id', null)->get()->toArray();
        
        // If there are no cards available then return false
        if(count($cards)<$this->quantity)
        return 'quantity';
        
        // Get random cards and attach them to User
        $selectedCards=array_rand($cards, $this->quantity);
        foreach ($selectedCards as $cardIndex) {
            $card=card::find($cards[$cardIndex]['id']);
            $card->user_id=$user->id;
            $card->save();
        }
        
        // Decrease user balance
        $user->balance-=$this->price;
        $user->save();
        
        return 'success';
    }
}
