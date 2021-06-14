<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradeJob extends Model
{
   protected $fillable = [
       'card_id',
       'user_id',
       'whenTime',
       'whenPriceBigger',
       'whenPriceSmaller',
   ];

    use HasFactory;
}
