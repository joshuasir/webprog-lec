
@extends('layout.shared')
@section('title','Update Item')
@section('style')
<link rel="stylesheet" href="{{ asset('/css/addItem.css') }}"/>
@endsection

@section('content')
<div class="container" style="padding-top:10em">
  <h1>Update Item</h1>
@if(Session::get('user')['role'] === 'admin')
<form action="/updateItem/{{$product->id}}" method="post" class="item-form" enctype="multipart/form-data">
  @method('put')
  @csrf
  <div class="row mb-4">
    <div class="col">
      <div class="form-outline d-flex flex-column">
        <label class="form-label" for="id">Item ID</label>

        <input class="form-control" type="text" id="name" name="id" value="{{$product->id}}" readonly>
        
      </div>
    </div>
  </div>
  <div class="row mb-4">
    
    <div class="col">
      <div class="form-outline d-flex flex-column">
        <label class="form-label" for="name">Item Name</label>
        <input class="form-control" type="text" id="name" name="name" value=" {{old('name', $product->name)}}">
        @error('name')
        <p class="text-danger">
         {{$message}}
       </p>   
       @enderror
      </div>
    </div>
    <div class="col">
      <div class="form-outline d-flex flex-column">
        <label class="form-label" for="price">Price (IDR)</label>
      <input class="form-control" type="text" id="price" name="price" value="{{old('price', $product->price)}}" >
      @error('price')
      <p class="text-danger">
       {{$message}}
     </p>   
     @enderror
      </div>
    </div>
  </div>
  <div class="row mb-4">
    
    <div class="col w-100">
      <div class="form-outline d-flex flex-column">
        <label class="form-label" for="desc" >Description</label>
        <textarea class="form-control" name="description" id="desc" value="{{old('description', $product->description) }}">{{old('description', $product->description) }}</textarea>
          @error('description')
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
        <label class="form-label" for="category">Category</label>
        <select class="form-control" name="category" id="category">
          <optgroup label="Choose category">
          <option value="select">Select a category</option>
          <option value="Food"
          @if(old('category', $product->category) === 'Food') 
          selected="selected"
          @endif
          >Food</option>
          <option value="Beverage"
          @if(old('category', $product->category)  === 'Beverage') 
          selected="selected"
          @endif
          >Beverage</option>
          <option value="Dessert"
          @if(old('category', $product->category)  === 'Dessert') 
          selected="selected"
          @endif
          >Dessert</option>
        </select>
        @error('category')
        <p class="text-danger">
         {{$message}}
       </p>   
       @enderror
      </div>
    </div>
    <div class="col">
      <div class="form-outline d-flex flex-column">
        <div class="update-image mb-2">
          <label class="form-label" for="image">Update Image</label>
          <input type="file" class="form-control" name="image" id="image">
        </div>
        @error('image')
          <p class="text-danger">
          {{$message}}
          </p>   
        @enderror
        <div class="update-image">
          <label class="form-label" for="">Old Image File</label>
          <input class="form-control" type="text" value="{{$product->image}}" readonly>
        
  
        </div>
        <div class="preview d-flex flex-column align-items-start">
          <label class="form-label" for="">Preview</label>
          @if (Storage::disk('public')->exists($product->image))
            <img id="preview-image" src="{{Storage::url($product->image)}}" 
            alt="preview image" style="max-height: 120px">
          @else
            <img id="preview-image" src="{{$product->image}}" 
            alt="preview image" style="max-height: 120px">
          @endif
        </div>
      </div>
    </div>
  </div>




 


  <button type="submit" class="btn btn-primary">Update Item</button>
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