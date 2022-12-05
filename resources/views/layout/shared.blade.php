<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    
     <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}" >
     <link rel="stylesheet" href="{{ asset('/css/layout.css') }}"/>    

</head>
    @yield('style')
<body>
    
  <nav class="navbar navbar-expand-lg navbar-light">

        <button class="navbar-toggler navbar-dark mb-2 border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto left">

              <li class="nav-item active">
                <a class="nav-link" href="/">
                  Home
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Menu
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="/food">Foods</a>
                  <a class="dropdown-item" href="/beverage">Beverages</a>
                  <a class="dropdown-item" href="/dessert">Desserts</a>
                </div>
              </li>
             
          
            @if(Session::get('user') && Session::get('user')['role']==='admin')
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Manage Item
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/manageItem">View Item</a>
                <a class="dropdown-item" href="/addItem">Add Item</a>
              </div>
            </li>
            @elseif(Session::get('user') && Session::get('user')['role']==='customer')
            <li class="nav-item">
              <a class="nav-link" href="/cart">My Cart</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/transactionHistory">Transaction History</a>
                </li>
            @endif
            


            {{-- SEARCH BAR --> name: search --}}
          
        </ul>

          <ul class="navbar-nav ms-auto ml-lg-5">
            @if(Session::get('user'))
            <li class="nav-item dropdown" style="padding-right:1em">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Profile
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">{{Session::get('user')['username']}}</a>
                <a class="nav-link" href="/logout">Logout</a>
                </div>
            </li>
          
              @else
              <li class="nav-item">
                  <a class="nav-link" href="/register">Register</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/login">Login</a>
                </li>
              @endif
          </ul>

        </div>
    </nav>
    
    
    <div class="content">
        @yield('content')
    </div>

    <div class="footer">
        <h5>©2022 Copyright Resto</h5>
        
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>