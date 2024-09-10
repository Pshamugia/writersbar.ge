@extends('admin/layout')
@section('menu')

<div> <a href="{{ route('admin.article') }}"> HOME PAGE </a> /





    <form action="{{ route('admin.category.index') }}" method="get" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>კატეგორიის დამატება</label>
            <input type="text" name="name" class="form-control" aria-describedby="emailHelp" placeholder="კატეგორიის სახელწოდება">
        </div>





      <br>
      <button type="submit" class="btn btn-primary">დამახსოვრება</button>
      </form>
    @endsection



