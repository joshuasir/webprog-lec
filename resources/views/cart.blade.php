@extends('layout.shared')

@section('title','Cart')

@section('style')
<link rel="stylesheet" href="{{ asset('/css/cart.css') }}"/>
@endsection

@section('content')
<div style="height: 50em" class="container d-flex flex-row justify-content-center w-100 m-0 mt-5 mw-100 w-100">
<div style="width:55em">
  {{-- <h1 style="margin-top: 25px"> My Cart</h1> --}}
  @if($cartitems!=null && count($cartitems->cartDetail()->get())>0)
  @if(session()->has('success'))
  <div class="alert alert-dark alert-dismissible fade show d-flex" role="alert">
    <span>{{session('success')}}</span>
    <button type="button" class="close bg-danger text-light border-1 border-danger ms-auto px-2 rounded" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  <table class="table table-striped cart-table" style="margin-top: 20px">
    <thead class="thead-dark">
      <tr>
        <th scope="col">No</th>
        <th scope="col">Item Image</th>
        <th scope="col">Item Name</th>
        <th scope="col">Item Price</th>
        <th scope="col">Item Quantity</th>
        <th scope="col">Total Price</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @for ($i = 0; $i < count($cartitems->cartDetail()->get()); $i++)
      <form method="post">
      @csrf
      <tr>
        
          <th scope="row">
            <h5>
              {{$i+1}}
            </h5>
          </th>
          <td>
            <div class="d-flex align-items-start justify-content-start">
            @if (Storage::disk('public')->exists($cartitems->cartDetail()->get()[$i]->item()->first()->image))
              <img src="{{Storage::url($cartitems->cartDetail()->get()[$i]->item()->first()->image)}}" alt="card-image" width="45px" height="45px">
            @else
              <img src="{{$cartitems->cartDetail()->get()[$i]->item()->first()->image}}" alt="card-image" width="45px" height="45px">
            @endif
            </div>
          <td>
            <p class="muted">
              {{$cartitems->cartDetail()->get()[$i]->item()->first()->name}}
            </p>
          </td>
          <td>
            <p class="muted">
              IDR {{$cartitems->cartDetail()->get()[$i]->item()->first()->price}}
            </p>
          </td>
          <td class="quantity">
            <p class="muted">
                {{$cartitems->cartDetail()->get()[$i]->quantity}}  
              </p>
          </td>
        
          <td class="total-price">
            <p class="muted">
              IDR {{$cartitems->cartDetail()->get()[$i]->quantity*$cartitems->cartDetail()->get()[$i]->item()->first()->price}}
            </p>
          </td>
          <td>
              <input type="hidden" name="cart_id" value="{{$cartitems->cartDetail()->get()[$i]->cart_id}}">
              <input type="hidden" name="item_id" value="{{$cartitems->cartDetail()->get()[$i]->item_id}}">
              <div id="action">
              <a href="/updateCartQuantity/{{$cartitems->cartDetail()->get()[$i]->item()->first()->id}}" class="btn btn-link btn-rounded btn-sm fw-bold text-decoration-none mb-2"
                data-mdb-ripple-color="dark">
              
                Edit
           
              {{-- <button type="button" class="btn btn-warning btn-sm" >Update</button> --}}
            </a>
            <button class="btn btn-danger btn-sm" formaction="/deleteCartItem" type="submit" >Delete</button>
              
              </div>
          </td>
      </tr>
      </form>
      @endfor
    </tbody>
  </table>

  <span style="font-size: 1.2rem">
    Grand Total: IDR 
  <span class="grand-total">{{$cartitems->sum}}</span> </span>
  
</div>


<div class="checkout-form p-4" style="width: 22em;">
    <form action="/checkout" method="post">
      <h3>Credentials</h3>
      @csrf
      <input type="hidden" name="cart_id" value="{{$cartitems->id}}">
      <div class="form-group">
        <label for="name">Receiver name</label>
        <input type="name" class="form-control" id="name" name="name" placeholder="Enter name" value="{{Session::get('user')['username']}}">
      </div>
      <div class="form-group">
        <label for="address">Receiver address</label>
        <input type="address" class="form-control" id="address" name="address" placeholder="Enter address" >
      </div>
      <button class="btn btn-success btn-sm" type="submit" style="width: 175px; height: 40px">Checkout ({{$cartitems->ctr}})</button>
      @if($errors->any())
      <div class="alert alert-danger" role="alert">
          {{$errors->first()}}
      </div>
      @endif
  </form>
  @else
  <div class="d-flex flex-column align-items-center justify-content-center">
    <!-- <img src="https://img.freepik.com/premium-vector/sketched-empty-trash-bin-desktop-icon-trash-can-vector-sketch-illustration_231873-3361.jpg?w=2000" alt=""> -->
    <h1 class="text-center pt-5 mt-5">Cart is empty</h1>
    <h1 class="text-center pb-5">Let’s go <a href="/food" class="text-decoration-none" >shopping</a>!</h1>
    
 </div>
  @endif
  </div>
</div>
  @endsection




