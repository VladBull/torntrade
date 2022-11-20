<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Type\Integer;

class StoreItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::check())
        {
            return true;
        }
        return false;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => 'required|string',
            "game_item_id" => 'required|Integer|unique:items',
            "description" => 'required|string',
            "type" => 'required|string',
            "my_price" => 'integer',
            "market_value" => 'integer',
            "buy_price" => 'integer',
            "sell_price" => 'integer',
            "circulation" => 'integer'
        ];
    }
}
