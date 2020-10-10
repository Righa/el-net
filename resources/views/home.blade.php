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









    <div id="allCourses" class=" tab-pane active"><br>
      <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col"><h3>HOME</h3></div>

                    @if(session('user')['role'] == 'teacher')

                    <div class="col-md-3"><a href="{{url('courses/create')}} " class="btn btn-primary btn-block">+ Create New Course</a></div>
                    @endif

                </div>

                            @if(Session::has('success'))

                            <div class="alert alert-success">{{session('success')}} </div>

                            @endif

                            @if(Session::has('errors'))

                            <div class="alert alert-danger">{{session('errors')}} </div>

                            @endif
            </div>

          <div class="card-body">
              <div class="row justify-content-center">
                <div class="col-md-12">

                    @foreach($res['courses'] as $course)

                    <div class="card" style="margin-bottom: 22px">
                        <div class="card-header">
                            <h3>{{ $course['name'] }}</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3"><img src="{{ $course['avatar_url'] ?? '/storage/course_avatars/image-placeholder.png' }}" class="rounded" style="height: 99px; width: 99px"></div>

                                <div class="col">
                                    {{ $course['description'] }} 
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col">
                                    <img src="{{ $course['user']['avatar_url'] ?? '/storage/user_avatars/blank_profile_pic.png' }}" class="rounded-circle" style="height: 33px; width: 33px"> {{ $course['user']['first_name'] }} {{ $course['user']['last_name'] }}
                                </div>

                                <?php $regd = false; ?>

                                @foreach($res['myCourses'] as $enrolled)

                                @if($enrolled['course']['id'] == $course['id'])

                                <div class="col-md-4">
                                    <a href="courses/{{ $course['id'] }}" class="btn btn-primary btn-block">View</a>
                                </div>

                                <?php $regd = true; ?>

                                @endif

                                @endforeach

                                <?php if ($regd == false): ?>

                                <div class="col-md-4">
                                    <form method="post" action="{{url('enrollment')}}">
                                        @csrf
                                        <input type="hidden" name="course_id" value="{{$course['id']}}">
                                        <div class="input-group mb-3">
                                          <input type="password" name="password" class="form-control" placeholder="password">
                                          <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">Enroll</button>
                                          </div>
                                        </div>
                                    </form>
                                </div>

                                <?php endif ?>

                            </div>
                        </div>
                    </div>

                    @endforeach
                    
                </div>
              </div>
          </div>
      </div>
    </div>










    <div id="courses" class="container tab-pane fade"><br>
      

      <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col"><h3>MY COURSES</h3></div>

                    @if(session('user')['role'] == 'teacher')

                    <div class="col-md-3"><a href="{{url('courses/create')}} " class="btn btn-primary btn-block">+ Create New Course</a></div>

                    @endif
                    
                </div>
            </div>

            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-12">

                    @foreach($res['myCourses'] as $course)

                    <div class="card" style="margin-bottom: 22px">
                        <div class="card-header"><h3>{{ $course['course']['name'] }}</h3></div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3"><img src="{{ $course['course']['avatar_url'] ?? '/storage/course_avatars/image-placeholder.png' }}" class="rounded" style="height: 99px; width: 99px"></div>

                                <div class="col">
                                    {{ $course['course']['description'] }} 
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col">
                                    <img src="{{ $course['course']['user']['avatar_url'] ?? '/storage/user_avatars/blank_profile_pic.png' }}" class="rounded-circle" style="height: 33px; width: 33px"> {{ $course['course']['user']['first_name'] }} {{ $course['course']['user']['last_name'] }}
                                </div>

                                <div class="col-md-3">
                                    <a href="courses/{{ $course['course']['id'] }}" class="btn btn-primary btn-block">View</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                    
                </div>
              </div>
          </div>
      </div>
    </div>










    <div id="forums" class="container tab-pane fade"><br>
      

      <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col"><h3>FORUMS</h3></div>
                    <div class="col-md-3"><button data-toggle="collapse" data-target="#newforum" class="btn btn-primary btn-block">+ Create New Forum</button></div>
                </div>
                <div id="newforum" class="collapse" >

                    <form method="post" action="{{url('forums')}}">
                        @csrf
                        <div class="form-group">
                          <label for="answer">Your Question:</label>
                          <textarea class="form-control" rows="4" name="question" id="answer"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <select type="text" name="subject" class="form-control custom-select">

                                @foreach($res['subjects'] as $subject)

                                <option value="{{$subject['id']}} ">{{$subject['name']}} </option>

                                @endforeach

                            </select>
                        </div>
                        <div><button type="submit" class="btn btn-primary">SUBMIT</button></div>
                    </form>

                </div>
            </div>
            <div class="card-body">
                  <div class="row justify-content-center">
                    <div class="col-md-12">
                        
                        @foreach($res['forums'] as $forum)

                        <div class="card" style="margin-bottom: 22px">
                            <div class="card-header">
                                <img src="{{ $forum['user']['avatar_url'] ?? '/storage/user_avatars/blank_profile_pic.png' }}" class="rounded-circle" style="height: 33px; width: 33px"><strong> {{ $forum['user']['first_name'] }} {{ $forum['user']['last_name'] }}:</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <p>{{ $forum['question'] }} </p>
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="forums/{{ $forum['id'] }}" class="btn btn-primary btn-block">{{count($forum['forum_answers'])}} answers</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @endforeach

                    </div>
                  </div>
            </div>
      </div>
            
    </div>

  </div>
</div>
@endsection 
