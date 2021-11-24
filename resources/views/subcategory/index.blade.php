@extends('layouts.app')
@section('content')
<div class="container">
<div class="row mt-5">
    <div class="col-sm-9 margin-tb">
        <div class="pull-left">
            <h2>Sub Categories</h2>
            
        </div>
      
    </div>

    <div class="col-sm-3">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('subcategory.create') }}"> Add <i class="fas fa-plus"></i></a>
        </div>
    </div>


     

</div>



<table class="table table-bordered mt-5">
    <tr>
        <th>No</th>
        <th>Name</th>
     
        <th width="280px">Action</th>
    </tr>
    @foreach ($subcategories as $subcategory)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $subcategory->name }}</td>
         <td>
            <form action="{{ route('subcategory.destroy',$subcategory->id) }}" method="POST">

                <a class="btn btn-info" href="{{ route('subcategory.show',$subcategory->id) }}">Show</a>

                <a class="btn btn-primary" href="{{ route('subcategory.edit',$subcategory->id) }}">Edit</a>

                @csrf
                @method('DELETE')
  
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $subcategories->links() !!}
</div>
@endsection
 