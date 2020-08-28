@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row"><div class="col"><h1>Forums;</h1></div></div>
            
            @foreach($data['forums'] as $forum)

            <a href="forums/{{ $forum['id'] }}" class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            pic | <strong>{{ $forum['user']['last_name'] }} </strong>
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
@endsection 
