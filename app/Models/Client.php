<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable =[
        'client_name',
        'client_game_id',
        'comment'
    ];

    protected $dates =[
        'created_at',
        'edited_at'
    ];

    public function tradeHistory() //la plural neaparat! intoarce o colectie
    {
        return $this->hasMany(TradeHistory::class);
    }

    public function getFirstTradeAttribute() 
    {
        return $this->tradeHistory->sortBy('created_at')->first();
    }

    public function getLastTradeAttribute() 
    {
        return $this->tradeHistory->sortByDesc('created_at')->first();
    }

    public function getTradesDoneAttribute() 
    {
        return $this->tradeHistory->count();
    }

    public function getTradesValueAttribute() 
    {
        return $this->tradeHistory->sum('total');
    }

    public function getProfitValueAttribute() 
    {
        return $this->tradeHistory->sum('profit');
    }
}


   