@extends('layout.shared')
@section('title',$title)

@section('style')
<link rel="stylesheet" href="{{ asset('/css/products.css') }}"/>
@endsection

@section('content')
<div class="container">
<h1 class="text-center mb-4">{{$title}}</h1>
@if(Session::get('user') || true)
  <form action="/{{strtolower($category)}}" type="get" class="searchbar">
    <div class="input-group justify-content-center">
      <input type="text" class="form-control" name="search" value = "{{request('search')}}" placeholder="Search Product . . ." aria-label="Search product..." aria-describedby="button-addon2">
      <div class="input-group-append">
        <button class="btn btn-primary" type="submit">Search</button>
      </div>
    </div>
  </form>
@endif
@if($products->count())
<div class="wrapper flex-d justify-content-center">
  <div class="row">
    @foreach ($products as $p)
    <div class="col-md-4 col-sm-12">
      <div class="card">
        <div class="card-img-top">
          @if (Storage::disk('public')->exists($p->image))
            <img src="{{Storage::url($p->image)}}" alt="card-image">
          @else
            <img src="{{$p->image}}" alt="card-image">
          @endif
        </div>
        <div class="custom-card-text">
          <center>
            <a href="/products/{{$p->id}}"><h3 class="card-title mb-4">{{$p->name}}</h3></a>
          </center>
          
          <div class="top-info" style="margin-top: 25px">
            <div class="info ">
              <center>
                <h3>Category</h3>
              </center>
              
              <center>
                <h4>{{$p->category}}</h4>
              </center>
              
            </div>
            <div class="info right">
              <center>
                <h3>Price</h3>
              </center>
              
              <center>
                <h4>Rp. {{$p->price}}</h4>
              </center>
              
            </div>
          </div>
          <a href="/products/{{$p->id}}">
            <center>
              <div class="btn btn-primary btn-sm" style="margin-top: 75px; padding: 5px 15px; margin-bottom: 25px">
                <h5 style="color: aliceblue">
                  See Detail
                </h5>
              </div>
            </center>
          </a>
  
        </div>
      </div>
    </div>
    @endforeach
    <div class="d-flex justify-content-center">
      {{$products->links()}}
    </div>
  </div>
</div>


@else
<div class="trash">
  <img src="https://img.freepik.com/premium-vector/sketched-empty-trash-bin-desktop-icon-trash-can-vector-sketch-illustration_231873-3361.jpg?w=2000" alt="">

</div>
<h1 class="text-center pb-5">No Products Available</h1>
@endif
</div>
@endsection