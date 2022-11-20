<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Client;
use App\Models\Trade;
use App\Models\TradeHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index(Request $request)
    {

        $numberOfClients = $request->get('clients');

        $clients = Client::orderBy('client_name','ASC')->paginate($numberOfClients ? $numberOfClients : 100000);

        return view('pages.clients.index',[
            'clients' => $clients
        ]);
    }

    public function save(StoreClientRequest $request)
    {
        if($request->validated()){

            //save function to save the client in client form! //
            // https://laravel.com/docs/8.x/eloquent#inserting-and-updating-models
            
            $client = Client::updateOrCreate(
                ['client_name' => request('client_name')],
                ['client_game_id' => request('client_game_id')]
            ); 

             //save function to also save trade history in history form!
            $trades = Trade::all();
       
            if (count($trades)>0)
            {
                $total = 0;
                $profit = 0;
                $summary = "";
                $totalMarketValue = 0;
                $totalItemsNum = 0;

                if($request->validated())
                {
                    $index = 0;

                    foreach ($trades as $index => $trade)
                    {
                        $totalItem = $trade->item->my_price*$trade->quantity; 
                        $total += $trade->item->my_price*$trade->quantity; 
                        $totalMarketValue += $trade->item->market_value*$trade->quantity;
                        $summary .= $trade->item->name.' @ $'.number_format($trade->item->my_price).' * '.number_format($trade->quantity).' = $'.number_format($totalItem);
                        $totalItemsNum += $trade->quantity;
                        if($index < count($trades) - 1)
                        {
                            $summary.='; ';
                        }
                        $index++;
                        
                    }
                    
                    $profit = $totalMarketValue - $total;

                    $args = $request->only(['summary','total','profit', 'total_items', 'client_id']);

                    $args['summary'] = $summary;
                    $args['total'] = $total;
                    $args['profit'] = $profit;
                    $args['total_items'] = $totalItemsNum;
                    $args['client_id'] = $client->id;                    
                    
                    $tradeHistory = new TradeHistory($args);

                    $tradeHistory->save();

                    DB::table('trades')->delete();
        
                    return redirect()->back()->with('success',"Trade with $client->client_name [$client->client_game_id] added successfully!");
                }
            }
            return redirect()->back()->withErrors("Add trades first!");

        }
    }

    public function edit(Client $client)
    {
        return view('pages.clients.edit',[
            'client' => $client
        ]);
    }

    public function update (UpdateItemRequest $request, Client $client){
        
        if($request->validated())
        {
            $args = $request->only(['client_name', 'client_game_id', "comment"]);

            $client -> update($args);
            
            return redirect('admin/clients')->with('success', 'Client updated successfully');
        }
    }

    public function delete(Client $client)
    {
        $client->delete();

        return redirect('admin/clients')->with('success','Client deleted from database.');

    }

    public function search(Request $request)
    {
        $search = $request->get('search');

        $clients = Client::where('client_name', "LIKE", "%$search%")
        ->orWhere("client_game_id","LIKE","%$search%")
        ->orWhere('comment',"LIKE","%$search%")
        ->paginate(5);

        return view('pages.clients.index',[
            'clients' => $clients
        ]);
    }

    public function show(Client $client)
    {
        return view('pages.clients.show',[
            'client' => $client,
        ]);
    }

}




