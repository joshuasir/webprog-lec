@extends('layout.shared')
@section('title','Register')
@section('style')
    <link rel="stylesheet" href="{{ asset('/css/register.css') }}"/>
@endsection

@section('content')
<div class="container">
<form action="/register" method="post">
    @csrf
    <h1>Register</h1>
    <div class="form-group">
        <label for="fullname">Full name</label>
        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter fullname">
      </div>
    <div class="form-group">
      <label for="email">Email address</label>
      <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="confirmPassword"> Confirm password</label>
        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"placeholder="Confirm Password">
      </div>

    <button type="submit" class="btn btn-primary">Register</button>
    @if($errors->any())
    <div class="alert alert-danger mt-4" role="alert">
        {{$errors->first()}}
    </div>
  
    @elseif(session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
    
    @endif   
  </form>

  <div class="login-container">
    <p>Already have an account?</p>
    <a href="/login"><button class="btn btn-outline-primary">Login</button></a>
  </div>
</div>
@endsection