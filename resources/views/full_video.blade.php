@extends('layout')

@section('tags')
<meta property="og:title" content="{{ $video->title_ka }}" />
     <meta property="og:image" content="{{ asset($video->upload) }}" />
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

     <div class="col-md-12">  <h3>  {{ $video->title_ka }} </h3>

    <br>

    <!-- ShareThis BEGIN --><div class="sharethis-inline-share-buttons"></div><!-- ShareThis END --> <br>
<br>
    </div>
     <br><br>





    <div class="col-md-12">


        <figure class="media ck-widget" contenteditable="false">
            <div class="ck-media__wrapper" data-oembed-url="{!! $video->description_ka !!}
                <div class="ck ck-reset_all ck-media__placeholder">
                    <div class="ck-media__placeholder__icon">
                        <svg class="ck ck-icon" ...>...</svg>
                    </div>



    </div>
</div>
</section>

@endsection
