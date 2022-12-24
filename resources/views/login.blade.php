@extends('layout.shared')
@section('title','Login')
@section('style')
    <link rel="stylesheet" href="{{ asset('/css/login.css') }}"/>
@endsection


@section('content')

  <form action="/login" method="post" style="margin-left: 550px">
    @csrf
    <h1 style="margin-top: 15px">Login</h1>
    <div class="form-group" style="margin-top: 25px">
      <label for="email" style="margin-bottom: 5px">Email address</label>
      <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" value="{{((Cookie::get('email') !== null) ? Cookie::get('email') : '')}}">
    </div>
    <div class="form-group">
      <label for="password" style="margin-bottom: 5px">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="{{((Cookie::get('password') !== null) ? Cookie::get('password') : '')}}">
    </div>
    <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" id="remember" name="remember" {{Cookie::get('email') === null ? '':'checked'}}>
        <label class="form-check-label" for="remember" name="remember">Remember me</label>
      </div>
    <button type="submit" class="btn btn-primary">Login</button>
    @if($errors->any())
    <div class="alert alert-danger" role="alert">
        {{$errors->first()}}
    </div>
    @elseif(session()->has('register_success'))
        <div class="alert alert-success mt-4" style="width: 325px">
            {{ session()->get('register_success') }}
        </div>
    @endif 
  </form>


<div class="register-container" style="margin-left: 550px">
    <p>Don't have an account yet?</p>
    <a href="/register"><button class="btn btn-outline-primary">Register</button></a>
</div>

@endsection