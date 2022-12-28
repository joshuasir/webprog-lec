@extends('layout.shared')
@section('title','Add Item')
@section('style')
<link rel="stylesheet" href="{{ asset('/css/addItem.css') }}"/>
@endsection

@section('content')
<div class="container" style="padding-top:10em">
  <h1>Add Item</h1>
@if(Session::get('user')['role'] === 'admin')

<form action="/addItem" method="post" class="item-form" enctype="multipart/form-data">
  @csrf

    
  <div class="row mb-4">
    <div class="col">
      <div class="form-outline d-flex flex-column">
        <label class="form-label" for="id">Item ID</label>
      <input type="text" id="id" name="id" value="{{old('id')}}"  class="form-control" >
      @error('id')
      <p class="text-danger">
       {{$message}}
     </p>   
     @enderror
      </div>
    </div>
    <div class="col">
      <div class="form-outline d-flex flex-column">
        <label class="form-label" for="name">Item Name</label>

        <input class="form-control" type="text" id="name" name="name" value="{{old('name')}}">
        @error('name')
          <p class="text-danger">
          {{$message}}
          </p>   
        @enderror
      </div>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col">
      <div class="form-outline d-flex flex-column">

          <label class="form-label" for="price">Price (IDR)</label>
          <input class="form-control" type="text" id="price" name="price" value="{{old('price')}}" >
          @error('price')
          <p class="text-danger">
           {{$message}}
         </p>   
         @enderror
        
      </div>
    </div>
    <div class="col">
      <div class="form-outline d-flex flex-column">

          <label class="form-label" for="category">Category</label>
          <select class="form-control" name="category" id="category">
            <optgroup label="Choose category">
            <option value="select">Select a category</option>
            <option value="Food">Food</option>
            <option value="Beverage">Beverage</option>
            <option value="Dessert">Dessert</option>
          </select>
          @error('category')
          <p class="text-danger">
           {{$message}}
         </p>   
         @enderror
  
      </div>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col">
      <div class="form-outline d-flex flex-column">

        <label class="form-label" for="image">Add Image</label>
        <input class="form-control"type="file" class="form-control" name="image" id="image" >
        @error('image')
         <p class="text-danger">
          {{$message}}
        </p>   
        @enderror
        
      </div>
      <div class="preview d-flex flex-column align-items-start">
        <label for="preview-image">Preview Image</label>
        <img id="preview-image" name="preview-image" src="http://flxtable.com/wp-content/plugins/pl-platform/engine/ui/images/image-preview.png" 
        alt="preview image" style="max-height: 120px">
      </div>
    </div>
    <div class="col">
      <div class="form-outline d-flex flex-column">

        <label class="form-label"for="desc" >Description</label>
        <textarea class="form-control" name="description" id="desc" value="{{old('description')}}"></textarea>
        @error('description')
        <p class="text-danger">
        {{$message}}
        </p>   
      @enderror
  
      </div>
    </div>
  </div>

  <button type="submit" class="btn btn-primary" >Add Item</button>
</form>


{{-- Script for image preview --}}
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
  $(document).ready(function (e) {
     $('#image').change(function(){
      const reader = new FileReader();
      reader.onload = (e) => { 
        $('#preview-image').attr('src', e.target.result); 
      }
      reader.readAsDataURL(this.files[0]); 
     });
  });
  </script>

@else
<div class="container">
  <h2 class="text-center mt-4 mb-3">Access Denied</h2>
  <p class="text-center">Please login as admin to access this page</p>
  <a href="/login"><p  class="text-center">if you are an admin, login here 👈</p> </a>
</div>

@endif
</div>

@endsection