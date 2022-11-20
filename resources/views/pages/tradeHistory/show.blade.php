<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            View trade with {{ $tradeHistory->client->client_name ? $tradeHistory->client->client_name : 'N/A' }} [{{$tradeHistory->client->client_game_id ? $tradeHistory->client->client_game_id : 'N/A'}}]
        </h2>
    </x-slot>

    <div class="card container">
        <div class="row mt-3 mr-4">
            <div class="col-12 d-flex justify-content-end">
                <a href="{{ route('tradeHistory.index')}}" class="btn btn-sm btn-primary text-white">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p>Total: ${{number_format($tradeHistory->total)}}</p>
            </div>
            <div class="col">
                <p>Profit: ${{number_format($tradeHistory->profit)}}</p>
            </div>
            <div class="col">
                <p>Client: {{$tradeHistory->client->client_name ? $tradeHistory->client->client_name : 'N/A' }} [{{$tradeHistory->client->client_game_id ? $tradeHistory->client->client_game_id : 'N/A'}}]</p>
            </div>
            <div class="col">
                <p>Date: {{$tradeHistory->created_at->format('d.m.Y')}}</p> 
            </div>
        </div>
    </div>

    <div class="card container mt-2">
        <div class="row">
            <div class="col-3">
                <p>Informatii trade</p>
            </div>
            <div class="col-9">
                <p> 
                    <ul>
                        @foreach(explode(";", $summary = $tradeHistory->summary) as $summaryExploded) 
                            <li>{{$summaryExploded}}</li>
                        @endforeach
                    </ul>
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
