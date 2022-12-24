@extends('layout.shared')
@section('title','Register')
@section('style')
    <link rel="stylesheet" href="{{ asset('/css/register.css') }}"/>
@endsection

@section('content')
<form action="/register" method="post" style="margin-left: 550px">
    @csrf
    <h1 style="margin-top: 15px">Register</h1>
    <div class="form-group" style="margin-top: 25px">
        <label for="fullname" style="margin-bottom: 5px">Full name</label>
        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter fullname">
      </div>
    <div class="form-group">
      <label for="email" style="margin-bottom: 5px">Email address</label>
      <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="password" style="margin-bottom: 5px">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="confirmPassword" style="margin-bottom: 5px"> Confirm password</label>
        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"placeholder="Confirm Password">
      </div>

    <button type="submit" class="btn btn-primary">Register</button>
    @if($errors->any())
    <div class="alert alert-danger mt-4" role="alert" style="width: 320px">
        {{$errors->first()}}
    </div>
  
    @elseif(session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
    
    @endif   
</form>

  <div class="login-container" style="margin-left: 550px">
    <p>Already have an account?</p>
    <a href="/login"><button class="btn btn-outline-primary">Login</button></a>
  </div>
@endsection