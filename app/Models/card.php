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
        if($this->user_id==null || $buyer->balance-$this->price<0)
            return false;

        $seller=User::find($this->user_id);
        $seller->balance+=$this->price;
        $seller->save();
        $buyer->balance-=$this->price;
        $buyer->save();
        $this->user_id=$buyer->id;
        $this->save();

        return true;

    }
}
