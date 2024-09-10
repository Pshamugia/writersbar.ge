@extends('admin/layout')
@extends('admin/menu')

@section('menu')


<script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>

    <form action="{{ route('admin.gallery.video.update', ['id'=>$video->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
         <div class="form-group">
            <label>სათაური</label>
            <input type="text" name="title_ka" value="{{ $video->title_ka }}" class="form-control" aria-describedby="emailHelp" placeholder="სათაური">
        </div>



        <div class="form-group">
            <label>გამოქვეყნების თარიღი</label>
            <input type="date" name="created_at" value="{{ Carbon\Carbon::parse($video->created_at)->format('Y-m-d') }}" class="form-control" aria-describedby="emailHelp"
                placeholder="გამოშვების წელი">
        </div>


        <div class="form-group">
            <label>saTavo სურათი</label>
            <img src="{{ asset($video->upload) }}" width="60px"><br>
            <input type="file" name="upload" value="{{ $video->upload }}" class="form-control" aria-describedby="emailHelp">
        </div>


        <div class="form-group">
            <label>ვიდეოს აღწერა</label>
            <textarea name="description_ka" value="{{ $video->description_ka }}" id="new_editor" height="300px" style="height:200px" placeholder="Full KA">{{ $video->description_ka }}</textarea>
            <script>
                ClassicEditor
                    .create( document.querySelector( '#new_editor' ),{
                            mediaEmbed: {
                                previewsInData:true
                            },
                        }
                     )
                    .catch( error => {
                        console.error( error );
                    } );
            </script>
        </div>






        <br>
        <button type="submit" class="btn btn-primary">დამახსოვრება</button>
    </form>
@endsection
