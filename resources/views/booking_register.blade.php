@extends('layout')


@section('menu')
@if ($errors->any())
                    <div class="alert alert-danger">
                        <ul style="list-style: none">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
<li>
    <span style="position: relative;">
        <a href="{{ route('forget.password.post') }}" style="color: red"> {{ Lang::get('lang.reset') }} </a>
    </span>
</li>

                            @endforeach
                        </ul>
                    </div>
                @endif

    <form action="{{ route('booking.create') }}" method="post">
        @csrf
        <section>
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center ">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">

                                <h3 class="mb-5">
                                    {{ Lang::get('lang.registerBook') }}
                                </h3>



                                <div class="form-outline mb-4">
                                    <input type="text" name="name" id="typeEmailX-2"
                                        class="form-control form-control-lg" />
                                    <label class="form-label" for="typeEmailX-2">
                                        {{ Lang::get('lang.yourName') }}
                                    </label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="email" name="email" id="typeEmailX-2"
                                        class="form-control form-control-lg" />
                                    <label class="form-label" for="typeEmailX-2">
                                        {{ Lang::get('lang.email') }}
                                    </label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" name="password" required id="typePasswordX-2"
                                        class="form-control form-control-lg" />
                                    <label class="form-label" for="typePasswordX-2">
                                        {{ Lang::get('lang.password') }}
                                    </label>
                                </div>



                                <button class="btn btn-primary btn-lg btn-block" type="submit">
                                    {{ Lang::get('lang.register') }}
                                </button>

                                <hr class="my-4">

                                <i class="fa fa-exclamation-triangle" style="color: red" aria-hidden="true"></i>
                                {{ Lang::get('lang.registered')}},
                                <br>

                                <a href="{{ route('booking.login') }}" style="color: red">
                                    {{ Lang::get('lang.sign') }}.
                                 </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection
