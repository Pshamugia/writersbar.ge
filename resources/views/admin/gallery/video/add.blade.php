@extends('admin/layout')
@extends('admin/menu')

@section('menu')

<script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>

    <form action="{{ route('admin.gallery.video.store') }}" method="post" enctype="multipart/form-data">
        @csrf
         <div class="form-group">
            <label>სათაური</label>
            <input type="text" name="title_ka" class="form-control" aria-describedby="emailHelp" placeholder="სათაური">
        </div>

        <div class="form-group">
            <label>ვიდეოს ქავერ სურათი</label>
            <input type="file" name="upload" class="form-control" aria-describedby="emailHelp" placeholder="ყდა">
        </div>

        <div class="form-group">
            <label>გამოქვეყნების თარიღი</label>
            <input type="date" name="created_at" class="form-control" aria-describedby="emailHelp"
                placeholder="გამოშვების წელი">
        </div>

        <div class="form-group">
            <label>ვიდეოს აღწერა</label>
            <textarea name="description_ka" id="new_editor" height="300px" style="height:200px" placeholder="Full KA"></textarea>
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



        <button type="submit" class="btn btn-primary">დამახსოვრება</button>
    </form>
@endsection
