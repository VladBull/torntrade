<x-app-layout>   
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            Add item
        </h2>
    </x-slot>

    <div class="card my-4">
        <div class="card-body">

            <div class="row">
                <div class="col-6 m-auto">
                    <form action="{{ route('items.save')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label"></label>
                            <input type="text" class="form-control" name="name" placeholder="Name" id="name" aria-describedby="nameHelp" value="{{old('name')}}">
                        </div> 
                        <div class="mb-3">
                            <label for="game_item_id" class="form-label"></label>
                            <input type="number" class="form-control" name="game_item_id" placeholder="Item ID" id="game_item_id" value="{{old('game_item_id')}}">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                        </div> 
                        <div class="mb-3">
                            <label for="type" class="form-label"></label>
                            <textarea class="form-control" id="type" name="type" placeholder="Type" rows="1"></textarea>
                        </div> 
                        <div class="input-group mb-3">
                            <span class="input-group-text">My price</span>
                            <input type="number" class="form-control" placeholder="My price" name="my_price" id="my_price">
                          </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Market value</span>
                            <input type="number" class="form-control" value="0" placeholder="Market value" name="market_value" id="market_value">
                          </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Buy price</span>
                            <input type="number" class="form-control" value="0" placeholder="Buy price" name="buy_price" id="buy_price">
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text">Sell price</span>
                            <input type="number" class="form-control" value="0" placeholder="Sell price" name="sell_price" id="sell_price">
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text">Circulation</span>
                            <input type="number" class="form-control" value="0" placeholder="Circulation" name="circulation" id="circulation">
                          </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary text-white">Add item</button>
                        </div>
                   </form>
            </div>         
        </div>
    </div>
</x-app-layout>