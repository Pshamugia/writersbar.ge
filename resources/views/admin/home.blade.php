Home page for ADMIN

@extends('admin/layout')
@yield('menu')
<form action="{{ route('admin.article.store') }}" method="post" enctype="multipart/form-data">
    @csrf
	<div class="form-group">
        <label>წიგნის სახელწოდება</label>
        <input type="text" name="title" class="form-control" aria-describedby="emailHelp" placeholder="წიგნის სახელწოდება">
    </div>
    <div class="form-group">
        <label>ავტორი</label>
        <select name="category_id"  class=  "form-control">
            @foreach($categories as $category)

            <option value="{{ $category->id }} "> {{ $category->title }} </option>

            @endforeach

        </select>
    </div>
    <div class="form-group">
        <label>გამომცემლობა</label>
        <select name="publisher_id" class="form-control">
        @foreach($articles as $publisher)

            <option value="{{ $publisher->id }} "> {{ $publisher->name }} </option>

            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>გამოშვების წელი</label>
        <input type="number" name="year" class="form-control" aria-describedby="emailHelp" placeholder="გამოშვების წელი">
    </div>



    <div class="form-group">
        <label>ყდა</label>
        <input type="file" name="cover" class="form-control" aria-describedby="emailHelp" placeholder="ყდა">
    </div>
  <br>
  <button type="submit" class="btn btn-primary">დამახსოვრება</button>
  </form>

