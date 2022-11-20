<x-app-layout>   
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            Edit item: {{$trade->item->name}} x {{number_format($trade->quantity)}}
        </h2>
    </x-slot>
    <div class="card my-4">       
        <div class="card-body">
            <div class="row">
                <table class="table">
                    <thead>
                        <th class="col-8">Change trade items</th>
                        <th class="col-2">Quantity</th>
                        <th class="col-2">
                        </th>
                    </thead>
                    <tbody>
                        <form action="{{ route('trades.update',['trade' => $trade->id]) }}" method="POST">
                            @csrf 
                            @method('put')
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
                                    <input type="number" class="form-control" value="{{$trade->quantity}}" placeholder="Qantity" name="quantity" id="quantity">
                                </div>  
                            </td>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-sm btn-primary text-white m-1">Edit item</button>
                            </div>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>               
    </div>
</x-app-layout>