@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row"><div class="col"><h1>{{ $exam['name'] }}</h1></div></div>

            <form method="post">

            @foreach($exam['exam_questions'] as $question)

            <div class="card">
                <div class="card-body">
                    <div class="row"><div class="col"><strong>{{ $question['number']}}. </strong> {{$question['question']}} </div></div>

                    <div class="row">
                        <div class="col">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="{{$question['id']}}choice1" name="{{$question['id']}} " value="choice1">
                                <label class="custom-control-label" for="{{$question['id']}}choice1">{{$question['choice1']}}</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="{{$question['id']}}choice2" name="{{$question['id']}} " value="choice2">
                                <label class="custom-control-label" for="{{$question['id']}}choice2">{{$question['choice2']}}</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="{{$question['id']}}choice3" name="{{$question['id']}} " value="choice3">
                                <label class="custom-control-label" for="{{$question['id']}}choice3">{{$question['choice3']}}</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="{{$question['id']}}choice4" name="{{$question['id']}} " value="choice4">
                                <label class="custom-control-label" for="{{$question['id']}}choice4">{{$question['choice4']}}</label>
                            </div>

                        </div>
                        @if(isset($question['attachment']))
                        <div class="col"><img src="{{$question['attachment']}}" class="rounded" style="height: 144px; width: 144px"> </div>
                        @endif
                    </div>
                </div>
            </div>

            @endforeach

            </form>

            <div class="row"><div class="col"><button class="btn btn-primary">SUBMIT</button></div></div>
        </div>
    </div>
</div>
@endsection 
