<header id="header" class="fixed-top d-flex align-items-center  header-transparent ">
    <style>
        @font-face {
            font-family: 'CustomFont';
            src: url('/fonts/bpg_boxo-boxo.ttf');
        }
    </style>
    <div class="container d-flex align-items-center justify-content-between">

        <div class="logo">
            <a href="{{ route('welcome') }}">
                <img src="{{ asset('uploads/logo.png') }}" alt="" class="img-fluid">
            </a>
        </div>
        <style>
            @font-face {
                font-family: 'CustomFont';
                src: url('fonts/bpg_boxo-boxo.ttf');
            }
        </style>

        <nav id="navbar" class="navbar">
            <ul>
                <li
                    style="font-family: 'CustomFont' !important;
                src: url('/public/fonts/bpg_boxo-boxo.ttf'); color:white !important">
                    <a class="nav-link scrollto {{ request()->is('/*') ? 'active' : '' }}"
                        href="{{ route('welcome') }}">{{ Lang::get('lang.home') }}</a></li>



                @foreach ($mainmenu as $item)
                    @if (count($item['children']) > 0)
                        @include('../menu/multiitem', ['multi' => $item])
                    @else
                        @include('../menu/singleitem', ['single' => $item])
                    @endif
                @endforeach





                @auth
                    @if (Auth::check() && Auth::user()->type != 0)
                        <li class="dropdown">
                            <a href="#">
                                @if (Auth::user()->profile_photo)
                                    <div>
                                        <img src="{{ Auth::user()->profile_photo }}" alt="Profile Photo" width="25px"
                                            style="  border-radius: 50%; margin-right: 5px;">
                                    </div>
                                @endif <span>{{ implode('.', array_map(fn($word) => strtoupper($word[0]), explode(' ', Auth::user()->name))) }}.
                                </span>

                            </a>
                            <ul>
                                <li><a href="{{ route('booking.room') }}">Go to your account</a></li>
                                <li><a href="{{ route('booking.logout') }}">LOG OUT</a></li>
                            </ul>
                        </li>
                    @endif
                @endauth



            </ul>

            <div style="display: inline-block;">

                @php
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
@endphp


<style>
    {
    margin: 0;
    padding: 0;

}


.hide-icon {
    display: none;
  }

.searchBox1.hide-search i {
    display: none;
  }

.searchBox1 {
    position: absolute;
    top: 10%;
    left: 40%;
    background-color: #fff
    transform: translate(-50%,-50%);
    display: flex;
    justify-content: center;
    align-items: center;
}

.searchBox1 input{
    background-color: rgb(255, 255, 255);
    border: none;
    outline: none;
    width: 0;
    padding: 0;
    opacity: 0;
    border-radius: 40px;
    line-height: 10px;
    font-size: 12px;
    color: #000000;
    transition: all 1s;
}

.searchBox1 input::placeholder {
    color: rgba(255,255,255,.5);
    font-weight: 400;
    color:#000000;
}

.searchBox1 i {
    background-color: rgb(255, 255, 255);
    width: 25px;
    height: 25px;
    padding: 3px 3px;
    border-radius: 50%;
    text-align: center;
    margin-left:11px;
    line-height: 20px;
    font-size: 14px;
    cursor: pointer;
    transition: all .5s;
}

.searchBox1:hover input{
    width: 130px;
    opacity: 1;
    padding: 10px 20px;
    margin-left: -40px;
    margin-top: -7px;
}

.searchBox1:hover i{
    background-color: transparent;
    color:transparent;
}

</style>
@if (strpos($userAgent, 'Mobile') !== false)
<form id="search-me2" action="{{ route('search') }}" method="_GET">

 <div class="searchBox1">
        <input type="search" name="text" placeholder="{{ Lang::get('lang.search') }}">
        <i class="fa fa-search"></i>
    </div>
</form>
@endif


<script>
    function toggleSearchIcon() {
      var searchIcon = document.querySelector('.searchBox1 i');
      searchIcon.classList.toggle('hide-icon');
    }
  </script>


            </div>

            <div style="display: inline-block; padding-right: 55px; left: -10px;">
                @if (app()->isLocale('ka'))
                    <a href="?lang=en" {{ cookie('language') == 'en' }}>
                        <img src="{{ asset('img/flag_eng.png') }}" width="20px" class="reverse">
                    </a>
                @else
                    <a href="?lang=ka" {{ cookie('language') == 'ka' }}>
                        <img src="{{ asset('img/flag_geo.png') }}" width="20px" class="reverse">
                    </a>
                @endif







            </div>




            <style>
                @media (max-width: 767px) {
                    #search-me {
                        display: none;
                    }
                }

                @media screen and (max-width: 600px) {
                    @media (min-width: 768px) {
                        #search-me {
                            display: block;
                        }
                    }
                }

                .searchBox {
                    position: absolute;
                    top: 0;
                    /* Adjust this value */
                    right: 0;
                    /* Adjust this value */
                    background: #2f3640;
                    height: 35px;
                    border-radius: 40px;

                }

                .searchBox:hover>.searchInput {
                    width: 240px;
                    padding: 0 19px 6px;
                }

                .searchBox:hover>.searchButton {
                    background: white;
                    color: #2f3640;
                }

                .searchButton {
                    color: white;
                    float: right;
                    width: 35px;
                    height: 35px;
                    border-radius: 50%;
                    background: #2f3640;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    transition: 0.4s;
                }

                .searchInput {
                    border: none;
                    background: none;
                    outline: none;
                    float: left;
                    padding: 0;
                    color: white;
                    font-size: 16px;
                    transition: 0.4s;
                    line-height: 35px;
                    width: 0px;

                }

                @media screen and (max-width: 620px) {
                    .searchBox:hover>.searchInput {
                        width: 150px;
                        padding: 0 6px;
                    }
                }
            </style>

            <form id="search-me" action="{{ route('search') }}" method="_GET">
                <div class="searchBox">

                    <input class="searchInput" type="search" name="text" class="form-control"
                        placeholder="{{ Lang::get('lang.search') }}" style="font-size: 14px">
                    <button class="searchButton" href="#">
                        <i class="fas fa-search" style="font-size: 14px;"></i>
                    </button>
                </div>
            </form>

            <script>
                document.getElementById('search-me').addEventListener('submit', function(event) {
                    var inputField = document.querySelector('#search-me input[name="text"]');
                    if (inputField.value.trim() === '') {
                        event.preventDefault(); // Prevent form submission
                    }
                });
            </script>

<i class="bi bi-list mobile-nav-toggle" onclick="toggleSearchIcon()"></i>




        </nav>
        <!-- .navbar -->


    </div>

</header><!-- End Header -->
