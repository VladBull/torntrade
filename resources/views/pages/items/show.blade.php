<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            View item
        </h2>
    </x-slot>

    <div class="card container">
        <div class="row mt-3 mr-4">
            <div class="col-12 d-flex justify-content-end">
                <a href="{{ route('items.index')}}" class="btn btn-sm btn-primary text-white">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h3>{{ $item->name }}</h3>
                <div>Item id: [{{ $item->game_item_id }}]</div>
                <div>Item type: {{ $item->type }}</div>
                <div><a href="https://www.torn.com/imarket.php#/p=shop&step=shop&type=&searchname={{$item->name}}">
                    <img src="http://torn.com/images/items/{{$item->game_item_id}}/large.png" alt='Item Image'></a>
                </div>
            </div>
            <div class="col-8">
                <h3>Description</h3>
                <p>{{ $item->description }}</p>
            </div>
        </div>      
    </div>
    <div class="card container mt-2">
        <div class="row">
            <div class="col">
                <p>My price: ${{ number_format($item->my_price) }}</p>
            </div>
            <div class="col">
                <p>Market Value: ${{ number_format($item->market_value) }}</p>
            </div>
            <div class="col">
                <p>Buy price: ${{ number_format($item->buy_price) }}</p>  
            </div>
            <div class="col">
                <p>Sell price: ${{ number_format($item->sell_price) }}</p>
            </div>
            <div class="col">
                <p>Circulation: {{ number_format($item->circulation) }}</p>
            </div>
        </div>
    </div>

</x-app-layout>