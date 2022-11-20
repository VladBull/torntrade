<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Client;
use App\Models\TradeHistory;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $tradeHistories = TradeHistory::all();

        $numberOfTrades = TradeHistory::count();
        $firstTradeDate = TradeHistory::orderBy('created_at', 'ASC')->first();
        $uniqueClients = Client::distinct()->count('client_name');
        $totalTradeValue = 0;
        $totalProfit = 0;
        $averageProfit = 0;           
        $totalItems = 0;

        foreach($tradeHistories as $tradeHistory)
        {
            $totalProfit += $tradeHistory->profit;
            $totalTradeValue += $tradeHistory->total;
            $totalItems += $tradeHistory->total_items;
        }
        
        if($numberOfTrades != 0){
            $averageProfit = $totalProfit / $numberOfTrades;
        } else {
            $averageProfit = 0;
        }

        return view('pages.profile.index',[
            'user' => Auth::user(),
            'tradeHistories' => $tradeHistories,
            'numberOfTrades' => $numberOfTrades,
            'firstTradeDate' => $firstTradeDate,
            'totalProfit' => $totalProfit,
            'totalTradeValue' => $totalTradeValue,
            'averageProfit' => $averageProfit,
            'uniqueClients' => $uniqueClients,
            'totalItems' => $totalItems
        ]);
    }

    public function update(UpdateProfileRequest $request)
    {
        if($request->validated())
        {
            $args = $request->only(['name']);

            /** @var User $user */  //Dock block ca sa functioneze variabila user
            $user = Auth::user();

            if($request->file('profile_image')){
                $profileImage = $request->file('profile_image');
                $storedImage = $profileImage->storeAs('public/profile_images','profile_image_'.$user->id.".".$profileImage->getClientOriginalExtension());
                $storedImage = str_replace("public","storage",$storedImage);
                $user->profile_image = $storedImage;

            }

            $user->name = $args['name'];

            $user->save();

            return redirect()->back()->with('success','Profile saved');
        }
    }
}
