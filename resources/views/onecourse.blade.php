@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-1">
                            <a href="{{ url('home')}}" class="btn btn-outline-danger btn-block btn-lg"><h1>&lt</h1></a>
                        </div>

                        <div class="col-md-2">
                            <img src="{{ $data['courses']['avatar_url'] }}" class="rounded" style="height: 144px; width: 144px">
                        </div>
                        <div class="col">
                            <h1>{{ $data['courses']['name'] }}</h1>
                            <img src="{{ $data['courses']['user']['avatar_url'] }}" class="rounded-circle" style="height: 33px; width: 33px"> {{ $data['courses']['user']['first_name'] }} {{ $data['courses']['user']['last_name'] }}<br><br>

                            @if(session('user')['id'] == $data['courses']['user_id'])

                            <form method="post" action="{{url('courses/'.$data['courses']['id'])}} ">
                                @csrf
                                @method('delete')

                                <button type="submit" class="btn btn-sm btn-outline-danger">DELETE COURSE</button>
                            </form>

                            @else

                            <form method="post" action="{{url('enrollment/'.$data['courses']['id'])}} ">
                                @csrf
                                @method('delete')

                                <button type="submit" class="btn btn-sm btn-outline-danger">UNENROLL</button>
                            </form>

                            @endif
                            
                        </div>
                    </div>

                            @if(Session::has('success'))

                            <div class="alert alert-success">{{session('success')}} </div>

                            @endif

                            @if(Session::has('errors'))

                            <div class="alert alert-danger">{{session('errors')}} </div>

                            @endif
                    
                </div>
                <div class="card-body">

                    @foreach($data['courses']['topics'] as $topic)
                    
                    <div class="row"><div class="col"><h3>{{ $topic['name'] }}</h3></div></div>


                    @if(count($topic['material']) == 0)

                    <div class="rounded p-3 mb-3 text-secondary bg-light">No contents</div>

                    @endif

                    @foreach($topic['material'] as $material)

                    @if($material['type'] == 'exam')

                    <div class="card text-white bg-secondary mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h4>Exam Name</h4>
                                </div>
                                <div class="col">
                                    Duration : xhrs
                                </div>
                                <div class="col-sm-2">
                                    <a href="" class="btn btn-primary btn-block">Attempt</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @else

                    <div href="" class="card mb-3">
                        <div class="card-body">
                             <h5><span class="rounded p-2 w-25 border border-primary">{{$material['type']}}</span> <a href="{{$material['source']}}"> {{$material['name']}}</a></h5>
                        </div>
                    </div>

                    @endif

                    @endforeach

                    @if(session('user')['id'] == $data['courses']['user_id'])
                    
                    <div class="row">
                        <div class="col"><button data-toggle="collapse" data-target="#material{{$topic['id']}}" class="btn btn-primary btn-block">+ Create New Material</button></div>
                        <div class="col"><button data-toggle="collapse" data-target="#tests{{$topic['id']}}" class="btn btn-primary btn-block">+ Create New Test</button></div>
                    </div><br>
                    <div id="material{{$topic['id']}}" class="row collapse">
                        <form class="col p-2" method="post" action="{{url('materials')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="topic_id" value="{{$topic['id']}}">
                            <input type="hidden" name="course_id" value="{{$data['courses']['id']}}">
                            <div class="form-group">
                                <label>File</label><br>
                                <input id="img-in" type="file" class="form-control" name="attachment" required>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">CREATE</button>
                            </div>
                        </form>
                    </div>

                    <div id="tests{{$topic['id']}}" class="row collapse">
                        <form class="col p-2" method="post" action="{{url('exams')}} ">
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Duration</label><br>
                                <input id="img-in" type="number" class="form-control" name="duration">
                            </div>
                            <div class="form-group">
                                <label>Password</label><br>
                                <input id="img-in" type="password" class="form-control" name="password">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">CREATE</button>
                            </div>
                        </form>
                    </div>

                    @endif

                    @endforeach

                    @if(session('user')['id'] == $data['courses']['user_id'])

                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{url('topics')}}">
                                @csrf
                                <input type="hidden" name="course_id" value="{{$data['courses']['id']}}">
                                <div class="input-group mb-3">
                                  <input type="text" name="name" class="form-control" placeholder="Topic name">
                                  <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Create New Topic</button>
                                  </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
