<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{-- {{ __('Dashboard') }} --}}
            Dashboard
        </h2>
    </x-slot>
    <div class="card my-4">
        <table class="table mt-5 table table-striped border">
                <tr>
                    <th>
                        <a href="https://www.torn.com/profiles.php?XID=2321305" target="_blank" rel="noopener noreferrer">
                            <b>VladBull's profile</b>
                        </a> 
                    </th>
                    <th>
                        <a href="https://www.torn.com/trade.php#step=start&userID=2321305" target="_blank" rel="noopener noreferrer">
                            <b>Initiate trade</b>
                        </a>
                    </th>
                    <th>
                        <a href="https://www.torn.com/forums.php#/p=threads&f=10&t=16115993&b=0&a=0" target="_blank" rel="noopener noreferrer">
                            <b>Give feedback</b>
                        </a>
                    </th>
                </tr>
        </table>
            <div></div>
        @if(count($types) > 0)
            <div class="row">
                @foreach($types as $type)
                    <div class="col-3">
                        <div class="card my-4 shadow">
                            <div class="card-body">
                                <div class="text-center">
                                    <h3>{{$type->type}}</h3>
                                    <table class="table mt-5 table table-striped border">    
                                        <div class="card-body">
                                            @foreach($items as $item)
                                                @if($item->type === $type->type)
                                                    <div class="border"> 
                                                        <a href="https://www.torn.com/imarket.php#/p=shop&step=shop&type=&searchname={{$item->name}}">
                                                            <img src="http://torn.com/images/items/{{$item->game_item_id}}/large.png" alt='Item Image' width="60px" height="auto">
                                                        </a>
                                                        {{$item->name}} - ${{ number_format($item->my_price)}}
                                                    </div> 
                                                @endif    
                                            @endforeach                     
                                        </div>
                                    </table> 
                                </div>
                            </div>
                        </div>
                    </div>  
                @endforeach
            </div>
        @endif
</x-app-layout>

