@extends('admin/layout')
@extends('admin/menu')

@section('menu')

<div> <a href="{{ route('admin.article') }}"> HOME PAGE </a> /





    <form action="{{ route('admin.category.update', $cat->id) }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>კატეგორიის დამატება</label>
            <input type="text" name="name_ka" value="{{$cat->name_ka}}" class="form-control" aria-describedby="emailHelp" placeholder="კატეგორიის სახელწოდება">
            <input type="text" name="name_en" value="{{$cat->name_en}}" class="form-control" aria-describedby="emailHelp" placeholder="Category title">


            <label>დამალვა მენიუს ზოლიდან </label>
            <input type="checkbox" name="check" {{ $cat->check =='1' ? 'checked' : '' }} value="1">

        </div>





      <br>
      <button type="submit" class="btn btn-primary">დამახსოვრება</button>
      </form>
    @endsection



