<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Video+</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- Booostrap JS -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

    <!-- CSS -->

</head>
<body>

<!-- header -->
<div class="container-fluid bg-light">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
            <a class="navbar-brand m-0 p-0" href="#" style="width: 150px">
                <img src="https://i2.cdn.turner.com/money/2008/10/08/smallbusiness/VideoPlus.fsb/video_plus_logo.03.jpg"
                     class="w-75">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- Left side of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link active" href="{{ route('home.public.index') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Group
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Group 1</a>
                            <a class="dropdown-item" href="#">Group 2</a>
                            <a class="dropdown-item" href="#">Group 3</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Others</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Category
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Game</a>
                            <a class="dropdown-item" href="#">Funny</a>
                            <a class="dropdown-item" href="#">Tutorial</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Others</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Favorite
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Video</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Others</a>
                        </div>
                    </li>
                </ul>

                <!-- search bar -->
                <form class="form-inline my-2 my-lg-0">
                        <span>
                        <select class="custom-select" style="border-radius: 25px 0px 0px 25px">
                            <option value="name" selected>Name</option>
                            <option value="category">Category</option>
                        </select>
                            </span>
                    <span>
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                        </span>
                    <span>
                            <button class="btn btn-outline-success my-2 my-sm-0"
                                    style="border-radius: 0px 25px 25px 0px" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                    </span>
                </form>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <a class="nav-link" data-toggle="modal" data-target="#notificationModal">
                        <i class="far fa-bell"></i>
                        Notification
                    </a>
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </div>
</div>

<!-- body -->
<div class="container-fluid" style="background-color: #EEEEEE">
    <div class="container p-0" style="background-color: white">

        <!-- slide -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="http://t.hdviet.com/backdrops/origins/8c30e4bd624b019700cc2ff5cb63e784.jpg"
                         class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="http://t.hdviet.com/backdrops/origins/05cca1cda24189886f10e1acdb1c7dad.jpg"
                         class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="http://t.hdviet.com/backdrops/origins/0b269f78d369987e40d66c40cd9edee0.jpg"
                         class="d-block w-100" alt="...">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <!-- Recommendeds -->
        <div>
            <div class="row mt-5">
                <div class="col-6">
                        <span class="float-left font-weight-bold ml-5">
                            <h3>Recommended</h3>
                        </span>
                </div>
                <div class="col-6">
                        <span class="float-right mb-3 mr-5">
                            <a class="btn btn-outline-info" href="">Show all</a>
                        </span>
                </div>
            </div>

            <div class="ml-5 mr-5 mb-5">
                <div id="carouselExampleControls1" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col">
                                    <img
                                        src="http://image.phimmoi.net/film/1920/poster.medium.jpg"
                                        class="d-block w-100" alt="...">
                                    <p class="mb-0"><a>Video title</a></p>
                                    <p class="mb-0" style="color: grey"><a>Video description</a></p>
                                </div>
                                <div class="col">
                                    <img
                                        src="http://image.phimmoi.net/film/6906/poster.medium.jpg"
                                        class="d-block w-100" alt="...">
                                    <p class="mb-0"><a>Video title</a></p>
                                    <p class="mb-0" style="color: grey"><a>Video description</a></p>
                                </div>
                                <div class="col">
                                    <img
                                        src="http://image.phimmoi.net/film/9505/poster.medium.jpg"
                                        class="d-block w-100" alt="...">
                                    <p class="mb-0"><a>Video title</a></p>
                                    <p class="mb-0" style="color: grey"><a>Video description</a></p>
                                </div>
                                <div class="col">
                                    <img
                                        src="http://image.phimmoi.net/film/8932/poster.medium.jpg"
                                        class="d-block w-100" alt="...">
                                    <p class="mb-0"><a>Video title</a></p>
                                    <p class="mb-0" style="color: grey"><a>Video description</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col">
                                    <img
                                        src="http://image.phimmoi.net/film/8922/poster.medium.jpg"
                                        class="d-block w-100" alt="...">
                                    <p class="mb-0"><a>Video title</a></p>
                                    <p class="mb-0" style="color: grey"><a>Video description</a></p>
                                </div>
                                <div class="col">
                                    <img
                                        src="http://image.phimmoi.net/film/1319/poster.medium.jpg"
                                        class="d-block w-100" alt="...">
                                    <p class="mb-0"><a>Video title</a></p>
                                    <p class="mb-0" style="color: grey"><a>Video description</a></p>
                                </div>
                                <div class="col">
                                    <img
                                        src="http://image.phimmoi.net/film/8361/poster.medium.jpg"
                                        class="d-block w-100" alt="...">
                                    <p class="mb-0"><a>Video title</a></p>
                                    <p class="mb-0" style="color: grey"><a>Video description</a></p>
                                </div>
                                <div class="col">
                                    <img
                                        src="http://image.phimmoi.net/film/8162/poster.medium.jpg"
                                        class="d-block w-100" alt="...">
                                    <p class="mb-0"><a>Video title</a></p>
                                    <p class="mb-0" style="color: grey"><a>Video description</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls1" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls1" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- space -->
        <div style="background-color: #EEEEEE; height: 50px"></div>

        <!-- Recently uploaded -->
        <div>
            <div class="row mt-5">
                <div class="col-6">
                        <span class="float-left font-weight-bold ml-5">
                            <h3>Recently uploaded</h3>
                        </span>
                </div>
                <div class="col-6">
                        <span class="float-right mb-3 mr-5">
                            <a class="btn btn-outline-info" href="">Show all</a>
                        </span>
                </div>
            </div>
            <div class="ml-5 mr-5 mb-5">
                <div id="carouselExampleControls2" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col">
                                    <img
                                        src="http://image.phimmoi.net/film/4496/poster.medium.jpg"
                                        class="d-block w-100" alt="...">
                                    <p class="mb-0"><a>Video title</a></p>
                                    <p class="mb-0" style="color: grey"><a>Video description</a></p>
                                </div>
                                <div class="col">
                                    <img
                                        src="http://image.phimmoi.net/film/8359/poster.medium.jpg"
                                        class="d-block w-100" alt="...">
                                    <p class="mb-0"><a>Video title</a></p>
                                    <p class="mb-0" style="color: grey"><a>Video description</a></p>
                                </div>
                                <div class="col">
                                    <img
                                        src="http://image.phimmoi.net/film/9672/poster.medium.jpg"
                                        class="d-block w-100" alt="...">
                                    <p class="mb-0"><a>Video title</a></p>
                                    <p class="mb-0" style="color: grey"><a>Video description</a></p>
                                </div>
                                <div class="col">
                                    <img
                                        src="http://image.phimmoi.net/film/9626/poster.medium.jpg"
                                        class="d-block w-100" alt="...">
                                    <p class="mb-0"><a>Video title</a></p>
                                    <p class="mb-0" style="color: grey"><a>Video description</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col">
                                    <img
                                        src="http://image.phimmoi.net/film/8360/poster.medium.jpg"
                                        class="d-block w-100" alt="...">
                                    <p class="mb-0"><a>Video title</a></p>
                                    <p class="mb-0" style="color: grey"><a>Video description</a></p>
                                </div>
                                <div class="col">
                                    <img
                                        src="http://image.phimmoi.net/film/9610/poster.medium.jpg"
                                        class="d-block w-100" alt="...">
                                    <p class="mb-0"><a>Video title</a></p>
                                    <p class="mb-0" style="color: grey"><a>Video description</a></p>
                                </div>
                                <div class="col">
                                    <img
                                        src="http://image.phimmoi.net/film/2945/poster.medium.jpg"
                                        class="d-block w-100" alt="...">
                                    <p class="mb-0"><a>Video title</a></p>
                                    <p class="mb-0" style="color: grey"><a>Video description</a></p>
                                </div>
                                <div class="col">
                                    <img
                                        src="http://image.phimmoi.net/film/9448/poster.medium.jpg"
                                        class="d-block w-100" alt="...">
                                    <p class="mb-0"><a>Video title</a></p>
                                    <p class="mb-0" style="color: grey"><a>Video description</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls2" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls2" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- space -->
        <div style="background-color: #EEEEEE; height: 50px"></div>

        <!-- new song & popular song -->
        <div style="background-color: white">
            <div class="row mt-5 mb-4">

                <!-- Popular -->
                <div class="col-6 border-right">
                    <div class="font-weight-bold ml-5 mb-3">
                        <h3>Popular</h3>
                    </div>
                    <div class="ml-4">
                        <div class="ml-5 mb-3">
                            <div class="row">
                                <div class="col-1">
                                    <img src="http://image.phimmoi.net/film/1920/poster.small.jpg"
                                         style="width: 50px; height: 50px" href="">
                                </div>
                                <div class="col-11">
                                    <div class="ml-3">
                                        <div>Video title</div>
                                        <div style="color: grey">Video description</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-5 mb-3">
                            <div class="row">
                                <div class="col-1">
                                    <img src="http://image.phimmoi.net/film/6906/poster.small.jpg"
                                         style="width: 50px; height: 50px" href="">
                                </div>
                                <div class="col-11">
                                    <div class="ml-3">
                                        <div>Video title</div>
                                        <div style="color: grey">Video description</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-5 mb-3">
                            <div class="row">
                                <div class="col-1">
                                    <img src="http://image.phimmoi.net/film/9762/poster.small.jpg"
                                         style="width: 50px; height: 50px" href="">
                                </div>
                                <div class="col-11">
                                    <div class="ml-3">
                                        <div>Video title</div>
                                        <div style="color: grey">Video description</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-5 mb-3">
                            <div class="row">
                                <div class="col-1">
                                    <img src="http://image.phimmoi.net/film/9757/poster.small.jpg"
                                         style="width: 50px; height: 50px" href="">
                                </div>
                                <div class="col-11">
                                    <div class="ml-3">
                                        <div>Video title</div>
                                        <div style="color: grey">Video description</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-5 mb-3">
                            <div class="row">
                                <div class="col-1">
                                    <img src="http://image.phimmoi.net/film/9661/poster.small.jpg"
                                         style="width: 50px; height: 50px" href="">
                                </div>
                                <div class="col-11">
                                    <div class="ml-3">
                                        <div>Video title</div>
                                        <div style="color: grey">Video description</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a class="btn btn-outline-info" href="">Show more</a>
                    </div>
                </div>

                <!-- Favorite -->
                <div class="col-6 border-left">
                    <div class="font-weight-bold ml-5 mb-3">
                        <h3>Favorite</h3>
                    </div>
                    <div class="ml-4">
                        <div class="ml-5 mb-3">
                            <div class="row">
                                <div class="col-1">
                                    <img src="http://image.phimmoi.net/film/9746/poster.small.jpg"
                                         style="width: 50px; height: 50px" href="">
                                </div>
                                <div class="col-11">
                                    <div class="ml-3">
                                        <div>Video title</div>
                                        <div style="color: grey">Video description</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-5 mb-3">
                            <div class="row">
                                <div class="col-1">
                                    <img src="http://image.phimmoi.net/film/9585/poster.small.jpg"
                                         style="width: 50px; height: 50px" href="">
                                </div>
                                <div class="col-11">
                                    <div class="ml-3">
                                        <div>Video title</div>
                                        <div style="color: grey">Video description</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-5 mb-3">
                            <div class="row">
                                <div class="col-1">
                                    <img src="http://image.phimmoi.net/film/9444/poster.small.jpg"
                                         style="width: 50px; height: 50px" href="">
                                </div>
                                <div class="col-11">
                                    <div class="ml-3">
                                        <div>Video title</div>
                                        <div style="color: grey">Video description</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-5 mb-3">
                            <div class="row">
                                <div class="col-1">
                                    <img src="http://image.phimmoi.net/film/9730/poster.small.jpg"
                                         style="width: 50px; height: 50px" href="">
                                </div>
                                <div class="col-11">
                                    <div class="ml-3">
                                        <div>Video title</div>
                                        <div style="color: grey">Video description</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-5 mb-3">
                            <div class="row">
                                <div class="col-1">
                                    <img src="http://image.phimmoi.net/film/9544/poster.small.jpg"
                                         style="width: 50px; height: 50px" href="">
                                </div>
                                <div class="col-11">
                                    <div class="ml-3">
                                        <div>Video title</div>
                                        <div style="color: grey">Video description</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a class="btn btn-outline-info" href="">Show more</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- space -->
        <div style="background-color: #EEEEEE; height: 50px"></div>

        <!-- Video descriptions -->
        <div style="background-color: white">
            <div class="row mt-5">
                <div class="col-6">
                        <span class="float-left font-weight-bold ml-5">
                            <h3>Celebrity</h3>
                        </span>
                </div>
                <div class="col-6">
                        <span class="float-right mb-3 mr-5">
                            <a class="btn btn-outline-info" href="">Show all</a>
                        </span>
                </div>
            </div>
            <div id="Video descriptionsSlide" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active text-center">
                        <div class="row ml-5 mr-5">
                            <div class="col-3">
                                <img
                                    src="https://avatar-nct.nixcdn.com/singer/avatar/2019/10/23/5/b/0/b/1571802458800.jpg"
                                    class="border rounded-circle">
                                <p class="mt-1">Hoàng Thùy Linh</p>
                            </div>
                            <div class="col-3">
                                <img
                                    src="https://avatar-nct.nixcdn.com/singer/avatar/2019/09/12/c/3/c/7/1568279069160.jpg"
                                    class="border rounded-circle">
                                <p class="mt-1">Bích Phương</p>
                            </div>
                            <div class="col-3">
                                <img
                                    src="https://avatar-nct.nixcdn.com/singer/avatar/2019/09/26/1/d/b/5/1569474237302.jpg"
                                    class="border rounded-circle">
                                <p class="mt-1">Hari Won</p>
                            </div>
                            <div class="col-3">
                                <img
                                    src="https://avatar-nct.nixcdn.com/singer/avatar/2019/08/05/0/f/7/3/1564989368094.jpg"
                                    class="border rounded-circle">
                                <p class="mt-1">Chi Pu</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item text-center">
                        <div class="row ml-5 mr-5">
                            <div class="col-3">
                                <img
                                    src="https://avatar-nct.nixcdn.com/singer/avatar/2019/10/23/5/b/0/b/1571802458800.jpg"
                                    class="border rounded-circle">
                                <p class="mt-1">Hoàng Thùy Linh</p>
                            </div>
                            <div class="col-3">
                                <img
                                    src="https://avatar-nct.nixcdn.com/singer/avatar/2019/09/12/c/3/c/7/1568279069160.jpg"
                                    class="border rounded-circle">
                                <p class="mt-1">Bích Phương</p>
                            </div>
                            <div class="col-3">
                                <img
                                    src="https://avatar-nct.nixcdn.com/singer/avatar/2019/09/26/1/d/b/5/1569474237302.jpg"
                                    class="border rounded-circle">
                                <p class="mt-1">Hari Won</p>
                            </div>
                            <div class="col-3">
                                <img
                                    src="https://avatar-nct.nixcdn.com/singer/avatar/2019/08/05/0/f/7/3/1564989368094.jpg"
                                    class="border rounded-circle">
                                <p class="mt-1">Chi Pu</p>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#Video descriptionsSlide" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#Video descriptionsSlide" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <!-- space -->
        <div style="background-color: #EEEEEE; height: 50px"></div>
    </div>
</div>

<!-- footer -->
<div class="container-fluid bg-dark">
    <div class="float-right mt-3 mb-3">
        <p>@Copyright: Video+</p>
    </div>
</div>


</body>
</html>
