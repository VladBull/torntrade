<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            Clients
        </h2>
    </x-slot>
    
    <div class="card my-4">
        <div class="card-body">         
            <div class="row">
                <div class="col-3">
                    <form action="{{ route('clients.search') }}" method="GET" >
                        @csrf
                        <label for="search" class="m-1">Search:</label>
                        <input type="text" class="form-control" name="search" id="search">
                        <button type="submit" class="btn btn-sm btn-primary text-white m-1">Search</button>
                    </form>
                </div>
                <div class="col-2">
                    <form action="" method="GET" >
                            <label for="clients" class="m-1">Nr. of items:</label>
                            <select class="form-select" name="clients">
                                <option value="0" {{isset($_GET['clients']) && $_GET['clients'] == 0 ? 'selected' : ''}}>Show all</option>
                                <option value="10" {{isset($_GET['clients']) && $_GET['clients'] == 10 ? 'selected' : ''}}>10</option>
                                <option value="25" {{isset($_GET['clients']) && $_GET['clients'] == 25 ? 'selected' : ''}}>25</option>
                                <option value="50" {{isset($_GET['clients']) && $_GET['clients'] == 50 ? 'selected' : ''}}>50</option>
                            </select>
                        <div class="mb-2">
                            <button type="submit" class="btn btn-sm btn-primary text-white m-1">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="col-5"></div>
            </div>
            <div class="row">
                <div class="col-12">
                <table class="table mt-5 table table-striped">
                    <thead>
                        <tr valign="top">
                            <th>Name</th>
                            <th>Id</th>
                            <th>Comments</th>
                            <th>Last updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr>
                            <td>{{$client->client_name}}</td>
                            <td>{{$client->client_game_id}}</td>
                            <td>{{$client->comment}}</td>
                            <td>{{$client->updated_at->format('d/m/Y')}}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('clients.show',['client' => $client->id])}}" class="btn btn-sm btn-primary text-white">View</a>
                                    <form action="{{ route('clients.delete', [ 'client' => $client->id ])}}"  method="post">
                                        @csrf
                                        @method('delete')
                                        <button class='btn btn-sm btn-danger text-white' type="submit" @if($client->tradeHistory->count() > 0) disabled @endif>Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">{{$clients->withQueryString()->links()}}</div>  
            </div>  
        </div>
    </div>
</x-app-layout>