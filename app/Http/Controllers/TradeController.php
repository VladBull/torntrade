<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTradeRequest;
use App\Http\Requests\UpdateTradeHistoryRequest;
use App\Http\Requests\UpdateTradeRequest;
use App\Models\Item;
use App\Models\Trade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TradeController extends Controller
{
    public function index()
    {
        $trades = Trade::orderBy('created_at', 'desc')->get();
        $items = Item::orderBy('game_item_id', 'asc')->get();
        
        $totalMyPrice = 0;
        $totalMarketValue = 0;
        $profit = 0;
        $totalPricePerItem = 0;

        foreach($trades as $trade)
        {
            $totalPricePerItem += $trade->item->my_price*$trade->quantity;
            $totalMyPrice += $trade->item->my_price*$trade->quantity; 
            $totalMarketValue += $trade->item->market_value*$trade->quantity; 
        }

        $profit = $totalMarketValue - $totalMyPrice;

        return view('pages.trades.index',[
        'trades' => $trades,
        'items' => $items,
        'totalMyPrice' => $totalMyPrice,
        'totalMarketvalue' => $totalMarketValue,
        'profit' => $profit
        ]);
    }

    public function save(StoreTradeRequest $request)
    {
        if($request->validated())
        {
            $args = $request->only(['item_id', 'quantity']);

            $trades = new Trade($args);

            $trades->save();

            return redirect()->back()->with('success','Item added');
        }
    }

    public function deleteAll()
    {
        DB::table('trades')->delete();

        return redirect('admin/trades')->with('success','Trade cleared succesfully!');

    }

    public function delete(Trade $trade)
    {
        $trade->delete();

        return redirect('admin/trades')->with('success','Item cleared succesfully!');

    }

    public function edit(Trade $trade)
    {
        $items = Item::orderBy('game_item_id', 'asc')->get();
        
        return view('pages.trades.edit',[
            'trade' => $trade,
            'items' => $items 
        ]);
    }

    public function update(UpdateTradeRequest $request, Trade $trade)
    {

        if($request->validated())
        {
            $args = $request->only(['quantity', 'item_id']);

            $trade->update($args);

            return redirect('admin/trades')->with('success','Trade updated successfully');
        }

    }

}
