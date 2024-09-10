@extends('admin/layout')
@extends('admin/menu')

@section('menu')




<label class="alert alert-warning"> <a href="{{ route('admin.user.user_view') }}"> ახალი მომხმარებლის დარეგისტრირება </a> </label>
    <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">მომხმარებლის სახელი</th>
            <th scope="col">ელფოსტა</th>
            <th scope="col">პაროლი</th>
            <th scope="col">რედაქტირება</th>
            <th scope="col">წაშლა</th>
           </tr>
        </thead>
        <tbody>
            @foreach ($user as $users)


          <tr>
            <th scope="row" style="font-weight: 100"> {{ $users->name}}</th>
            <th scope="row" style="font-weight: 100"> {{ $users->email}}</th>
            <th scope="row" style="font-weight: 100"> {{ $users->password}}</th>


            <td><a class="btn btn-warning" href="{{ route('edit.user', $users->id) }}">EDIT</a>
            </td>
            <td><a onclick="return confirm('ნამდვილად გსურთ წაშლა?')" class="btn btn-danger" href="{{ route('admin.user.user_delete', $users->id) }}">Delete</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>


@endsection

