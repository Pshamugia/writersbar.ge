@extends('layout')

@section('tags')
<meta property="og:title" content="{{ $gallery->title }}" />
@foreach ($images as $image)
    <meta property="og:image" content="{{ asset($image->upload) }}" />
    @endforeach

   <meta property='og:url' content="{{ request()->url() }}?fb_lang={{ app()->getLocale() }}" />
@endsection


@section('menu')
<style>
    #header.header-transparent {
    background: rgba(42, 44, 57, 0.9) !important;
}

.cta {
    margin-top: -60px !important;
    padding: 0px !important;
    height: 1px !important;
}
    </style>
<section id="menu" class="about">
    <div class="container">
<div class="row">

     <div class="col-md-12">  <h3>  {{ $gallery->title }} </h3>

    <br>

    <!-- ShareThis BEGIN --><div class="sharethis-inline-share-buttons"></div><!-- ShareThis END --> <br>
<br>
    </div>
     <br><br>




@foreach ($images as $image)






    <div class="col-md-4">

        <div class="" id="im124"><a href="{{ asset($image->upload) }}" data-lightbox="photos"><img class="cover124" id="im124" src="{{ asset($image->upload) }}"></a></div>

    </div>



        @endforeach

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>



    </div>
</div>
</section>

@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
     <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
