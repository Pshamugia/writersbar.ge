@extends('layout')

@section('menu')
    @if (session()->has('error'))
        <div id="errorModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Error</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ session('error') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#errorModal').modal('show');
            });
        </script>
    @endif

    @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                    aria-selected="true">შესვლა</button>
                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                                    aria-selected="false">რეგისტრაცია</button>
                            </div>
                        </nav>
                        <br><br>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <form action="{{ route('booking.auth') }}" method="post">
                                    @csrf

                                    <div class="form-group input-group">

                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="font-size: 28px"><i
                                                    class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" name="email" placeholder="{{ Lang::get('lang.email') }}" class="form-control" id="email" required>
                                    </div>


                                    <div class="form-group input-group" style="margin-top: 13px;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="font-size: 28px"><i
                                                    class="fa fa-key"></i></span>
                                        </div>
                                        <input type="password" name="password" placeholder="{{ Lang::get('lang.password') }}" class="form-control" id="password" required>
                                    </div>
                                    <!-- Checkbox -->
                                    <div class="form-check d-flex justify-content-start mb-4" style="margin-top: 14px;">
                                        <input class="form-check-input" type="checkbox" value="1" name="remember"
                                            id="form1Example3" />
                                        <label class="form-check-label" for="form1Example3">
                                            &nbsp; {{ Lang::get('lang.rememberPassword') }}
                                            </label>
                                    </div>

                                    <button class="btn btn-primary btn-lg btn-block" type="submit"
                                        style="float: left; font-size:16px">{{ Lang::get('lang.login') }}</button>
                                    <span style="position: relative; margin-left: 22px;"> <a
                                            href="{{ route('forget.password.post') }}" style="color: red">
                                            {{ Lang::get('lang.reset') }} </a></span>

                                    <br><br>
                                    <hr class="my-4">

                                    <div class="col-md-6" style="margin: 0 auto;">
                                        <a href="{{ url('auth/google') }}">
                                            <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png"
                                                style="width: 100%">
                                        </a>
                                    </div>

                                    <hr class="my-4">
                                </form>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <form action="{{ route('booking.create') }}" method="post">
                                    @csrf


                                    <div class="form-group input-group" style="margin-top: 13px;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="font-size: 32px"><i
                                                    class="fa fa-user"></i></span>
                                        </div>
                                        <input type="text" name="name" placeholder="{{ Lang::get('lang.yourName') }}" class="form-control" id="name"
                                            required>
                                    </div>

                                    <div class="form-group input-group" style="margin-top: 13px;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="font-size: 28px"><i
                                                    class="fa fa-envelope"></i></span>
                                        </div>

                                        <input type="email" name="email" placeholder="{{ Lang::get('lang.email') }}" class="form-control" id="email"
                                            required>
                                    </div>

                                     <div class="form-group input-group" style="margin-top: 13px;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="font-size: 28px"><i
                                                    class="fa fa-key"></i></span>
                                        </div>

                                        <input type="password" name="password" placeholder="{{ Lang::get('lang.password') }}" class="form-control" id="password"
                                            required>
                                    </div>
                                    <button class="btn btn-primary btn-lg btn-block" style="float: left; margin-top:25px; width: 100%; font-size: 16px"
                                        type="submit">{{ Lang::get('lang.register') }}</button>
                                    <!-- Add any additional registration-related content here -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
