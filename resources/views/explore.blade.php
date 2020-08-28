@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row"><div class="col"><h1>Discover courses;</h1></div></div>

            @foreach($data['courses'] as $course)

            <a href="courses/{{ $course['id'] }}" class="card">
                <div class="card-header">{{ $course['name'] }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3"><strong>ikon | </strong></div>

                        <div class="col">
                            {{ $course['description'] }} 
                        </div>
                    </div>
                </div>
            </a>

            @endforeach
        </div>
    </div>
</div>
@endsection 
