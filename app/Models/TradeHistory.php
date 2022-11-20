<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradeHistory extends Model
{
    use HasFactory;

    protected $fillable =[
        'summary',
        'total',
        'profit',
        'total_items',
        'client_id'
    ];

    protected $dates =[
        'created_at',
        'edited_at'
    ];

    public function client ()
    {
         return $this->belongsTo(Client::class, 'client_id');
    }
}
