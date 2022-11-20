<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            My Profile
        </h2>
    </x-slot>

    <div class="row">
        {{-- partea stanga, contine foto, nume, upload si buton save --}}
        <div class="col-3">
            <div class="card my-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <img class="img-fluid rounded" src="{{$user->profile_image ? "/".$user->profile_image : 'https://via.placeholder.com/150' }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                                </div> 
                                <div class="mb-3">
                                    <label for="profile_image">Profile image</label>
                                    <input type="file" class="form-control" id="profile_image" name="profile_image">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
        {{-- partea dreapta ce contine informatiile despre profil si trades --}}
        <div class="col-9">
            <div class="card my-4">
                <ul>
                    <h4>Statistics of {{ Auth::user()->name }}:</h4>
                    <li><b>Date of first trade:</b></li>
                    {{-- && if logic. daca EXISTA $firstTradeDate SI EXISTA Created at  atunci  etc --}}
                        {{ $firstTradeDate && $firstTradeDate->created_at ? $firstTradeDate->created_at->format('d.m.Y') : 'No trades saved!'}}
                    <br><li><b>Number of unique clients:</b></li>
                        {{$uniqueClients >0 ? $uniqueClients : 'No clients saved!'}}  
                    <br><li><b>Trades done:</b></li>
                        {{ $numberOfTrades > 0 ? number_format($numberOfTrades) : 'No trades saved!' }}
                    <br><li><b>Total trade value:</b></li>
                        ${{ number_format($totalTradeValue) }}
                    <br><li><b>Total Profit:</b></li>
                        ${{ number_format($totalProfit) }}
                    <br><li><b>Average profit per trade:</b></li>
                        ${{ number_format($averageProfit)}}
                        <br><li><b>Number of items bought:</b></li>
                        {{ number_format($totalItems)}}  
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>