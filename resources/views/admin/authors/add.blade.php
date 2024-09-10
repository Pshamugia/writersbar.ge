
@extends('admin/layout')
@extends('admin/menu')

@section('menu')
ავტორების შექმნა



<form action="{{ route('admin.authors.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label class="alert alert-warning">  ავტორის დამატება</label>

        <input type="text" name="author_ka" class="form-control" aria-describedby="emailHelp" placeholder="ავტორის სახელი">

        <input type="text" name="author_en" class="form-control" aria-describedby="emailHelp" placeholder="Name of the author">



    </div>





  <br>
  <button type="submit" class="btn btn-primary">დამახსოვრება</button>
  </form>

@endsection
