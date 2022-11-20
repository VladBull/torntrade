<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'game_item_id',
        'description',
        'type',
        'my_price',
        'market_value',
        'buy_price',
        'sell_price',
        'circulation',
        'actions',
        'profile_image',
        'my_price'
    ];

    protected $dates =[
        'created_at',
        'edited_at'
    ];

    public function trade()
    {
        return $this->hasOne(Trade::class);
    }

}