<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!--
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    -->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel">
        <div class="container">
            <a class="navbar-brand center" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            @if (Route::has('register'))
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container-fluid">
            <div class="row">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="false">
                    <div class="category-name-section"></div>
                    <p class="category-name">General</p>
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <!-- Inside Carousel -->
                    <div class="carousel-inner" style="background: #ffffff url(https://u.rindou.moe/p6jwBp8APwj1BLenHbhx.jpg) no-repeat left;">
                        <!-- Each carousel-item is a section -->
                        <div class="carousel-item active">
                            <div class="card bg-dark" >
                                <div class="section-image" style="background: url(https://i.paigeeworld.com/user-media/1465344000000/5726e584fbfb470337d13373_575778c59862b07255d1dbd5_320.jpg) no-repeat center top;"></div>
                                <div class="card-body" >
                                    <div class="description-holder">
                                        <h5 class="card-title text-center">Section 1 title</h5>
                                        <p class="card-text"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ac egestas libero. Duis et nunc quis orci semper finibus in quis arcu. Pellentesque viverra facilisis orci ut consectetur. Aenean ut sollicitudin ante. Praesent odio dui, rutrum eu imperdiet sed, lobortis lacinia nisi. Aliquam porta non mauris at vulputate. In et ante ultrices, pellentesque libero nec, iaculis nibh. Quisque mattis ante quis eleifend accumsan. Suspendisse lacinia mauris sit amet fermentum eleifend. Fusce posuere ut neque sit amet molestie. Proin gravida euismod justo quis placerat. Sed feugiat, est eu congue accumsan, libero urna lobortis est, pellentesque viverra odio urna gravida felis. Donec in pretium neque. Ut rutrum ligula at quam eleifend, quis vestibulum mauris consequat
                                            Nam vel blandit metus. Vivamus tincidunt dolor in lacus maximus laoreet. Duis laoreet hendrerit dictum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum consectetur sapien sit amet tellus lobortis ultrices quis ac turpis. Ut convallis diam enim, sit amet placerat justo consectetur tristique. Maecenas eu nulla et dui dignissim iaculis non et turpis. Nullam lacinia massa ante, sagittis vehicula nisl blandit id. Vestibulum venenatis elementum lorem, bibendum mattis purus lobortis tempus. Curabitur eleifend quis ligula vel placerat. Duis felis sem, volutpat ut posuere eu, tincidunt quis ex. Aenean non mattis neque. </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="card bg-dark" >
                                <div class="section-image" style="background: url(https://vignette.wikia.nocookie.net/bokunoheroacademia/images/2/24/Momo_Yaoyorozu_Portal_Image.png) no-repeat right top;"></div>
                                <div class="card-body" >
                                    <div class="description-holder">
                                        <h5 class="card-title text-center">Section 2 title</h5>
                                        <p class="card-text"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ac egestas libero. Duis et nunc quis orci semper finibus in quis arcu. Pellentesque viverra facilisis orci ut consectetur. Aenean ut sollicitudin ante. Praesent odio dui, rutrum eu imperdiet sed, lobortis lacinia nisi. Aliquam porta non mauris at vulputate. In et ante ultrices, pellentesque libero nec, iaculis nibh. Quisque mattis ante quis eleifend accumsan. Suspendisse lacinia mauris sit amet fermentum eleifend. Fusce posuere ut neque sit amet molestie. Proin gravida euismod justo quis placerat. Sed feugiat, est eu congue accumsan, libero urna lobortis est, pellentesque viverra odio urna gravida felis. Donec in pretium neque. Ut rutrum ligula at quam eleifend, quis vestibulum mauris consequat.

                                            Nam vel blandit metus. Vivamus tincidunt dolor in lacus maximus laoreet. Duis laoreet hendrerit dictum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum consectetur sapien sit amet tellus lobortis ultrices quis ac turpis. Ut convallis diam enim, sit amet placerat justo consectetur tristique. Maecenas eu nulla et dui dignissim iaculis non et turpis. Nullam lacinia massa ante, sagittis vehicula nisl blandit id. Vestibulum venenatis elementum lorem, bibendum mattis purus lobortis tempus. Curabitur eleifend quis ligula vel placerat. Duis felis sem, volutpat ut posuere eu, tincidunt quis ex. Aenean non mattis neque. </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="card bg-dark" >
                                <div class="section-image" style="background: url(https://pm1.narvii.com/6561/e5a91aa23f306f32841a09618396fe140ccce82c_hq.jpg) no-repeat right top;"></div>
                                <div class="card-body" >
                                    <div class="description-holder">
                                        <h5 class="card-title text-center">Section 3 title</h5>
                                        <p class="card-text"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ac egestas libero. Duis et nunc quis orci semper finibus in quis arcu. Pellentesque viverra facilisis orci ut consectetur. Aenean ut sollicitudin ante. Praesent odio dui, rutrum eu imperdiet sed, lobortis lacinia nisi. Aliquam porta non mauris at vulputate. In et ante ultrices, pellentesque libero nec, iaculis nibh. Quisque mattis ante quis eleifend accumsan. Suspendisse lacinia mauris sit amet fermentum eleifend. Fusce posuere ut neque sit amet molestie. Proin gravida euismod justo quis placerat. Sed feugiat, est eu congue accumsan, libero urna lobortis est, pellentesque viverra odio urna gravida felis. Donec in pretium neque. Ut rutrum ligula at quam eleifend, quis vestibulum mauris consequat.

                                            Nam vel blandit metus. Vivamus tincidunt dolor in lacus maximus laoreet. Duis laoreet hendrerit dictum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum consectetur sapien sit amet tellus lobortis ultrices quis ac turpis. Ut convallis diam enim, sit amet placerat justo consectetur tristique. Maecenas eu nulla et dui dignissim iaculis non et turpis. Nullam lacinia massa ante, sagittis vehicula nisl blandit id. Vestibulum venenatis elementum lorem, bibendum mattis purus lobortis tempus. Curabitur eleifend quis ligula vel placerat. Duis felis sem, volutpat ut posuere eu, tincidunt quis ex. Aenean non mattis neque. </p>
                                    </div>
                                </div>
                            </div>
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
                    <div class="category-indicators-section"></div>
                </div>
            </div>

            <div class="row">
                <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel" data-interval="false">
                    <div class="category-name-section"></div>
                    <p class="category-name">Mariqueras</p>
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators2" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators2" data-slide-to="2"></li>
                    </ol>
                    <!-- Inside Carousel -->
                    <div class="carousel-inner" style="background: #b1ff00 url(https://pm1.narvii.com/6835/c1c0bcd30e96d8c36f32c6a77359b538a7bd831dv2_hq.jpg) no-repeat left top;">
                        <!-- Each carousel-item is a section -->
                        <div class="carousel-item active">
                            <div class="card bg-dark" >
                                <div class="section-image" style="background: url(https://i.paigeeworld.com/user-media/1465344000000/5726e584fbfb470337d13373_575778c59862b07255d1dbd5_320.jpg) no-repeat center top;"></div>
                                <div class="card-body" >
                                    <div class="description-holder">
                                        <h5 class="card-title text-center">Section 1 title</h5>
                                        <p class="card-text"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ac egestas libero. Duis et nunc quis orci semper finibus in quis arcu. Pellentesque viverra facilisis orci ut consectetur. Aenean ut sollicitudin ante. Praesent odio dui, rutrum eu imperdiet sed, lobortis lacinia nisi. Aliquam porta non mauris at vulputate. In et ante ultrices, pellentesque libero nec, iaculis nibh. Quisque mattis ante quis eleifend accumsan. Suspendisse lacinia mauris sit amet fermentum eleifend. Fusce posuere ut neque sit amet molestie. Proin gravida euismod justo quis placerat. Sed feugiat, est eu congue accumsan, libero urna lobortis est, pellentesque viverra odio urna gravida felis. Donec in pretium neque. Ut rutrum ligula at quam eleifend, quis vestibulum mauris consequat.

                                            Nam vel blandit metus. Vivamus tincidunt dolor in lacus maximus laoreet. Duis laoreet hendrerit dictum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum consectetur sapien sit amet tellus lobortis ultrices quis ac turpis. Ut convallis diam enim, sit amet placerat justo consectetur tristique. Maecenas eu nulla et dui dignissim iaculis non et turpis. Nullam lacinia massa ante, sagittis vehicula nisl blandit id. Vestibulum venenatis elementum lorem, bibendum mattis purus lobortis tempus. Curabitur eleifend quis ligula vel placerat. Duis felis sem, volutpat ut posuere eu, tincidunt quis ex. Aenean non mattis neque. </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="card bg-dark" >
                                <div class="section-image" style="background: url(https://vignette.wikia.nocookie.net/bokunoheroacademia/images/2/24/Momo_Yaoyorozu_Portal_Image.png) no-repeat right top;"></div>
                                <div class="card-body" >
                                    <div class="description-holder">
                                        <h5 class="card-title text-center">Section 2 title</h5>
                                        <p class="card-text"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ac egestas libero. Duis et nunc quis orci semper finibus in quis arcu. Pellentesque viverra facilisis orci ut consectetur. Aenean ut sollicitudin ante. Praesent odio dui, rutrum eu imperdiet sed, lobortis lacinia nisi. Aliquam porta non mauris at vulputate. In et ante ultrices, pellentesque libero nec, iaculis nibh. Quisque mattis ante quis eleifend accumsan. Suspendisse lacinia mauris sit amet fermentum eleifend. Fusce posuere ut neque sit amet molestie. Proin gravida euismod justo quis placerat. Sed feugiat, est eu congue accumsan, libero urna lobortis est, pellentesque viverra odio urna gravida felis. Donec in pretium neque. Ut rutrum ligula at quam eleifend, quis vestibulum mauris consequat.

                                            Nam vel blandit metus. Vivamus tincidunt dolor in lacus maximus laoreet. Duis laoreet hendrerit dictum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum consectetur sapien sit amet tellus lobortis ultrices quis ac turpis. Ut convallis diam enim, sit amet placerat justo consectetur tristique. Maecenas eu nulla et dui dignissim iaculis non et turpis. Nullam lacinia massa ante, sagittis vehicula nisl blandit id. Vestibulum venenatis elementum lorem, bibendum mattis purus lobortis tempus. Curabitur eleifend quis ligula vel placerat. Duis felis sem, volutpat ut posuere eu, tincidunt quis ex. Aenean non mattis neque. </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="card bg-dark" >
                                <div class="section-image" style="background: url(https://pm1.narvii.com/6561/e5a91aa23f306f32841a09618396fe140ccce82c_hq.jpg) no-repeat right top;"></div>
                                <div class="card-body" >
                                    <div class="description-holder">
                                        <h5 class="card-title text-center">Section 3 title</h5>
                                        <p class="card-text"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ac egestas libero. Duis et nunc quis orci semper finibus in quis arcu. Pellentesque viverra facilisis orci ut consectetur. Aenean ut sollicitudin ante. Praesent odio dui, rutrum eu imperdiet sed, lobortis lacinia nisi. Aliquam porta non mauris at vulputate. In et ante ultrices, pellentesque libero nec, iaculis nibh. Quisque mattis ante quis eleifend accumsan. Suspendisse lacinia mauris sit amet fermentum eleifend. Fusce posuere ut neque sit amet molestie. Proin gravida euismod justo quis placerat. Sed feugiat, est eu congue accumsan, libero urna lobortis est, pellentesque viverra odio urna gravida felis. Donec in pretium neque. Ut rutrum ligula at quam eleifend, quis vestibulum mauris consequat.

                                            Nam vel blandit metus. Vivamus tincidunt dolor in lacus maximus laoreet. Duis laoreet hendrerit dictum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum consectetur sapien sit amet tellus lobortis ultrices quis ac turpis. Ut convallis diam enim, sit amet placerat justo consectetur tristique. Maecenas eu nulla et dui dignissim iaculis non et turpis. Nullam lacinia massa ante, sagittis vehicula nisl blandit id. Vestibulum venenatis elementum lorem, bibendum mattis purus lobortis tempus. Curabitur eleifend quis ligula vel placerat. Duis felis sem, volutpat ut posuere eu, tincidunt quis ex. Aenean non mattis neque. </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    <div class="category-indicators-section"></div>
                </div>
            </div>

        </div>
    </main>

