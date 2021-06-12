<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class card extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trade(User $buyer)
    {
        // Check if the card belongs to a user and if the buyer can afford this trade
        if($this->user_id==null || $buyer->balance<$this->price || $buyer->id==$this->user_id)
            return false;

        // Retrieve the owner of the card and increase their balance
        $seller=User::find($this->user_id);
        $seller->balance+=$this->price;
        $seller->save();

        // Decrease the balance of the buyer
        $buyer->balance-=$this->price;
        $buyer->save();

        // Change the owner of the card
        $this->user_id=$buyer->id;
        $this->sellable=false;
        $this->save();

        return true;

    }
}
