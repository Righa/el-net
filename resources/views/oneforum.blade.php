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
                            <img src="{{ $data['forum']['user']['avatar_url'] }}" class="rounded-circle" style="height: 33px; width: 33px"><strong> {{ $data['forum']['user']['first_name'] }} {{ $data['forum']['user']['last_name'] }};</strong>
                            <p>{{ $data['forum']['question'] }}</p>
                            <div class="badge badge-primary">{{ $data['forum']['subject']['name'] }}</div> 
                        </div>

                    </div>
                </div>
                <div class="card-body">

                    @foreach($data['forum']['forum_answers'] as $answer)

                    <div class="card" style="margin-bottom: 22px">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="card">
                                        <div class="card-header">
                                            <form>
                                                <input type="hidden" name="answer_id" value="{{$answer['id']}} ">
                                                <input type="hidden" name="vote" value="1">
                                                <button type="submit" class="btn btn-sm btn-link text-success">upvote</button>
                                            </form>
                                        </div>
                                        <div class="card-body text-info"><strong>{{ count($answer['votes']) }} Votes</strong></div>
                                        <div class="card-footer ">
                                            <form>
                                                <input type="hidden" name="answer_id" value="{{$answer['id']}} ">
                                                <input type="hidden" name="vote" value="-1">
                                                <button type="submit" class="btn btn-sm btn-link text-danger">downvote</button>
                                            </form>
                                        </div>
                                    </div>
                                
                                </div>

                                <div class="col">
                                    <strong>{{ $answer['user']['first_name'] }} {{ $answer['user']['last_name'] }}: </strong>{{ $answer['answer'] }}
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

                    <form method="post" action="forum_answers">
                        <div class="form-group">
                          <label for="answer">Your Answer:</label>
                          <textarea class="form-control" rows="3" id="answer"></textarea>
                        </div>
                        <div><button type="submit" class="btn btn-primary">Submit Answer</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
