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
            <!-- Every row is a category -->
            @foreach($categories["content"] as $index=>$category)
            <div class="row">
                <div id="category-carousel{{$index}}" class="carousel slide" data-ride="carousel" data-interval="false">
                    <div class="category-name-section"></div>
                    <p class="category-name">General</p>
                    <ol class="carousel-indicators">
                        @foreach($category["sections"] as $sectionIndex => $section)
                            @if($sectionIndex == 0)
                            <li data-target="#category-carousel{{$index}}" data-slide-to="{{$sectionIndex}}" class="active"></li>
                            @else
                            <li data-target="#category-carousel{{$index}}" data-slide-to="{{$sectionIndex}}"></li>
                            @endif
                        @endforeach
                    </ol>
                    <!-- Inside Carousel -->
                    <div class="carousel-inner" style="background: #ffffff url(https://u.rindou.moe/p6jwBp8APwj1BLenHbhx.jpg) no-repeat left;">
                        <!-- Each carousel-item is a section -->
                        @foreach($category["sections"] as $sectionIndex => $section)
                        <div class="carousel-item active">
                            <div class="card bg-dark" >
                                <div class="section-image" style="background: url({{$section["image"]}}) no-repeat center top;"></div>
                                <div class="card-body" >
                                    <div class="description-holder">
                                        <h5 class="card-title text-center">{{$section["title"]}}</h5>
                                        <p class="card-text">{{$section["description"]}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="category-carousel{{$index}}" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="category-carousel{{$index}}" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    <div class="category-indicators-section"></div>
                </div>
            </div>
            @endforeach

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
