@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row"><div class="col"><h1>{{ $data['courses']['name'] }}</h1></div></div>

            @foreach($data['courses']['topics'] as $topic)
            
            <div class="row"><div class="col"><h3>{{ $topic['name'] }}</h3></div></div>

            @foreach($topic['material'] as $material)
            
            @endforeach

            <a href="" class="card">
                <div class="card-body">
                    ikon | attach.
                </div>
            </a>

            @endforeach

        </div>
    </div>
</div>
@endsection 
