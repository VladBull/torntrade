<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTradeHistoryRequest;
use App\Models\Client;
use App\Models\Trade;
use App\Models\TradeHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TradeHistoryController extends Controller
{
    public function index(Request $request)
    { 
        
        $clients = Client::all();
        $numberOfTrades = $request->get('tradeHistories');

        $tradeHistories = TradeHistory::orderBy('created_at', 'desc')->paginate($numberOfTrades ? $numberOfTrades : 100000);
        $trades =  Trade::all();
        $summary = "";
        $total = 0;
        $totalMarketValue = 0;
        $profit = 0;
        
        foreach ($trades as $trade)
        {
            $summary .= $trade;
            $total += $trade->item->my_price*$trade->quantity; 
            $totalMarketValue += $trade->item->market_value*$trade->quantity;
        }

        $profit = $totalMarketValue - $total;      

        return view('pages.tradeHistory.index',[
            'tradeHistories' => $tradeHistories,
            'clients' => $clients,
            'trades' => $trades,
            'summary' => $summary,
            'total' => $total,
            'profit' => $profit
        ]);

    }

    public function search(Request $request)
    {
        $search = $request->get('search');

        $numberOfTrades = $request->get('tradeHistories');

        $tradeHistories = TradeHistory::where('summary',"LIKE","%$search%")
        ->orWhereHas('client',function($query) use($search){
            return $query->where('client_game_id', $search);
        })
        ->orWhereHas('client',function($query) use($search){
            return $query->where('client_name', $search);
        })
        ->paginate($numberOfTrades ? $numberOfTrades : 100000);

        $trades =  Trade::all();
        $summary = "";
        $total = 0;
        $totalMarketValue = 0;
        $profit = 0;
        
        foreach ($trades as $trade)
        {
            $summary .= $trade;
            $total += $trade->item->my_price*$trade->quantity; 
            $totalMarketValue += $trade->item->market_value*$trade->quantity;
        }

        $profit = $totalMarketValue - $total;

        
        return view('pages.tradeHistory.index',[
            'tradeHistories' => $tradeHistories,
            'trades' => $trades,
            'summary' => $summary,
            'total' => $total,
            'profit' => $profit
        ]);
    }

    public function show(TradeHistory $tradeHistory)
    {
        
          

        return view('pages.tradeHistory.show',[
        'tradeHistory' => $tradeHistory,
        ]);
    }

    public function delete(TradeHistory $tradeHistory) {
        $tradeHistory->delete();

        return redirect('admin/tradeHistory')->with('success','Trade deleted from database.');
    }
}
