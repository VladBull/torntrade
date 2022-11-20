<x-app-layout>   
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            Edit item: {{$item->name}}
        </h2>
    </x-slot>

    <div class="card my-4">
        <div class="card-body">

            <div class="row">
                <div class="col-6 m-auto">
                    <form action="{{route('items.update',['item' => $item->id])}}" method="POST">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            cc
                        </div> 
                        <div class="mb-3">
                            <label for="game_item_id" class="form-label">Game Item id</label>
                            <input type="number" class="form-control" name="game_item_id" placeholder="Item ID" id="game_item_id" value="{{$item->game_item_id}}">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5">{{$item->description}}</textarea>
                        </div> 
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <textarea class="form-control" id="type" name="type" placeholder="Type" rows="1">{{$item->type}}</textarea>
                        </div> 
                        <div class="input-group mb-3">
                            <span class="input-group-text">My price</span>
                            <input type="number" class="form-control" placeholder="My price" name="my_price" id="my_price" value="{{$item->my_price}}">
                          </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Market value</span>
                            <input type="number" class="form-control" placeholder="Market value" name="market_value" id="market_value" value="{{$item->market_value}}">
                          </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Buy price</span>
                            <input type="number" class="form-control" placeholder="Buy price" name="buy_price" id="buy_price" value="{{$item->buy_price}}">
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text">Sell price</span>
                            <input type="number" class="form-control" placeholder="Sell price" name="sell_price" id="sell_price" value="{{$item->sell_price}}">
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text">Circulation</span>
                            <input type="number" class="form-control" placeholder="Circulation" name="circulation" id="circulation" value="{{$item->circulation}}">
                          </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary text-white">Edit item</button>
                        </div>
                   </form>
            </div>         
        </div>
    </div>
</x-app-layout>