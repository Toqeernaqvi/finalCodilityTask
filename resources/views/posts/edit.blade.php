@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Post</h2>
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

        <form action="{{ route('post.update' , $post->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                 <div class="col-sm-6">
                    <div class="form-group  ">
                        <strong>Title:</strong>
                        <input type="text" name="title" class="form-control" placeholder="Enter Title"
                            value="{{ $post->title }}">
                    </div>

                    <div class="form-group  ">
                        <strong>Description:</strong>

                        <textarea class="form-control" id="description" name="description" rows="3">
                            {{ $post->description}}
                        </textarea>


                    </div>





                </div>

                <div class="col-sm-6  pl-5">
                    <div class="col-md-12   pl-5">

                        <div class="col-md-12 mb-2 pl-5">
                            <img src="/storage/{{ $post->image }}" class="w-100  "  style="max-height: 250px;" alt="" id="preview-image-before-upload">
                            {{-- <img id="preview-image-before-upload"
                                src="https://www.riobeauty.co.uk/images/product_image_not_found.gif" alt="preview image"
                                style="max-height: 250px;">
                        </div> --}}
                        <div class="form-group pl-5">

                            <input type="file" name="image"  placeholder="Choose image" id="image">
                            @error('image')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center  ">
                    <button type="submit" class="btn btn-primary">Update</button>

                    <a class="btn btn-info" href="{{ route('post.index') }}"> Back</a>

                </div>
            </div>

        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
        integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>

    <script>
     

        $(document).ready(function(e) {


            $('#image').change(function() {
                console.log('ssasa');

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#preview-image-before-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });

            // 
            $('#category_id').on('change', function() {
                var categoryID = $(this).val();
                if (categoryID) {
                    $.ajax({
                        url: '/getSubCategory/' + categoryID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {

                                $('#subcategory_id').empty();
                                $('#subcategory_id').append(
                                    '<option hidden>Choose SubCategory</option>');
                                $.each(data, function(key, subcategories) {
                                    $('select[name="subcategory_id" ]').append(
                                        '<option value="' + subcategories.id +
                                        '">' + subcategories.name + '</option>');
                                });
                            } else {
                                $('#subcategory').empty();
                            }
                        }
                    });
                } else {
                    $('#subcategory').empty();
                }
            });
        })
    </script>


@endsection
