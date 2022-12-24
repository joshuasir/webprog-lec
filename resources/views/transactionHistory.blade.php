@extends('layout.shared')
@section('title','Transaction History')
@section('style')
<link rel="stylesheet" href="{{ asset('/css/transaction.css') }}"/>

@endsection
@section('content')
    <div style="margin-top: 8em;" class="container mb-5" >
        <h1>Transaction History</h1>
        @if($histories!=null && count($histories)>0)

    <div class="accordion mt-4" id="accordion">
        @foreach($histories as $history)
        <div class="card">
            <div class="card-header bg-light" id="heading{{$loop->iteration}}">
            <h5 class="mb-0 d-flex align-items-center">
                <button class="btn btn-link btn-block text-left text-primary text-decoration-none" type="button" data-toggle="collapse" data-target="#collapse{{$loop->iteration}}" aria-expanded="true" aria-controls="collapse{{$loop->iteration}}" style="font-size: 20px">
                    {{trim(explode(" ",$history->created)[0])}}
                </button>
                <button class="btn btn-link btn-block text-left text-primary text-decoration-none ms-auto" type="button" data-toggle="collapse" data-target="#collapse{{$loop->iteration}}" aria-expanded="true" aria-controls="collapse{{$loop->iteration}}">
                    🔻
                </button>
            </h5>
            </div>
            <div id="collapse{{$loop->iteration}}" class="collapse @if($loop->iteration == 1) show @endif" aria-labelledby="heading{{$loop->iteration}}" data-parent="#accordion">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">Image</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Item Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($history->transactionDetail()->get() as $transaction_detail)
                            <tr>
                                <th scope="row">
                                    <h5>
                                        {{$loop->iteration}}
                                    </h5>
                                    
                                </th>
                                <td>
                                    @if (Storage::disk('public')->exists($transaction_detail->item()->first()->image))
                                        <img src="{{Storage::url($transaction_detail->item()->first()->image)}}" alt="card-image" width="80" height="80">
                                    @else
                                        <img src="{{$transaction_detail->item()->first()->image}}" alt="card-image" width="80" height="80">
                                    @endif
                                
                                </td>
                                <td>
                                    <h5>
                                        {{$transaction_detail->item()->first()->name}}
                                    </h5>
                                </td>
                                <td>
                                    <h5>
                                        {{$transaction_detail->item()->first()->price}}
                                    </h5>
                                </td>
                                <td>
                                    <h5>
                                        {{$transaction_detail->quantity}} 
                                    </h5>
                                </td>
                                <td>
                                    <h5>
                                        IDR {{$transaction_detail->quantity*$transaction_detail->item()->first()->price}}
                                    </h5>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                        <span class="ms-auto" style="font-size: 20px"> Grand Total : IDR {{$history->sum}}</span>
                    </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <h3 class="text-center mt-5">No transaction yet.</h3>
    @endif
</div>
@endsection