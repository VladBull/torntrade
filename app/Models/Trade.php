<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    use HasFactory;

    protected $fillable =[
        'quantity',
        'item_id'
    ];

    protected $dates =[
        'created_at',
        'edited_at'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }



}
