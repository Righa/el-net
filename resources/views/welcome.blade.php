<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>EL Network</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>

        <div id="miSlider" class="carousel slide" data-ride="carousel">


        <nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background-color: rgba(0,0,0,0.7);">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
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
                        @if(!Session::has('miToken'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('login') }}">{{ __('Login') }}</a>
                            </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('register') }}">{{ __('Register') }}</a>
                                </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><img src="{{ session('user')['avatar_url'] }}" class="rounded-circle" style="height: 33px; width: 33px">
                                    {{ session('user')['first_name'] }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href=""
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ url('logout') }}" method="GET" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

          <!-- Indicators -->
          <ul class="carousel-indicators">
            <li data-target="#miSlider" data-slide-to="0" class="active"></li>
            <li data-target="#miSlider" data-slide-to="1"></li>
            <li data-target="#miSlider" data-slide-to="2"></li>
          </ul>

          <!-- The slideshow -->
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="{{ Storage::url('public/campain/Biology-HD-Wallpaper.jpg')}} " style="height: 100vh; width: 100%;" alt="Biology">

              <div class="carousel-caption text-warning" style="margin-bottom: 222px; background-color: rgba(0,0,0,0.7);">

                <strong class="display-1">E-LEARNING</strong>

                <br><br>

                <h1>Biological Science and Neuralink Technology</h1>

                <br><br><br>

                <h1>Github</h1>

                <br><br><br>

                <a href="https://github.com/righa" class="btn btn-primary btn-lg m-3">Lawrence</a>

                <a href="https://github.com/righa" class="btn btn-primary btn-lg m-3">Lawrence</a>

                <a href="https://github.com/righa" class="btn btn-primary btn-lg m-3">Lawrence</a>

                <a href="https://github.com/righa" class="btn btn-primary btn-lg m-3">Lawrence</a>
                
              </div>


            </div>
            <div class="carousel-item">
              <img src="{{ Storage::url('public/campain/lo-fi-artists-hip-hop-1280x640.jpg')}} " style="height: 100vh; width: 100%;" alt="Lo fi study">

              <div class="carousel-caption text-warning" style="margin-bottom: 222px; background-color: rgba(0,0,0,0.7);">
                <strong class="display-1">E-LEARNING</strong>

                <br><br>

                <h1>Ethics, Philosophy and Mental Health</h1>

                <br><br><br>

                <h1>Github</h1>

                <br><br><br>

                <a href="https://github.com/righa" class="btn btn-primary btn-lg m-3">Lawrence</a>

                <a href="https://github.com/righa" class="btn btn-primary btn-lg m-3">Lawrence</a>

                <a href="https://github.com/righa" class="btn btn-primary btn-lg m-3">Lawrence</a>

                <a href="https://github.com/righa" class="btn btn-primary btn-lg m-3">Lawrence</a>
                
              </div>

            </div>
            <div class="carousel-item">
              <img src="{{ Storage::url('public/campain/network-cable-wallpaper.jpg')}} " style="height: 100vh; width: 100%;" alt="Networking">

              <div class="carousel-caption text-warning" style="margin-bottom: 222px; background-color: rgba(0,0,0,0.7);">

                <strong class="display-1">E-LEARNING</strong>

                <br><br>

                <h1>Networking, Artificial General Intelligence among other Computing Sciences</h1>

                <br><br><br>

                <h1>Github</h1>

                <br><br><br>

                <a href="https://github.com/righa" class="btn btn-primary btn-lg m-3">Lawrence</a>

                <a href="https://github.com/righa" class="btn btn-primary btn-lg m-3">Lawrence</a>

                <a href="https://github.com/righa" class="btn btn-primary btn-lg m-3">Lawrence</a>

                <a href="https://github.com/righa" class="btn btn-primary btn-lg m-3">Lawrence</a>

              </div>


            </div>
          </div>

          <!-- Left and right controls -->
          <a class="carousel-control-prev" href="#miSlider" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </a>
          <a class="carousel-control-next" href="#miSlider" data-slide="next">
            <span class="carousel-control-next-icon"></span>
          </a>

        </div>
    </body>
</html>
