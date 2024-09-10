@extends('admin/layout')
@extends('admin/menu')

@section('menu')





    <form action="{{ route('admin.user.user_register') }}" method="get" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Name">
        <br>
        <input type="email" name="email" placeholder="Email">
        <br>
        <input type="password" name="password" placeholder="Password">
        <button type="submit" class="btn btn-primary">მომხმარებლის შექმნა</button>

    </form>



@endsection

