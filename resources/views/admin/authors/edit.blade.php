
@extends('admin/layout')
@extends('admin/menu')

@section('menu')
ავტორების შექმნა



<form action="{{ route('admin.authors.update', ['id' => $author->id]) }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-group">

        <input type="text" name="author_ka" class="form-control" aria-describedby="emailHelp" placeholder="ავტორის სახელი" value="{{ $author->author_ka }}">

        <input type="text" name="author_en" class="form-control" aria-describedby="emailHelp" placeholder="Name of the author" value="{{ $author->author_en }}">



    </div>





  <br>
  <button type="submit" class="btn btn-primary">დამახსოვრება</button>
  </form>

@endsection
