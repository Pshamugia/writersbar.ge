<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet"
        href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') }}">
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>

     <link href="{{ asset('dist/css/styles.css') }}" rel="stylesheet" />

</head>

<body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">

        <a class="navbar-brand" style="color:white !important" href="{{ route('admin.article') }}">სამართავი
            პანელი</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
                class="fas fa-bars"></i></button><!-- Navbar Search-->




        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" method="get"
            action="{{ route('search_admin') }}">

            <div class="input-group">

                <input class="form-control" type="search" name="text" value="  ძიება..."
                    onblur="if(this.value=='') this.value='  ძიება...';"
                    onfocus="if(this.value=='  ძიება...') this.value='';" aria-label="Search"
                    aria-describedby="basic-addon2" />

                <div class="input-group-append">

                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>

                </div>

            </div>

        </form>

        <!-- Navbar-->

        <ul class="navbar-nav ml-auto ml-md-0">
            <style>
                .navbar a {
                    color: black !important
                }

                .dropdown-toggle::after {
                    color: white
                }
            </style>
            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"
                        style="color: white
                "></i></a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">

                    <a class="dropdown-item" href="#">Settings</a><a class="dropdown-item" href="#">Activity
                        Log</a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a>

                </div>

            </li>

        </ul>

    </nav>







    <!-- ======= About Section ======= -->

    <div id="layoutSidenav">

        <div id="layoutSidenav_nav">

            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">

                <div class="sb-sidenav-menu">

                    <div class="nav">

                        <div class="sb-sidenav-menu-heading">Core</div>

                        <a class="nav-link" href="{{ route('admin.article') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>

                            Dashboard
                        </a>

                        <div class="sb-sidenav-menu-heading">Interface</div>





                        <a class="nav-link" href="{{ route('admin.article') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>

                            საწყისი
                        </a>


                        <a class="nav-link" href="{{ route('admin.category.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                            კატეგორიები
                        </a>



                        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages"
                        aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>

                        გალერეა

                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>

                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                        data-parent="#sidenavAccordion">

                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">

                            <a class="nav-link" href="{{ route('admin.gallery.photo') }}" aria-expanded="false"
                                aria-controls="pagesCollapseAuth">

                                ფოტო

                                <div class="sb-sidenav-collapse-arrow"></div>
                            </a>

                            <a class="nav-link" href="{{ route('admin.gallery.video') }}" aria-expanded="false"
                                aria-controls="pagesCollapseError"> ვიდეო

                                <div class="sb-sidenav-collapse-arrow"></div>
                            </a>

                        </nav>

                    </div>

                        <a class="nav-link" href="{{ route('admin.authors') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-circle"></i></div>

                            ავტორები
                        </a>


                        <a class="nav-link" href="{{ route('admin.quizz') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-graduate"></i></div>

                            ქვიზები
                        </a>



                        <a class="nav-link" href="{{ route('admin.user') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-times"></i></div>

                            USERS
                        </a>


                        <a class="nav-link" href="https://writersbar.ge/roundcube/" target="_blank">
                            <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>

                            ელფოსტა
                        </a>





                        <a class="nav-link" href="index.php?do=room">
                            <div class="sb-nav-link-icon"><i class="fas fa-calendar-check"></i></div>

                            Booking room
                        </a>

                        <div class="sb-sidenav-menu-heading">Addons</div>

                        <a class="nav-link" href="{{ route('admin.logout') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-right-from-bracket"></i></div>

                            LOG OUT
                        </a><a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>

                            Tables
                        </a>

                    </div>

                </div>


                <div class="sb-sidenav-footer">

                    <div class="small">Logged in as:</div>

                    @if (Auth::user())
                        {{ Auth::user()->name }}
                    @endauth

            </div>

        </nav>

    </div>








    <div id="layoutSidenav_content">

        <main>

            <div class="container-fluid" style="height:auto">

                <h1 class="mt-4">Writersbar</h1>

                <ol class="breadcrumb mb-4">

                    <li class="breadcrumb-item active">Dashboard</li>

                </ol>







                <script>
                    if (window.history.replaceState) {

                        window.history.replaceState(null, null, window.location.href);

                    }
                </script>




</body>

</html>
