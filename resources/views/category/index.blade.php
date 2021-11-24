@extends('layouts.app')
@section('content')
<div class="container">
<div class="row mt-5">
    <div class="col-sm-9 margin-tb">
        <div class="pull-left">
            <h2>Categories</h2>
            
        </div>
      
    </div>

    <div class="col-sm-3">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('category.create') }}"> Add <i class="fas fa-plus"></i></a>
        </div>
    </div>
</div>



<table class="table table-bordered mt-5">
    <tr>
        <th>No</th>
        <th>Name</th>
     
        <th width="280px">Action</th>
    </tr>
    @foreach ($categories as $category)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $category->name }}</td>
         <td>
            <form action="{{ route('category.destroy',$category->id) }}" method="POST">

                <a class="btn btn-info" href="{{ route('category.show',$category->id) }}">Show</a>

                <a class="btn btn-primary" href="{{ route('category.edit',$category->id) }}">Edit</a>

                @csrf
                @method('DELETE')
  
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $categories->links() !!}
</div>
@endsection