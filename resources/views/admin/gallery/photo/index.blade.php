@extends('admin/layout')
@extends('admin/menu')

@section('menu')

<div style="position: relative; display: inline-block; margin-right:30px;">
    <label class="alert alert-warning">
        <a href="{{ route('admin.gallery.photo.add')}}"> <i class="fas fa-chart-area"></i> ახალი ფოტო გალერეის შექმნა </a>
    </label>
    </div>




<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">სათაური</ th>
         <th scope="col">სურათი</th>
        <th scope="col">EDIT</th>
        <th scope="col">DELETE</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($gallery as $article )
       <tr>
        <th scope="row">
             {{ $loop->index+1 }}

         </th>
        <td> {{ $article->title }}</td>


        <td> <img src="{{ asset($article->upload1) }}" id="im123" class="cover123"> </td>
            <td> <a href="{{ Route('admin.gallery.photo.edit', ['id' => $article->id]) }}"> ჩასწორება </a>
            </td>
            <td> <a href="{{ Route('admin.gallery.photo.delete', ['id'=>$article->id])}}" onclick="return confirm('Are you sure?')">
                <button type="button" class="btn btn-danger">წაშლა</button> </a>
            </td>
      </tr>

@endforeach
    </tbody>
  </table>

  {{ $gallery->links() }}

@endsection