</div>

<!-- Footer -->
<footer class="page-footer font-small bg-dark pt-4">
    <!-- Footer Links -->
    <div class="container text-center text-md-left">

        <!-- Grid row -->
        <div class="row">

            <!-- Grid column -->
            <div class="col-md-6 mt-md-0 mt-3">

                <!-- Content -->
                <h5 class="text-uppercase">{{ config('app.name', 'Laravel') }}</h5>
                <p>Ravioli ravioli, don't fuck the dragon loli.</p>

            </div>
            <!-- Grid column -->

            <hr class="clearfix w-100 d-md-none pb-3">

            <!-- Grid column -->
            <div class="col-md-3 mb-md-0 mb-3">
                <!-- Links -->
                <h5 class="text-uppercase">Links</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="https://github.com/Aztic">Github</a>
                    </li>
                    <li>
                        <a href="https://github.com/Aztic">Repository</a>
                    </li>
                    <li>
                        <a href="https://twitter.com/JhosevicCR">Twitter</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Grid row -->
    </div>
    <!-- Footer Links -->
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2018 Copyright:
        <a href="https://github.com/Aztic">Aztic</a>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->
</body>

<script>

    $(document).ready(function (){
        let cardBodies = document.getElementsByClassName("card-body");
        for(let i=0;i<cardBodies.length;i++){
            let item = cardBodies.item(i);
            for(let j=0;j<item.childNodes.length;j++){
                if(item.childNodes[j].className === "description-holder"){
                    let holder = item.childNodes[j];
                    holder.style.paddingRight = 50 + "px";
                    console.log("found");
                    break;
                }
            }
        }
    });

</script>
</html>
