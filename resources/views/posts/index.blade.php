@extends('layouts.app')
@section('content')
<div class="container">
<div class="row mt-5">
    <div class="col-sm-9 margin-tb">
        <div class="pull-left">
            <h2>Posts</h2>
            
        </div>
      
    </div>

    <div class="col-sm-3">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('post.create') }}"> Add <i class="fas fa-plus"></i></a>
        </div>
    </div>


     

</div>



<table class="table table-bordered mt-5">
    <tr>
        <th>No</th>
        <th>Title</th>
        <th>Description</th>
        <th>Image</th>

        {{-- <th>Image</th> --}}


        <th width="280px">Action</th>
    </tr>
    @foreach ($post as $post)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $post->title }}</td>
        <td>{{ $post->description }}</td>
        <td> <img src="/storage/{{ $post->image }}" class="w-100  " style="max-width: 150px" alt=""></td>

         <td>
            <form action="{{ route('post.destroy',$post->id) }}" method="POST">

                <a class="btn btn-info" href="{{ route('post.show',$post->id) }}">Show</a>

                <a class="btn btn-primary" href="{{ route('post.edit',$post->id) }}">Edit</a>

                @csrf
                @method('DELETE')
  
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{{-- {!! $posts->links() !!} --}}
</div>
@endsection
 