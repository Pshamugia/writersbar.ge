@extends('admin/layout')
@extends('admin/menu')

@section('menu')






    <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label class="alert alert-warning">  კატეგორიის დამატება</label>

            <input type="text" name="name_ka" class="form-control" aria-describedby="emailHelp" placeholder="კატეგორიის სახელწოდება">

            <input type="text" name="name_en" class="form-control" aria-describedby="emailHelp" placeholder="კატეგორიის სახელწოდება">

            <label>დამალვა მენიუს ზოლიდან </label>

            <input type="checkbox" name="check" value="1">

        </div>





      <br>
      <button type="submit" class="btn btn-primary">დამახსოვრება</button>
      </form>
    @endsection



