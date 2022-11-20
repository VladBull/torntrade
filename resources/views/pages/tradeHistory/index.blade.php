<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            Trade History
        </h2>
    </x-slot>

    <div class="card my-4">
        <div class="card-body">         
            <div class="row">
                <div class="col-3">
                    <form action="{{ route('tradeHistory.search') }}">
                    @csrf
                    <label for="search" class="m-1">Search:</label>
                    <input type="text" class="form-control" name="search" id="search">
                    <button type="submit" class="btn btn-sm btn-primary text-white m-1">Search</button>
                    </form>
                </div>
                <div class="col-2">
                    <form action="" method="GET">
                            <label for="tradeHistories" class="m-1">Nr. of trades</label>
                            <select name="tradeHistories" class="form-select">
                                <option value="0" {{isset($_GET['tradeHistories']) && $_GET['tradeHistories'] == 0 ? 'selected' : ""}}>Show all</option>
                                <option value="10" {{isset($_GET['tradeHistories']) && $_GET['tradeHistories'] == 10 ? 'selected' : ""}}>10</option>
                                <option value="25" {{isset($_GET['tradeHistories']) && $_GET['tradeHistories'] == 25 ? 'selected' : ""}}>25</option>
                                <option value="50" {{isset($_GET['tradeHistories']) && $_GET['tradeHistories'] == 50 ? 'selected' : ""}}>50</option>
                            </select>
                        <div class="mb-2">
                            <button type="submit" class="btn btn-sm btn-primary text-white m-1">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                <table class="table mt-5 table table-striped">
                    <thead>
                        <tr valign="top">
                            <th>No</th>
                            <th>Summary</th>
                            <th>Total</th>
                            <th>Profit</th>
                            <th>Client [id]</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tradeHistories as $tradeNum => $tradeHistory)
                            
                            <tr>
                                <td>{{ count($tradeHistories) - $tradeNum }}</td>
                                <td>
                                    <ul>
                                        @foreach(explode(";", $summary = $tradeHistory->summary) as $summaryExploded)    
                                        <li>{{$summaryExploded}}</li>
                                        @endforeach
                                    </ul>

                                </td>
                                <td>${{number_format($tradeHistory->total)}}</td>
                                <td>${{number_format($tradeHistory->profit)}}</td>  
                                <td>{{$tradeHistory->client->client_name ? $tradeHistory->client->client_name : 'N/A' }} [{{$tradeHistory->client->client_game_id ? $tradeHistory->client->client_game_id : 'N/A' }}]</td>
                                <td>{{$tradeHistory->created_at->format('d.m.Y')}}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{route('tradeHistory.show',[ 'tradeHistory' => $tradeHistory->id ])}}" class="btn btn-sm btn-primary text-white">View</a>
                                        <form action="{{route('tradeHistory.delete', [ 'tradeHistory' => $tradeHistory->id ])}}"  method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class='btn btn-sm btn-danger text-white'>Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">{{$tradeHistories->links()}}</div>
            </div>  
        </div>
    </div>
</x-app-layout>