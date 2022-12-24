

@extends('layout.shared')

@section('style')

<link rel="stylesheet" href="{{ asset('/css/home.css') }}"/>
@endsection

@section('title','Home')

@section('content')
    <section class="banner">
        <h1>Resto</h1>
    </section>
    <section class="about">
        <h3>about</h3>
        <h5>We serve the best food made with fresh ingredients by skilled chefs. Our menu has options for every palate. Our friendly staff provides excellent service. Come try us and taste the difference – we know you'll agree that we serve good food, quality food, the best of food.</h5>
    </section>
    @if($favourites->count())
    <section class="favourite">
        <h3>Favourite items</h3>
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
       
    
    

@endsection