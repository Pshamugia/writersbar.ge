@extends('layout')


@section('tags')
    @if (!empty($full->authors))
        <meta property="og:title" content="{{ $full->authors->author_name() }} | {{ $full->title() }}" />
    @else
        <meta property="og:title" content="{{ $full->title() }}" />
    @endif


    <meta property="og:description" content="{{ $full->descriptions() }}" />
    <meta property="og:image" content="{{ asset($full->upload) }}" />
    <meta property='og:url' content="{{ request()->url() }}?fb_lang={{ app()->getLocale() }}" />
@endsection

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

        #fontera
        {
            border:0px;
            background-color: #eee;

        }
        #fontera:hover
        {
background-color: #caccce;
transition: all .4s ease;
-webkit-transition: all .4s ease;

            }

    </style>
    <section>
        <div class="container">

            <img src="{{ asset($full->upload) }}" onclick="onClick(this)" class="cover007" id="im007" align="left" style="margin-top: -23px">
            <div id="modal01" class="w3-modal" onclick="this.style.display='none'">
                <span class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span>
                <div class="w3-modal-content w3-animate-zoom" style="background-color: transparent">
                    <img id="img01">
                </div>
                @if (!empty($full->img_description))
                    <div align="left" class="w3-modal-content w3-animate-zoom"
                        style="width: 300px; position: relative; top: -25px;">
                        <span style="position: relative; padding: 10px 10px 10px 10px;"> {{ $full->img_description }}</span>
                    </div>
                @endif
            </div>
            <script>
                function onClick(element) {
                    document.getElementById("img01").src = element.src;
                    document.getElementById("modal01").style.display = "block";
                }
            </script>
            <div class="col-md-8" style="margin: 0 auto;">
                <h3> {{ $full->title() }} </h3>


                @if (!empty($full->authors))
                    <a
                        href="{{ route('fullAuthor', ['id' => $full->author_id, 'author_ka' => Str::slug($full->authors->author_name())]) }}">
                        {{ @$full->authors->author_name() }} </a> /
                @endif

                {{ $full->category->name() }} /


                @foreach ($event as $events)
                    @if (app()->isLocale('ka'))
                    <?php setlocale(LC_TIME, 'ka_GE.utf8'); ?>
                    {{ Carbon\Carbon::parse($events->year)->formatLocalized('%A, %d %B, %Y') }}

                    @else

                    <?php setlocale(LC_ALL, 'US'); ?>

                    {{ Carbon\Carbon::parse($events->year)->formatLocalized('%A, %d %B, %Y') }}
                    @endif
                @endforeach
                /
                <i class="fa-regular fa-eye"></i>
                {{ $full->view_count }}

                <br><br>




                <!-- ShareThis BEGIN -->
                <div class="sharethis-inline-share-buttons" style="display:inline-block"
                    data-url="{{ request()->url() }}?fb_lang={{ Illuminate\Support\Facades\Session::get('locale') }}">
                </div><!-- ShareThis END -->

                <div style="display:inline-block; position: relative; top:8px;">
                <button onclick="increaseFontSize()" id="fontera" style="width: 40px; height: 40px; line-height: 40px; margin-right: 8px; padding: 0 10px; border-radius: 4px;">
                    <i class="fas fa-plus"></i>
                </button>
                <button onclick="decreaseFontSize()" id="fontera" style="width: 40px; height: 40px; line-height: 40px; margin-right: 8px; padding: 0 10px; border-radius: 4px;">
                    <i class="fas fa-minus"></i>
                </button>
             </div> <br><br>



            </div>
            <div class="col-md-8" id="content" style="margin: 0 auto;">
                {!! $full->full() !!} <br>
                <script>
                    var intervalId;
                    var step = 1;
                    var delay = 70; // Delay in milliseconds (adjust as needed)
                    var minSize = 10; // Minimum font size
                    var maxSize = 30; // Maximum font size

                    function increaseFontSize() {
                      clearInterval(intervalId); // Clear any previous interval
                      var content = document.getElementById("content");
                      var style = window.getComputedStyle(content, null).getPropertyValue('font-size');
                      var currentSize = parseFloat(style);
                      targetSize = currentSize + 2;

                      intervalId = setInterval(function () {
                        if (currentSize < targetSize && currentSize < maxSize) {
                          currentSize += step;
                          content.style.fontSize = currentSize + 'px';
                        } else {
                          clearInterval(intervalId); // Stop the interval when target size is reached or maximum size is reached
                        }
                      }, delay);
                    }

                    function decreaseFontSize() {
                      clearInterval(intervalId); // Clear any previous interval
                      var content = document.getElementById("content");
                      var style = window.getComputedStyle(content, null).getPropertyValue('font-size');
                      var currentSize = parseFloat(style);
                      targetSize = currentSize - 2;

                      intervalId = setInterval(function () {
                        if (currentSize > targetSize && currentSize > minSize) {
                          currentSize -= step;
                          content.style.fontSize = currentSize + 'px';
                        } else {
                          clearInterval(intervalId); // Stop the interval when target size is reached or minimum size is reached
                        }
                      }, delay);
                    }
                  </script>            </div>


                <style>
                    #tags,
                    #tags ul {
                      list-style-type: none;
                      list-style-position: outside;
                      width: auto;
                       margin: 0;
                      font-family: bpg_algeti_compact;
                      src: url({{ asset('FONTS/bpg_algeti_compact.ttf')}});
                    }

                    #tags a {
                      display: block;
                      color: #5F5F5F;
                      background-color: #eee;
                      text-decoration: none;
                      width: auto;
                      border-radius:4px;
                      transition: color 0.5s, background 0.5s;
                      -webkit-transition: color 0.5s, background 0.5s;

                    }

                    #tags a:hover {
                      background: #caccce;
                      color: #000000;
                      width: auto;
                       transition: color 0.5s, background 0.5s;
                      -webkit-transition: color 0.5s, background 0.5s;


                    }

                    #tags li {
                      float: left;
                      position: relative;


                    }

                    #tags ul {
                      position: absolute;
                      display: none;



                    }

                    #tags li ul a {

                      float: left;



                    }

                    #tags ul ul {}

                    #tags li ul ul {
                      left: 12em;


                    }

                    #tags li:hover ul ul,
                    #tags li:hover ul ul ul,
                    #tags li:hover ul ul ul ul {
                      display: none;

                    }

                    #tags li:hover ul,
                    #tags li li:hover ul,
                    #tags li li li:hover ul,
                    #tags li li li li:hover ul {
                      display: block;

                      border: dashed 1px #999;
                      -moz-box-shadow: 5px 5px 8px #D6C89A;
                      -webkit-box-shadow: 5px 5px 8px #D6C89A;
                      box-shadow: 5px 5px 8px #D6C89A;
                    }
                  </style>
            <div class="col-md-8" style="margin: 0 auto;">
                @if (app()->isLocale('ka'))
                  @foreach (explode(',', $full->tags_ka) as $tag)
                    @if (!empty($tag))
                      <div id="tags" style="float:left; padding-top: 0px; padding-right: 7px;">
                        <a href="{{ route('search', ['text'=>$tag])}}" style="padding:10px; position:relative; font-size:14px; ">
              {{ $tag }} </a>

                      </div>
                    @endif
                 @endforeach
                 @else

                 @foreach (explode(',', $full->tags_en) as $tag)
                    @if (!empty($tag))
                      <div id="tags" style="float:left; padding-top: 0px; padding-right: 7px;">
                        <a href="{{ route('search', ['text'=>$tag])}}" style="padding:10px; position:relative; font-size:14px; ">
              {{ $tag }} </a>

                      </div>

                    @endif
                 @endforeach

                 @endif




            @section('related')

                    @foreach ($related2 as $item)
                    <div style="padding-top: 25px; clear:both;">

                        @if (!empty($item->title()))
                            <div style="padding:10px; background-color:#eee; color:rgb(14, 13, 13); border-radius: 3px">
                                <i class="fa-regular fa-compass"></i>

                                <strong style="margin-left: 22px;"> {{ Lang::get('lang.related') }} </strong>
                        @endif
                    @endforeach
                </div>

                    <div style="position: relative; margin-top: 0px">
                        <style>
                            a {
                                color: #000000;
                                text-decoration: none;
                            }

                            a:hover {
                                color: #000000;
                                text-decoration: none;
                            }

                            .hoverDiv {
                                background: #fff;
                                padding: 10px;
                                border-bottom: 1px solid #eee
                            }

                            .hoverDiv:hover {
                                background: #eee;
                                padding: 10px;
                            }
                        </style>
                        

                    </div>

                </div>

            @show


        </div>
    </div>
</section>
@endsection
