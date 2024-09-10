
@extends('admin/layout')
@extends('admin/menu')

@section('menu')

<div> <label class="alert alert-warning">  <a href="{{ route('admin.authors.add') }}" class="btn btn-success">ავტორის დამატება</a> </label>

<table>

    <tr>

        <td valign="top" style="background-color: #ECECEC">
         <div style="position: relative; padding: 15px;">
       <b> ავტორი</b>

    <form action="{{ route('admin.authors.delete') }}" method="post">
@csrf

             <input type="hidden" name="edit_id" value="">
   <br /> <br>
   <select name="authors_id" id="authors_id" style="width:320px; height:35px;">
   <option value="0" disabled selected hidden>მონიშნე ავტორი </option>


@foreach ($authors as $author)

<option value="{{ $author->id }}"> {{ $author->author_ka }} </option>

@endforeach

    </select>

   <input type="submit" name="delete_btn" value="წაშლა" onclick="return confirm('დარწმუნებული ხარ, რომ გინდა წაშლა?')" style="height:35px; width:85px;" />

<input type="submit" value="EDIT" style="height:35px; width:75px;" name="edit_btn"/>



   </form><br>

    </td>

        <tr>

        </tr></table>






          @endsection
