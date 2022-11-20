<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            Trade page
        </h2>
    </x-slot>

    <div class="card my-4">       
        <div class="card-body">
            <div class="row">
                <table class="table">
                    <thead>
                        <th class="col-8">Add item to trade</th>
                        <th class="col-2">Quantity</th>
                        <th class="col-2">
                        </th>
                    </thead>
                    <tbody>
                        <form action="{{ route('trades.save') }}" method="POST">
                            @csrf 
                            <td> 
                                <div class="mb-3">                                            
                                    <select class="form-control" id="item_id" name="item_id">   
                                        @foreach($items as $item)
                                           <option value="{{$item->id}}">{{$item->name}} [{{$item->id}}] - ${{number_format($item->my_price)}}</option>  
                                        @endforeach 
                                    </select>   
                                </div>
                            </td>
                            <td> 
                                <div class="input-group">
                                    <span class="input-group-text">Qty</span>
                                    <input type="number" class="form-control" value="1" placeholder="Qantity" name="quantity" id="quantity">
                                </div>  
                            </td>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-sm btn-primary text-white m-1">Add item</button>
                            </div>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>               
    </div>
    <div class="card my-4">
        <div class="card-body">             
            <div class="row">
                <div class="col-12 d-flex justify-content-start">
                    <form action="{{ route('clients.save') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-5">
                                <label for="client_name" class="form-label m-2"><b>Client</b></label>
                                <input type="text" class="form-control" placeholder="Client name" name="client_name" id="client_name" value="{{old('client_name')}}">
                            </div>
                            <div class="col-5">
                                <label for="client_game_id" class="forum-label m-2"><b>Client id</b></label>
                                <input type="text" class="form-control" placeholder="Client id" name="client_game_id" id="client_game_id" value="{{old('client_game_id')}}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary text-white m-1">Save trade</button>    
                    </form> 
                </div>
                <div class="col-2">
                    <form action="{{ route('trades.deleteAll')}}"  method="POST" >
                        @csrf
                        @method('delete')
                        <div>
                            <button type="submit" class="btn btn-sm btn-danger text-white m-1">Clear trade</button>
                        </div>
                    </form>
                </div>
            </div>  
            <div class="row">
                <div class="col-12 mt-3">
                <table class="table mt-5, table table-striped">
                <div class="row">
                    <thead>
                        <tr valign="top">
                            <th>No</th>
                            <th>Items in trade</th>
                            <th>Quantity</th>
                            <th>Summary</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                </div>
                <div class="row">
                    <tbody>
                        @foreach($trades as $itemNum => $trade)
                        <tr>
                            <td>{{ ++ $itemNum }}</td>
                            <td><div>
                                    {{$trade->item->name}}
                                </div> 
                                <div>
                                    <a href="https://www.torn.com/imarket.php#/p=shop&step=shop&type=&searchname={{$trade->item->name}}">
                                        <img src="http://torn.com/images/items/{{$trade->item->game_item_id}}/large.png" alt='Item Image' width="60px">
                                    </a>
                                </div>
                            </td>
                            <td>{{number_format($trade->quantity)}}</td>
                            <td>{{$trade->item->name}} @ ${{number_format($trade->item->my_price)}} * {{number_format($trade->quantity)}} = <b>${{number_format($trade->item->my_price*$trade->quantity)}}</b> </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{route('trades.edit',[ 'trade' => $trade->id ])}}" class="btn btn-sm btn-success text-white">Edit</a>
                                    <form action="{{route('trades.delete',[ 'trade' => $trade->id ])}}"  method="post">
                                        @csrf
                                        @method('delete')
                                        <button class='btn btn-sm btn-danger text-white' type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </div>
                <div class="row">
                    <thead>
                        <tr valign="top">
                            <th>Total</th>
                            <th>Profit</th>
                        </tr>
                    </thead>
                </div>
                <div class="row">
                    <tbody>
                        <tr>
                            <td><b>${{number_format($totalMyPrice)}}</b></td>
                            <td><b>${{number_format($profit)}}</b></td>  
                        </tr>     
                    </tbody>        
                </div>
            </div>
        </div>
    </div>
</x-app-layout>