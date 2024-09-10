@extends('admin/layout')
@extends('admin/menu')

@section('menu')

<div>

  <div> <label class="alert alert-warning">  <a href="{{ route('add.quizz') }}" class="btn btn-success">ქვიზის დამატება</a> </label>

</div>

<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">სურათი</th>
        <th scope="col">სათაური KA</th>
        <th scope="col">სათაური EN</th>
        <th scope="col">რედაქტირება</th>
        <th scope="col">Hide</th>
        <th scope="col">წაშლა</th>
       </tr>
    </thead>
    <tbody>

@foreach ($quizz_view as $quizz)

      <tr>
        <th scope="row"> {{ $loop->index+1 }} </th>
     <th scope="row"> <img src="{{ asset($quizz->upload) }}" width="50px" height="50px"> </th>
        <th scope="row"> {{ $quizz->mainTitle_ka }} </th>
        <th scope="row"> {{ $quizz->mainTitle_en }} </th>
        <td><a class="btn btn-warning" href="{{ route('quizz.edit', ['id' => $quizz->id]) }}">EDIT</a>
        </td>
        <td>

            @if (!empty($quizz->hidden))
          <a href="{{ route('admin.quizz', ['id'=>$quizz->id]) }}&show={{ $quizz->id }}"> <i class="fas fa-eye-slash"></i> </a>
          @else <a href="{{ route('admin.quizz', ['id'=>$quizz->id]) }}&hide={{ $quizz->id }}"><i class="fas fa-eye"></i> </a>
          @endif  </td>
        <td><a onclick="return confirm('ნამდვილად გსურთ წაშლა?');" class="btn btn-danger" href="{{ Route('quizz.delete', ['id'=>$quizz->id]) }}">Delete</a>
        </td>
      </tr>
      @endforeach
     </tbody>
  </table>


@endsection

