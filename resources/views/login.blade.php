@extends('layout.shared')
@section('title','Login')
@section('style')
    <link rel="stylesheet" href="{{ asset('/css/login.css') }}"/>
@endsection


@section('content')
<section style="background-color: #201e1e;  height: 70em">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-0">
            <div class="row justify-content-start">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1 p-5">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Login</p>

                <form action="/login" method="post">
                  @csrf

                

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="email" style="margin-bottom: 5px">Email address</label>
                      <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" value="{{((Cookie::get('email') !== null) ? Cookie::get('email') : '')}}">
                  </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label for="password" class="form-label" style="margin-bottom: 5px">Password</label>
                    
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="{{((Cookie::get('password') !== null) ? Cookie::get('password') : '')}}">
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="checkbox" class="form-check-input" id="remember" name="remember" {{Cookie::get('email') === null ? '':'checked'}}>
                      <label class="form-check-label" for="remember" name="remember">Remember me</label>
                    </div>
                  </div>
                 

                  <div class="d-flex flex-column align-items-start mx-4 mb-3 mb-lg-4">
                    <p class="mb-2">don't have an account yet? <a href="/register">Register</a></p>
                    <button type="submit" class="btn btn-primary btn-lg">Login</button>
                    @if($errors->any())
                    <div class="alert alert-danger mt-2" role="alert"  style="width: 100%">
                        {{$errors->first()}}
                    </div>
                    @elseif(session()->has('register_success'))
                        <div class="alert alert-success mt-4" style="width: 100%">
                            {{ session()->get('register_success') }}
                        </div>
                    @endif  
                  </div>

                </form>

              </div>
              <div class="col-lg-6 d-flex align-items-start">
    
                <img src="https://i.pinimg.com/564x/24/7e/77/247e77adb9c3835cd028dd61abbb819f.jpg"
                class="img-fluid w-100" alt="Sample image">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>



@endsection