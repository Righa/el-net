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

                        <div class="col">
                            <img src="{{ $data['forum']['user']['avatar_url'] ?? '/storage/user_avatars/blank_profile_pic.png' }}" class="rounded-circle" style="height: 33px; width: 33px"><strong> {{ $data['forum']['user']['first_name'] }} {{ $data['forum']['user']['last_name'] }};</strong>
                            <h5 class="p-3">{{ $data['forum']['question'] }}</h5>
                            <div class="badge badge-primary">{{ $data['forum']['subject']['name'] }}</div> 
                        </div>

                    </div>


                    @if(Session::has('success'))

                    <br><div class="alert alert-success">{{session('success')}} </div>

                    @endif

                    @if(Session::has('errors'))

                    <div class="alert alert-danger">{{session('errors')}} </div>

                    @endif


                </div>
                <div class="card-body">

                    @foreach($data['forum']['forum_answers'] as $answer)

                    <div class="card" style="margin-bottom: 22px">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="card">
                                        <div class="card-header p-0">
                                            <form method="post" action="{{url('votes')}} ">
                                                @csrf
                                                <input type="hidden" name="forum_id" value="{{$data['forum']['id']}} ">
                                                <input type="hidden" name="answer_id" value="{{$answer['id']}} ">
                                                <input type="hidden" name="vote" value="1">
                                                <button type="submit" class="btn btn-sm btn-link text-success btn-block">upvote</button>
                                            </form>
                                        </div>
                                        <div class="display-4 card-body text-center text-info p-0"><strong>{{ $answer['total_votes'] }}</strong></div>
                                        <div class="card-footer p-0">
                                            <form method="post" action="{{url('votes')}} ">
                                                @csrf
                                                <input type="hidden" name="forum_id" value="{{$data['forum']['id']}} ">
                                                <input type="hidden" name="answer_id" value="{{$answer['id']}} ">
                                                <input type="hidden" name="vote" value="-1">
                                                <button type="submit" class="btn btn-sm btn-link text-danger btn-block">downvote</button>
                                            </form>
                                        </div>
                                    </div>
                                
                                </div>

                                <div class="col">
                                    <img src="{{ $answer['user']['avatar_url'] ?? '/storage/user_avatars/blank_profile_pic.png' }}" class="rounded-circle" style="height: 33px; width: 33px">
                                    <strong>{{ $answer['user']['first_name'] }} {{ $answer['user']['last_name'] }}: </strong><h5 class="p-3">{{ $answer['answer'] }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach

                    @if(count($data['forum']['forum_answers']) == 0)

                    <div class="jumbotron">
                        There are no answers for this forum
                    </div>

                    @endif

                    <form method="post" action="{{url('forum_answers')}} ">
                        @csrf
                        <input type="hidden" name="forum_id" value="{{$data['forum']['id']}}">
                        <div class="form-group">
                          <label for="answer">Your Answer:</label>
                          <textarea class="form-control" rows="3" name="answer" id="answer"></textarea>
                        </div>
                        <div><button type="submit" class="btn btn-primary">Submit Answer</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
