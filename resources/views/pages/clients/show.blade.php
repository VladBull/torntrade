<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ $client->client_name ? $client->client_name : "N/A" }} [{{ $client->client_game_id? $client->client_game_id : 'N/A' }}] client's  Profile
        </h2>
    </x-slot>

    <div class="row">
        {{-- partea stanga, contine nume, id --}}
        <div class="col-3">
            <div class="card my-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <a href="https://www.torn.com/profiles.php?XID={{$client->client_game_id}}" target="_blank" rel="noopener noreferrer">
                                <img class="img-fluid rounded" src="https://i.imgur.com/96QapNI.jpg">
                            </a>                       
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-12">
                                <div class="card my-4">
                                    <div class="row"><b>Name: {{ $client->client_name ? $client->client_name : "N/A" }} [{{ $client->client_game_id? $client->client_game_id : 'N/A' }}]</b></div>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
        {{-- partea dreapta ce contine informatiile despre profil si trades --}}
        <div class="col-9">
            <div class="card my-4">
                <div class="row m-3">
                    <div class="col-12 d-flex justify-content-end">
                        <a href="{{ route('clients.index')}}" class="btn btn-sm btn-primary text-white">Back</a>
                    </div>
                </div>
                <div class="row m-3">
                    <div class="col-4">
                        <ul>
                            <h4>Statistics of {{ $client->client_name ? $client->client_name : "N/A" }} [{{ $client->client_game_id? $client->client_game_id : 'N/A' }}]:</h4>
                            <li><b>Date of first trade:</b></li>
                                {{ $client->firstTrade && $client->firstTrade->created_at ? $client->firstTrade->created_at->format('d.m.Y') : 'No trades saved for this user!!'}}
                            <br><li><b>Date of last trade:</b></li>
                                {{ $client->lastTrade && $client->lastTrade->created_at ? $client->lastTrade->created_at->format('d.m.Y') : 'No trades saved for this user!'}}
                            <br><li><b>Trades done:</b></li>
                                {{ $client->tradesDone ? number_format($client->tradesDone) : 'No trades saved for this user!' }}
                            <br><li><b>Total trade value:</b></li>
                                ${{ $client->tradesValue ? number_format($client->tradesValue) : 'No trades saved for this user!' }}
                            <br><li><b>Total Profit:</b></li>
                                ${{ $client->profitValue ? number_format($client->profitValue) : 'No trades saved for this user!' }}
                            <br><li><b>Average profit per trade:</b></li>
                                ${{ $client->profitValue && $client->tradesDone ? number_format($client->profitValue / $client->tradesDone) : 'No trades saved for this user!' }}
                        </ul>
                    </div>
                    <div class="col-3"></div>
                    <div class="col-5">
                        <form action="{{route('clients.update',['client' => $client->id])}}" method="POST">
                            @csrf
                            @method('put')
                            <h4>Comments:</h4>
                            <textarea name="comment" id="comment" cols="30" rows="10">{{$client->comment}}</textarea>
                            {{-- Hidden fields to pass the auth --}}
                            <input type="hidden" name="name" id="name" value= null>
                            <input type="hidden" name="game_item_id" id="game_item_id" value= 0>
                            <input type="hidden" name="description" id="description" value= null>
                            <input type="hidden" name="type" id="type" value= null>

                            <button type="submit" class="btn btn-primary text-white">Save comment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>