@extends('layout')
@section('slide')
    @foreach ($articles as $article)
        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
            <div class="carousel-container">


                <h2 class="animate__animated animate__fadeInDown"> {{ $article->title() }}</span></h2>
                <p class="animate__animated fanimate__adeInUp">






                    {{ $article->descriptions() }} </p>

                <a href="{{ route('full', ['id' => $article->id, 'title_ka' => Str::slug($article->title())]) }}"
                    class="btn-get-started animate__animated animate__fadeInUp scrollto"> {{ Lang::get('lang.read more') }}
                </a>


            </div>
        </div>
    @endforeach


    <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
    </a>

    <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
    </a>
@endsection

@section('menu')
    <section id="menu" class="about">
        <div class="container">

            <div class="section-title" data-aos="zoom-out">
                <h2>{{ Lang::get('lang.about') }}</h2>
                <p>{{ Lang::get('lang.whoweare') }}</p>
            </div>


            <div class="row content" data-aos="fade-up">
                <div class="col-lg-6">
                    <p>
                        @foreach ($about as $abouts)
                            {{ @$abouts->descriptions() }}
                        @endforeach

                    </p>
                </div>
            </div>

        </div>
    </section>
@endsection


@section('booking')
    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
        <div class="container">

            <div class="row" data-aos="zoom-out">
                <div class="col-lg-9 text-center text-lg-start">
                    <h3>{{ Lang::get('lang.bookTable') }}</h3>
                    <p>
                        {{ Lang::get('lang.bookContact') }}

                    </p>
                </div>
                <div class="col-lg-3 cta-btn-container text-center">

                    @auth
                        @if (Auth::user()->type > 0)
                            <a class="cta-btn align-middle"
                                href="{{ route('booking.room') }}">{{ Lang::get('lang.bookVisit') }}</a>
                        @else
                            <a class="cta-btn align-middleo"
                                href="{{ route('booking.login') }}">{{ Lang::get('lang.bookNow') }}</a>
                        @endauth
                    @else
                        <a class="cta-btn align-middle" href="{{ route('booking.login') }}">
                            {{ Lang::get('lang.bookNow') }}</a>
                    @endif







                </div>
            </div>

        </div>
    </section>
@endsection


@section('services')
    <section id="services" class="services">
        <div class="container">

            <div class="section-title" data-aos="zoom-out">
                <h2>{{ Lang::get('lang.bestsellers') }}</h2>
                <p>{{ Lang::get('lang.popularCocktails') }}</p>
            </div>

            <div class="row">
                @foreach ($bestseller as $bestsellers)
                    <div class="col-lg-4 col-md-6" style="padding-bottom: 30px;">

                        <div class="icon-box" data-aos="zoom-in-left">
                            <h4 class="title"><a href=""> {{ $bestsellers->title() }}</a></h4>

                            <img src="{{ asset($bestsellers->upload) }}" width="100%" class="col-md-12">

                        </div>


                    </div>
                @endforeach


            </div>

        </div>
    </section><!-- End Services Section -->
@endsection


@section('contact')
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">

            <div class="section-title" data-aos="zoom-out">
                <h2>{{ Lang::get('lang.contact') }}</h2>
                <p>{{ Lang::get('lang.contactUs') }}</p>
            </div>

            <div class="row mt-5">

                <div class="col-lg-4" data-aos="fade-right">
                    <div class="info">
                        <div class="address">
                            <i class="bi bi-geo-alt"></i>
                            <h4>{{ Lang::get('lang.location') }}:</h4>
                            <p>{{ Lang::get('lang.address') }}</p>
                        </div>

                        <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>{{ Lang::get('lang.email') }}:</h4>
                            <p>meetme@writersbar.ge</p>
                        </div>

                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>{{ Lang::get('lang.call') }}:</h4>
                            <p>+995 557 78 33 88</p>
                        </div>

                    </div>

                </div>

                <div class="col-lg-8 mt-5 mt-lg-0" data-aos="fade-left">

                    <form action="{{ route('contact') }}" method="post" role="form" class="php-email-form">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="{{ Lang::get('lang.yourName') }}" required>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="{{ Lang::get('lang.yourEmail') }}" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject"
                                placeholder="{{ Lang::get('lang.subject') }}" required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="{{ Lang::get('lang.message') }}" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">{{ Lang::get('lang.loading') }}</div>
                            <div class="error-message"></div>
                            <div class="sent-message">{{ Lang::get('lang.sent') }}</div>
                        </div>
                        <div class="text-center"><button type="submit">{{ Lang::get('lang.sendMessage') }}</button>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->
@endsection
<script>
    var userAgent = navigator.userAgent;

    if (userAgent.includes('Mobile')) {
        document.cookie = 'device_type=Mobile; path=/;';
    } else if (userAgent.includes('Tablet')) {
        document.cookie = 'device_type=Tablet; path=/;';
    } else {
        document.cookie = 'device_type=Desktop; path=/;';
    }
</script>

