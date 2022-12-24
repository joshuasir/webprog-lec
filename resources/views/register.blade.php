@extends('layout.shared')
@section('title','Register')
@section('style')
    <link rel="stylesheet" href="{{ asset('/css/register.css') }}"/>
@endsection

@section('content')

    <section style="background-color: #201e1e;  height: 70em">
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-lg-12 col-xl-11">
            <div class="card text-black" style="border-radius: 25px;">
              <div class="card-body p-0">
                <div class="row justify-content-center">
                  <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1 p-5">
    
                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
    
                    <form action="/register" method="post">
                      @csrf
    
                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <label for="fullname" style="margin-bottom: 5px" class="form-label">Full name</label>
                     
                          <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter fullname">
                       </div>
                      </div>
    
                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <label for="email" class="form-label" style="margin-bottom: 5px">Email address</label>
                       
                          <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
                      </div>
                      </div>
    
                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <label for="password" class="form-label" style="margin-bottom: 5px">Password</label>
                        
                          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                       </div>
                      </div>
    
                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <label for="confirmPassword" class="form-label" style="margin-bottom: 5px"> Confirm password</label>
                      
                          <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"placeholder="Confirm Password">
                       </div>
                      </div>
                     
    
                      <div class="d-flex flex-column align-items-start mx-4 mb-3 mb-lg-4">
                        <p class="mb-2">already have an account? <a href="/login">Login</a></p>
                        <button type="submit" class="btn btn-primary btn-lg">Register</button>
                        @if($errors->any())
                        <div class="alert alert-danger mt-4" role="alert" style="width: 100%">
                            {{$errors->first()}}
                        </div>
                      
                        @elseif(session()->has('success_message'))
                            <div class="alert alert-success" style="width: 100%">
                                {{ session()->get('success_message') }}
                            </div>
                        
                        @endif   
                      </div>
    
                    </form>
    
                  </div>
                  <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
    
                    <img src="{{asset('images/mae-mu-kbch-i63YTg-unsplash.jpg')}}"
                    class="img-fluid" alt="Sample image">
  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection