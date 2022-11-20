<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            Items
        </h2>
    </x-slot>
    
    <div class="card my-4">
        <div class="card-body">         
            <div class="row">
                <div class="col-3">
                    <form action="{{ route('items.search') }}" method="GET" >
                        @csrf
                        <label for="search" class="m-1">Search:</label>
                        <input type="text" class="form-control" name="search" id="search">
                        <button type="submit" class="btn btn-sm btn-primary text-white m-1">Search</button>
                    </form>
                </div>
                <div class="col-2">
                    <form action="" method="GET" >
                            <label for="items" class="m-1">Nr. of items:</label>
                            <select class="form-select" name="items">
                                <option value="0" {{isset($_GET['items']) && $_GET['items'] == 0 ? 'selected' : ''}}>Show all</option>
                                <option value="10" {{isset($_GET['items']) && $_GET['items'] == 10 ? 'selected' : ''}}>10</option>
                                <option value="25" {{isset($_GET['items']) && $_GET['items'] == 25 ? 'selected' : ''}}>25</option>
                                <option value="50" {{isset($_GET['items']) && $_GET['items'] == 50 ? 'selected' : ''}}>50</option>
                            </select>
                        <div class="mb-2">
                            <button type="submit" class="btn btn-sm btn-primary text-white m-1">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="col-5"></div>
                <div class="col-2 d-flex justify-content-end">
                    <div class="col-6">
                        <a href="{{ route('items.add')}}" class="btn btn-sm btn-primary text-white my-1">Add items</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                <table class="table mt-5 table table-striped">
                    <thead>
                        <tr valign="top">
                            <th>Name</th>
                            <th>Item id</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>My price</th>
                            <th>Market Value</th>
                            <th>Buy Price</th>
                            <th>Sell Price</th>
                            <th>Circulation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{$item->name}}
                                <div>
                                    <a href="https://www.torn.com/imarket.php#/p=shop&step=shop&type=&searchname={{$item->name}}">
                                        <img src="http://torn.com/images/items/{{$item->game_item_id}}/large.png" alt='Item Image'>
                                    </a>
                                </div>
                            </td>
                            <td>{{$item->game_item_id}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{$item->type}}</td>
                            <td>${{ number_format($item->my_price)}}</td>
                            <td>${{ number_format($item->market_value)}}</td>
                            <td>${{ number_format($item->buy_price)}}</td>
                            <td>${{ number_format($item->sell_price)}}</td>
                            <td>{{ number_format($item->circulation)}}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{route('items.show',[ 'item' => $item->id ])}}" class="btn btn-sm btn-primary text-white">View</a>
                                    <a href="{{route('items.edit',[ 'item' => $item->id ])}}" class="btn btn-sm btn-success text-white">Edit</a>
                                </div>
                                <div class="col text-center">
                                    <form action="{{route('items.delete',[ 'item' => $item->id ])}}"  method="post">
                                        @csrf
                                        @method('delete')
                                        <button class='btn btn-sm btn-danger text-white' type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">{{$items->withQueryString()->links()}}</div>
            </div>  
        </div>
    </div>
</x-app-layout>