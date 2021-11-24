@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit SubCategory</h2>
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
  
    <form action="{{ route('subcategory.update',$subcategory->id) }}" method="POST">
        @csrf
        @method('PUT')


        <div  class="form-group mt-5 w-50">
            <label for="SubCategory">Select Category</label>
            <select id="category_id" name="category_id" class="form-control">
                @foreach ($category as $category)
                    <option value="{{ $subcategory->category->name }}">
                        <a class="dropdown-item" name="category_id"
                            href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a>
                    </option>
                @endforeach
            </select>
        </div>


   
         <div class="row w-50">
            <div class="col-xs-12 col-sm-12 col-md-12 w-50">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $subcategory->name }}" class="form-control" placeholder="Name"  >
                </div>
            </div>
          
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Update</button>
              <a class="btn btn-info" href="{{ route('subcategory.index') }}"> Back</a>

            </div>
        </div>
   
    </form>
</div>
@endsection
