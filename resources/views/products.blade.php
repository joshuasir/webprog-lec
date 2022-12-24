@extends('layout.shared')
@section('title',$title)

@section('style')
<link rel="stylesheet" href="{{ asset('/css/products.css') }}"/>
@endsection

@section('content')
<div class="container">
  <div class="center">
    <h1>
      <span>{{$title}}</span>
      @if($title=="Foods")
      <span style="color: #ffbf10">{{$title}}</span>
      @elseif ($title=="Drinks")
      <span style="color:aqua">{{$title}}</span>
      @else
      <span style="color: cornsilk">{{$title}}</span>
      @endif

      <span>{{$title}}</span>
    
    </h1>
  </div>
{{-- <h1 class="text-center mb-4">{{$title}}</h1> --}}
@if(Session::get('user') || true)
  <form action="/{{strtolower($category)}}" type="get" class="searchbar">
    <div class="input-group justify-content-center">
      <input type="text" class="form-control" name="search" value = "{{request('search')}}" placeholder="Search Item..." aria-label="Search product..." aria-describedby="button-addon2">
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
      <a href="/products/{{$p->id}}"> 
      <div class="card">
        
          @if (Storage::disk('public')->exists($p->image))
          <div style="background-image: url({{Storage::url($p->image)}})"  class="custom-card-text">
            {{-- <img src="{{Storage::url($p->image)}}" alt="card-image"> --}}
          @else
          <div style="background-image: url({{$p->image}})"  class="custom-card-text">
            {{-- <img src="{{$p->image}}" alt="card-image"> --}}
          @endif
        
        {{-- <div class="custom-card-text"> --}}
          
          
        </div>
        <div class="info left">
          <h1 style="line-height: .6em;" class="card-title">{{$p->name}}</h1>
          
            <span style="font-weight:100; font-size:1.5rem">Rp. {{$p->price}}</span>
          
            
          </div>
      </div>
    </a>
    </div>
    @endforeach
    <div class="d-flex justify-content-center">
      {{$products->links()}}
    </div>
  </div>
</div>


@else

<h1 class="text-center pb-5 empty">No Products Available</h1>
@endif
</div>
@endsection