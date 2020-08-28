@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col">
                    <strong>pic;~</strong><strong>{{ $data['forum']['user_id'] }};~</strong>
                    <p>{{ $data['forum']['question'] }}</p>  
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="badge badge-primary">subject</div>
                </div>
            </div>

            @foreach($data['forum']['forum_answers'] as $answer)
            <div class="card">
                <div class="card-body">
                    <strong>{{ $answer['user_id'] }}: </strong>{{ $answer['answer'] }} <strong>{{ count($answer['votes']) }} votes</strong>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection 
