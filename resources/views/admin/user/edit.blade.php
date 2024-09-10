@extends('admin/layout')
@extends('admin/menu')

@section('menu')






    <form action="{{ route('admin.user.update', $edit->id) }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>კატეგორიის დამატება</label>
            <input type="text" name="name" value="{{$edit->name}}" class="form-control" aria-describedby="emailHelp" placeholder="name">
            <input type="text" name="email" value="{{$edit->email}}" class="form-control" aria-describedby="emailHelp" placeholder="email">
            <input type="text" name="password" value="{{$edit->password}}" class="form-control" aria-describedby="emailHelp" placeholder="password">
        </div>
      <br>
      <button type="submit" class="btn btn-primary">დამახსოვრება</button>
      </form>
    @endsection



