

@extends('layout.shared')

@section('style')

<link rel="stylesheet" href="{{ asset('/css/home.css') }}"/>
@endsection

@section('title','Home')

@section('content')
    <section class="banner">
        <h1>Resto</h1>
    </section>
    <section style="height: 32em" class="about d-flex justify-content-center">
        <h3>about</h3>
        <p>We serve the best food made with fresh ingredients by skilled chefs. Our menu has options for every palate. Our friendly staff provides excellent service. Come try us and taste the difference – we know you'll agree that we serve good food, quality food, the best of food.</p>
    </section>
    <section class="d-flex flex-column align-items-center mt-3">
        <div class="d-flex flex-column w-100">
            <div class="row d-flex flex-row w-100 justify-content-center">
            <a href="/food" class="w-50 p-0">
                <div class="column w-100" style="background-image: url('https://i0.wp.com/digital-photography-school.com/wp-content/uploads/2018/01/Charcuterie_Darina-Kopcok.jpg?ssl=1')">
                    <h2 class="menu">Food</h2>
                </div>
            </a>
            <a href="/beverage" class="w-50 p-0">
                <div class="column w-100" style="background-image: url('https://www.mensjournal.com/wp-content/uploads/2022/01/rumcocktail.jpg?w=900&h=506&crop=1&quality=86&strip=all')">
                    <h2 class="menu">Drink</h2>
                </div>
            </a>
            </div>
            <div class="row">
                <a href="/dessert" class="w-100 p-0">
                    <div class="column w-100" style="background-image: url('https://images.eatsmarter.com/sites/default/files/styles/max_size/public/dark-chocolate-ice-cream-463219.jpg')">
                        <h2 class="menu">Dessert</h2>
                    </div>
                </a>
            </div>
        </div>
    </section>
    @if($favourites->count())
    <section class="favourite mb-5" style="height:40em;">
        <h3 class="mb-4" style="margin-top:1em">Our favourite items</h3>
        
        <div id="carouselExampleIndicators" class="carousel slide w-100" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach ($favourites as $favourite)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}" class="{{$loop->index==0 ? 'active':''}}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
              
                @foreach ($favourites as $favourite)
                <a class="carousel-item {{$loop->index==0 ? 'active':''}}" href="/products/{{$favourite->id}}">
                <div>
                    @if (Storage::disk('public')->exists($favourite->image))
                    <div class="d-block w-100 favourite-item" style="background-attachment: fixed; background-position:center; background-size:cover; height:35em;background-image:url('{{Storage::url($favourite->image)}}')"></div>
                    @else
                    <div class="d-block w-100 favourite-item" style="background-attachment: fixed; background-position:center; background-size:cover; height:35em;background-image:url('{{$favourite->image}}')"></div>
                    
                    @endif
                    
                    {{-- <img class="d-block w-25" src="" alt="First slide"> --}}
                    <div class="carousel-caption d-none d-md-block">
                        <p style="color: rgb(241, 241, 241)">{{$favourite->name}}</p>
                    
                    </div>
                </div>
                </a>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              
            </a>
          </div>
    </section>
    @endif
    <section style="height: 55em;" class="about d-flex justify-content-center align-items-center">
        <p style="font-size: 3rem">we serve good food, quality food, the best of food.</p>
        <a href="/login"><button class="btn join">Join Now</button></a>
    </section>
    
    

@endsection