@extends('layout')


@section('menu')

<section id="menu" class="about">
    <div class="container">


<img src="{{ asset($menu->upload) }}" align="left">
{{ $menu->satauri_ka }} <br>
<div style="font-size: 12px"> {{ $menu->created_at }} </div>    </div></section>

@endsection
