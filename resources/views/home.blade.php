

@extends('layout.shared')

@section('style')
<link rel="stylesheet" href="{{ asset('/css/home.css') }}"/>
@endsection

@section('title','Home')

@section('content')
    <section class="banner">
        <h1>Resto</h1>
    </section>
    @if($favourites->count())
    <section class="favourite">
        <center style="margin-top: 50px">
            <h3>Favourite items</h3>
        </center>
        
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach ($favourites as $favourite)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}" class="{{$loop->index==0 ? 'active':''}}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
              
                @foreach ($favourites as $favourite)
                <div class="carousel-item {{$loop->index==0 ? 'active':''}}">
                    <img class="d-block w-25" src="{{$favourite->image}}" alt="First slide" style="margin-inline:auto">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 style="color: darkgrey">{{$favourite->name}}</h5>
                    
                    </div>
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
    </section>
    @endif
       
    
    
    <section class="about" style="padding-bottom: 50px">
        <h3>ABOUT</h3>
        <h5>We serve good food, quality food, the best of food</h5>
    </section>
@endsection