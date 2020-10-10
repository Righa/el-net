@if(Session::has('miToken'))
<script type="text/javascript">
    window.location = "/home";
</script>
@endif
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

        <div class="row p-5 fixed-top" style="background-color: rgba(0,0,0,0.7);">
            <div class="col-sm-1"></div>
            <div class="col">
                <h3 class="display-4 text-primary">E-LEARNING</h3>
            </div>
            <div class="col-sm-1">
                <a class="btn btn-primary btn-lg p-3 btn-block" href="{{url('login')}}">LOGIN</a>
            </div>
            <div class="col-sm-1">
                <a class="btn btn-primary btn-lg p-3 btn-block" href="{{url('register')}}">REGISTER</a>
            </div>
            <div class="col-sm-1"></div>
        </div>

        <div id="miSlider" class="carousel slide" data-ride="carousel">

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

                <h1>{{ Illuminate\Foundation\Inspiring::quote() }}</h1>

                <br><br><br>

                <a href="https://github.com/righa" target="_blank" class="btn btn-primary btn-lg m-3">Lawrence</a>

                <a href="https://github.com/raphael340" target="_blank" class="btn btn-primary btn-lg m-3">Raphael</a>

                <a href="https://github.com/mathew10005" target="_blank" class="btn btn-primary btn-lg m-3">Matthew</a>

                <a href="https://github.com/mainina9" target="_blank" class="btn btn-primary btn-lg m-3">Maina</a>
                
              </div>


            </div>
            <div class="carousel-item">
              <img src="{{ Storage::url('public/campain/lo-fi-artists-hip-hop-1280x640.jpg')}} " style="height: 100vh; width: 100%;" alt="Lo fi study">

              <div class="carousel-caption text-warning" style="margin-bottom: 222px; background-color: rgba(0,0,0,0.7);">
                <strong class="display-1">E-LEARNING</strong>

                <br><br>

                <h1>Ethics, Philosophy and Mental Health</h1>

                <br><br><br>

                <h1>{{ Illuminate\Foundation\Inspiring::quote() }}</h1>

                <br><br><br>

                <a href="https://github.com/righa" target="_blank" class="btn btn-primary btn-lg m-3">Lawrence</a>

                <a href="https://github.com/raphael340" target="_blank" class="btn btn-primary btn-lg m-3">Raphael</a>

                <a href="https://github.com/mathew10005" target="_blank" class="btn btn-primary btn-lg m-3">Matthew</a>

                <a href="https://github.com/mainina9" target="_blank" class="btn btn-primary btn-lg m-3">Maina</a>
                
              </div>

            </div>
            <div class="carousel-item">
              <img src="{{ Storage::url('public/campain/network-cable-wallpaper.jpg')}} " style="height: 100vh; width: 100%;" alt="Networking">

              <div class="carousel-caption text-warning" style="margin-bottom: 222px; background-color: rgba(0,0,0,0.7);">

                <strong class="display-1">E-LEARNING</strong>

                <br><br>

                <h1>Networking, Artificial General Intelligence among other Computing Sciences</h1>

                <br><br><br>

                <h1>{{ Illuminate\Foundation\Inspiring::quote() }}</h1>

                <br><br><br>

                <a href="https://github.com/righa" target="_blank" class="btn btn-primary btn-lg m-3">Lawrence</a>

                <a href="https://github.com/raphael340" target="_blank" class="btn btn-primary btn-lg m-3">Raphael</a>

                <a href="https://github.com/mathew10005" target="_blank" class="btn btn-primary btn-lg m-3">Matthew</a>

                <a href="https://github.com/mainina9" target="_blank" class="btn btn-primary btn-lg m-3">Maina</a>

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
