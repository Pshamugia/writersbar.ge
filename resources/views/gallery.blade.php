@extends('layout')
@section('menu')
<style>
    #header.header-transparent {
        background: rgba(42, 44, 57, 0.9);
    }

    .cta {
        margin-top: -60px !important;
        padding: 0px !important;
        height: 1px !important;
    }

    /* New CSS */
    .gallery-image {
        background-size: cover;
        background-position: center;
        height: 240px;
    }
</style>
<div class="container">
    <br><br>
    <div> <h3> <b> Photo Gallery </b> </h3> </div>

    <div class="row" style="padding-bottom: 25px; padding-top: 25px;">
        @foreach ($gallery as $events )
            <div class="col-md-4" onclick="window.location='{{ route('full_gallery', ['title'=>Str::slug($events->title), 'id'=>$events->id]) }}'" style="display:inline-block; cursor: pointer;">
                <div class="gallery-image" style="padding: 44px; margin-bottom: 44px; margin-right: 27px; border: 1px solid rgb(139, 139, 139); background-image: url({{ asset($events->upload1)}})">
                    <div style="background-color: rgba(15, 15, 15, 0.829); height: auto; padding: 15px;">
                        <a href="{{ route('full_gallery', ['title'=>Str::slug($events->title), 'id'=>$events->id]) }}">
                            {{ $events->title }}
                        </a>
                        <br>
                        <span style="color: white"> {{ Carbon\Carbon::parse($events->year)->format('M d, Y ').'Year' }} </span>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $gallery->links() }}
    </div>
</div>
@endsection
