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
      <span style="color: #ffd45e">{{$title}}</span>
      @elseif ($title=="Drinks")
      <span style="color:rgb(117, 193, 255)">{{$title}}</span>
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
        @if($title=="Foods")
        <button class="btn" style="background-color: #ffd45e" type="submit">
        
        @elseif ($title=="Drinks")
        <button class="btn" style="background-color:rgb(117, 193, 255)" type="submit">
        
        @else
        <button class="btn" style="background-color: cornsilk" type="submit">
      
        @endif
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
          <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
        </svg>
      </button>
      </div>
    </div>
  </form>
@endif
@if($products->count())
<div class="wrapper flex-d justify-content-center">
  <div class="row">
    @foreach ($products as $p)
    <div class="col-md-4 col-sm-12">
      <a href="/products/{{$p->id}}" class="d-flex justify-content-center"> 
      <div class="card">
        
          @if (Storage::disk('public')->exists($p->image))
          <div style="background-image: url('{{Storage::url($p->image)}}')"  class="custom-card-text">
            {{-- <img src="{{Storage::url($p->image)}}" alt="card-image"> --}}
          @else
          <div style="background-image: url('{{$p->image}}')"  class="custom-card-text">
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