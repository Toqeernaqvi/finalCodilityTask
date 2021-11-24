@extends('layouts.app')
@section('content')
<div class="container">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New SubCategory</h2>
        </div>
     
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('subcategory.store') }}" method="POST">
    @csrf
  
     <div class="row">


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group mt-5 w-50">
                <label for="inputState">Select Category</label>
                <select id="category_id" name="category_id" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            <a class="dropdown-item" name="category_id"
                                href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a>
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group  w-50">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>
     
        <div class="col-xs-12 col-sm-12 col-md-12 text-center  w-50">
                <button type="submit" class="btn btn-primary">Submit</button>
          
                    <a class="btn btn-info" href="{{ route('category.index') }}"> Back</a>
                 
        </div>
    </div>
   
</form>
</div>
@endsection

