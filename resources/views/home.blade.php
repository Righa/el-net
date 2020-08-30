@extends('layouts.app')

@section('content')

<div class="container">
  <!-- Nav pills -->
  <ul class="nav nav-pills" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="pill" href="#allCourses">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#courses">My Courses</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#forums">Forums</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">










    <div id="allCourses" class="container tab-pane active"><br>
      <h3>HOME</h3>

      <div class="row justify-content-center">
        <div class="col-md-10">

            @foreach($res['courses'] as $course)

            <a href="courses/{{ $course['id'] }}" class="card">
                <div class="card-header">{{ $course['name'] }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3"><img src="{{ $course['avatar_url'] }}" class="rounded" style="height: 99px; width: 99px"></div>

                        <div class="col">
                            {{ $course['description'] }} 
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            <img src="{{ $course['user']['avatar_url'] }}" class="rounded-circle" style="height: 33px; width: 33px"> {{ $course['user']['first_name'] }} {{ $course['user']['last_name'] }}
                        </div>
                    </div>
                </div>
            </a>

            @endforeach
            
        </div>
      </div>
    </div>










    <div id="courses" class="container tab-pane fade"><br>
      <h3>My Courses</h3>

      <div class="row justify-content-center">
        <div class="col-md-10">

            @foreach($res['myCourses'] as $course)

            <a href="courses/{{ $course['course']['id'] }}" class="card">
                <div class="card-header">{{ $course['course']['name'] }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3"><img src="{{ $course['course']['avatar_url'] }}" class="rounded" style="height: 99px; width: 99px"></div>

                        <div class="col">
                            {{ $course['course']['description'] }} 
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            <img src="{{ $course['course']['user']['avatar_url'] }}" class="rounded-circle" style="height: 33px; width: 33px"> {{ $course['course']['user']['first_name'] }} {{ $course['course']['user']['last_name'] }}
                        </div>
                    </div>
                </div>
            </a>

            @endforeach
            
        </div>
      </div>
    </div>










    <div id="forums" class="container tab-pane fade"><br>
      <h3>Forums</h3>
      
      <div class="row justify-content-center">
        <div class="col-md-10">
            
            @foreach($res['forums'] as $forum)

            <a href="forums/{{ $forum['id'] }}" class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <img src="{{ $forum['user']['avatar_url'] }}" class="rounded-circle" style="height: 33px; width: 33px"><strong>{{ $forum['user']['first_name'] }} </strong>
                            <p>{{ $forum['question'] }} </p>
                        </div>
                        <div class="col-sm-2 text-success">
                            x answers
                        </div>
                    </div>
                </div>
            </a>
            
            @endforeach

        </div>
      </div>
    </div>

  </div>
</div>
@endsection 
