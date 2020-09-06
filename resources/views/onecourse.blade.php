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
                            <img src="{{ $data['courses']['avatar_url'] ?? '/storage/course_avatars/image-placeholder.png' }}" class="rounded" style="height: 144px; width: 144px">
                        </div>
                        <div class="col">
                            <h1>{{ $data['courses']['name'] }}</h1>
                            <img src="{{ $data['courses']['user']['avatar_url'] ?? '/storage/user_avatars/blank_profile_pic.png' }}" class="rounded-circle" style="height: 33px; width: 33px"> {{ $data['courses']['user']['first_name'] }} {{ $data['courses']['user']['last_name'] }}<br><br>

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

                    <div class="card bg-secondary text-warning mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h4>{{$material['source']['name']}}</h4>
                                </div>
                                <div class="col">
                                    Duration : {{$material['source']['duration']}} minutes
                                </div>


                                @if(session('user')['id'] == $data['courses']['user_id'])

                                 <div class="col-sm-2">
                                    <a href="{{url('exams/'.$material['source']['id'])}} " class="btn btn-primary btn-block">EDIT</a>
                                </div>

                                <div class="col-sm-2">

                                    <form method="post" action="{{url('materials/'.$material['id'])}}">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="course_id" value="{{$data['courses']['id']}}">
                                        <button type="submit" class="btn btn-danger btn-block">DELETE</button>
                                    </form>

                                </div>

                                @else

                                <div class="col-sm-2">
                                    <form method="post" action="{{url('takes')}} ">
                                        @csrf
                                        <input type="hidden" name="exam_id" value="{{$material['source']['id']}}">

                                        <button type="submit" class="btn btn-primary btn-block">OPEN</button>
                                    </form>
                                </div>

                                @endif
                            </div>
                        </div>
                    </div>

                    @else

                    <div class="card mb-3">
                        <div class="card-body">
                             <div class="row">
                                 <div class="col-sm-1"><span class="rounded p-2 w-25 border border-primary">{{$material['type']}}</span></div>

                                 <div class="col-md-6"><h5> <a href="{{url($material['source'])}}"> {{$material['name']}}</a></h5></div>

                                 <div class="col">

                                    <a href="{{url('materials/'.$material['id'])}}" class="btn btn-primary btn-block">DOWNLOAD</a>
                                     
                                 </div>

                                @if(session('user')['id'] == $data['courses']['user_id'])

                                 <div class="col">
                                    <button data-toggle="collapse" data-target="#material{{$topic['id']}}-{{$material['id']}} " class="btn btn-primary btn-block">EDIT</button>
                                </div>

                                <div class="col">

                                    <form method="post" action="{{url('materials/'.$material['id'])}}">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="course_id" value="{{$data['courses']['id']}}">
                                        <button type="submit" class="btn btn-danger btn-block">DELETE</button>
                                    </form>

                                </div>

                                @endif

                             </div>
                        </div>
                    </div>

                    @endif

                    @endforeach

                    @if(session('user')['id'] == $data['courses']['user_id'])
                    
                    <div class="row p-2">
                        <div class="col"><button data-toggle="collapse" data-target="#material{{$topic['id']}}" class="btn btn-primary btn-block">+ Create New Material</button></div>
                        <div class="col"><button data-toggle="collapse" data-target="#tests{{$topic['id']}}" class="btn btn-primary btn-block">+ Create New Test</button></div>
                    </div>
                    <div id="material{{$topic['id']}}" class="row collapse">
                        <form class="col p-2" method="post" action="{{url('materials')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="topic_id" value="{{$topic['id']}}">
                            <input type="hidden" name="course_id" value="{{$data['courses']['id']}}">
                            <div class="form-group">
                                <label><strong>File</strong></label><br>
                                <input id="img-in" type="file" class="form-control" name="attachment" required>
                            </div>
                            <div class="form-group">
                                <label><strong>Name</strong></label>
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
                            <input type="hidden" name="topic_id" value="{{$topic['id']}}">
                            <input type="hidden" name="course_id" value="{{$data['courses']['id']}}">
                            <div class="form-group">
                                <label><strong>Name</strong></label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label><strong>Duration(in minutes)</strong></label><br>
                                <input type="number" class="form-control" name="duration">
                            </div>
                            <div class="form-group">
                                <label><strong>Instructions</strong></label><br>
                                <textarea class="form-control" name="instructions"></textarea>
                            </div>
                            <div class="form-group">
                                <label><strong>Password</strong></label><br>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">CREATE</button>
                            </div>
                        </form>
                    </div>

                    <!-- edit forms -->



                    @foreach($topic['material'] as $material)

                    @if($material['type'] != 'exam')

                    <div id="material{{$topic['id']}}-{{$material['id']}}" class="row collapse">
                        <form class="col p-2" method="post" action="{{url('materials/'.$material['id'])}}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="topic_id" value="{{$topic['id']}}">
                            <input type="hidden" name="course_id" value="{{$data['courses']['id']}}">
                            <!--<div class="form-group">
                                <label><strong>File</strong></label><br>
                                <input id="img-in" type="file" class="form-control" name="newattachment">
                            </div>-->
                            <div class="form-group">
                                <label><strong>Name</strong></label>
                                <input type="text" name="newname" class="form-control" value="{{$material['name']}} ">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">UPDATE</button>
                            </div>
                        </form>
                    </div>

                    @endif

                    @endforeach

                    <!--end edit forms-->

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
