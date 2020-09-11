<script type="text/javascript">

    function transferClick() {
        document.querySelector('#img-in').click();
    }

    function displayImg(e) {
        if (e.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                document.querySelector('#car-img-btn').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(e.files[0]);
        }
    }

    function startTimer() {

        var countDownDate = <?php echo strtotime(session('exam')['lapse']) ?> * 1000;
        var now = <?php echo time() ?> * 1000;

        // Update the count down every 1 second
        var x = setInterval(function() {
            now = now + 1000;
            // Find the distance between now an the count down date
            var distance = countDownDate - now;
            // Time calculations for days, hours, minutes and seconds
            //var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            // Output the result in an element with id="demo"
            document.getElementById("timer-clock").innerHTML = hours + "h " +
            minutes + "m " + seconds + "s ";
            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("timer-clock").innerHTML = "EXPIRED";
                document.getElementById("paper-form").submit();
            }
    
        }, 1000);

    }

</script>
@extends('layouts.app')

@section('content')

@if(Session::has('exam'))

        <script type="text/javascript">startTimer()</script>

        <div class="card fixed-top ml-4" style="margin-top: 111px;max-width: 333px">
            <div class="card-header"><h4>Question Navigation</h4></div>
            <div class="card-body d-flex flex-wrap align-content-start">

                @foreach($exam['exam_questions'] as $question)

                <div class="card m-1">
                    <div class="card-body"><a href="#question-{{$question['id']}}">{{$question['number']}}</a></div>
                </div>

                @endforeach







            </div>
            <div id="timer-card" class="card-footer alert-warning">Time Left: <h1 id="timer-clock"></h1></div>
        </div>

@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        
                        <div class="col-md-1">
                            <a href="{{ url('courses/'.$exam['course_id'])}}" class="btn btn-outline-danger btn-block btn-lg"><h1>&lt</h1></a>
                        </div>

                        <div class="col"><h1>{{ $exam['name'] }}</h1><p>Duration: {{$exam['duration']}} Minutes</p>
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

                    @if($exam['course']['user']['id'] != session('user')['id'])

                    <form id="paper-form" method="post">

                    @endif

                    @foreach($exam['exam_questions'] as $question)
                    <section id="question-{{$question['id']}}">

                        <div class="card mb-4 p-2">
                            <div class="card-body">
                                <div class="row"><div class="col"><h4><strong class="fs-3">{{ $question['number']}}. </strong> {{$question['question']}} </h4></div></div>

                                <div class="row p-4">
                                    <div class="col">
                                        <div class="custom-control p-2 custom-radio">
                                            <input type="radio" class="custom-control-input" id="{{$question['id']}}choice1" name="{{$question['id']}} " value="choice1">
                                            <label class="custom-control-label" for="{{$question['id']}}choice1">{{$question['choice1']}}</label>
                                        </div>
                                        <div class="custom-control p-2 custom-radio">
                                            <input type="radio" class="custom-control-input" id="{{$question['id']}}choice2" name="{{$question['id']}} " value="choice2">
                                            <label class="custom-control-label" for="{{$question['id']}}choice2">{{$question['choice2']}}</label>
                                        </div>
                                        <div class="custom-control p-2 custom-radio">
                                            <input type="radio" class="custom-control-input" id="{{$question['id']}}choice3" name="{{$question['id']}} " value="choice3">
                                            <label class="custom-control-label" for="{{$question['id']}}choice3">{{$question['choice3']}}</label>
                                        </div>
                                        <div class="custom-control p-2 custom-radio">
                                            <input type="radio" class="custom-control-input" id="{{$question['id']}}choice4" name="{{$question['id']}} " value="choice4">
                                            <label class="custom-control-label" for="{{$question['id']}}choice4">{{$question['choice4']}}</label>
                                        </div>

                                    </div>
                                    @if(isset($question['attachment']))
                                    <div class="col"><img src="{{$question['attachment']}}" class="img-thumbnail w-100" > </div>
                                    @endif
                                </div>

                                @if($exam['course']['user']['id'] == session('user')['id'])

                                <div class="row">
                                    <div class="col"></div>
                                    <div class="col-sm-2">
                                        <button data-toggle="collapse" data-target="#edit-question-{{$question['id']}}" class="btn btn-block btn-primary">EDIT QUESTION</button>
                                    </div>
                                    <div class="col-sm-3">
                                        <form method="post" action="{{url('exam_questions/'.$question['id'])}}">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="exam_id" value="{{$exam['id']}}">
                                            <button type="submit" class="btn btn-block btn-outline-danger">DELETE QUESTION</button>
                                        </form>
                                        
                                    </div>
                                </div>

                                <!-- edit form -->

                                <div id="edit-question-{{$question['id']}}" class="card mt-1 collapse">
                                    <div class="card-header">
                                        <h3>Edit Question;</h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="{{url('exam_questions/'.$question['id'])}} " enctype="multipart/form-data">
                                            @csrf
                                            @method('put')

                                            <input type="hidden" name="exam_id" value="{{$exam['id']}}">

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>Question Number</label>
                                                        <input type="text" name="number" class="form-control" value="{{$question['number']}}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Question</label>
                                                        <textarea type="text" rows="9" name="question" class="form-control">{{$question['question']}}</textarea>
                                                    </div>
                                                            
                                                    <div class="form-group">
                                                        <label>Points</label>
                                                        <input type="number" name="marks" class="form-control" value="{{$question['marks']}}">
                                                    </div>

                                                </div>
                                                <div class="col">    
                                                    <div class="form-group">
                                                        <label>Choice 1</label>
                                                        <textarea type="text" rows="2" name="choice1" class="form-control">{{$question['choice1']}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Choice 2</label>
                                                        <textarea type="text" rows="2" name="choice2" class="form-control">{{$question['choice2']}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Choice 3</label>
                                                        <textarea type="text" rows="2" name="choice3" class="form-control">{{$question['choice3']}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Choice 4</label>
                                                        <textarea type="text" rows="2" name="choice4" class="form-control">{{$question['choice4']}}</textarea>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col"></div>
                                                <div class="col-sm-2"><button type="submit" class="btn btn-primary btn-block">UPDATE</button></div>
                                                
                                            </div>

                                        </form>
                                    </div>
                                </div>

                                

                                <!-- end edit form -->

                                @endif

                            </div>
                        </div>

                        @endforeach

                        @if(count($exam['exam_questions']) == 0)

                        <div class="rounded p-3 mb-3 text-secondary bg-light">No questions</div>

                        @endif

                        @if($exam['course']['user']['id'] == session('user')['id'])

                        <div class="row">
                            <div class="col"></div>
                            <div class="col-sm-2"><button data-toggle="collapse" data-target="#new-course-card" class="btn btn-primary btn-block">+ ADD QUESTION</button></div>
                        </div>

                        @else

                        <div class="row"><div class="col"><button class="btn btn-primary">SUBMIT</button></div></div>

                    </section>

                    </form>

                    @endif
                    
                </div>

            </div>

            <div id="new-course-card" class="card mt-5 collapse">
                <div class="card-header">
                    <h3>NEW QUESTION</h3>
                </div>

                <div class="card-body">
                    <form method="post" action="{{url('exam_questions')}} " enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="exam_id" value="{{$exam['id']}}">

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Question Number</label>
                                    <input type="text" name="number" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Question</label>
                                    <textarea type="text" rows="5" name="question" class="form-control"></textarea>
                                </div>
                                        
                                <div class="form-group">
                                    <label>Points</label>
                                    <input type="number" name="marks" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Correct answer</label>
                                    <select type="text" name="correct" class="form-control custom-select">
                                        <option value="choice1">Choice 1</option>
                                        <option value="choice2">Choice 2</option>
                                        <option value="choice3">Choice 3</option>
                                        <option value="choice4">Choice 4</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col">    
                                <div class="form-group">
                                    <label>Choice 1</label>
                                    <textarea type="text" rows="2" name="choice1" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Choice 2</label>
                                    <textarea type="text" rows="2" name="choice2" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Choice 3</label>
                                    <textarea type="text" rows="2" name="choice3" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Choice 4</label>
                                    <textarea type="text" rows="2" name="choice4" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="col">
                                        
                                <div class="form-group">
                                    <label>Add Attachment:</label><br>
                                    <img id="car-img-btn" onclick="transferClick()" alt="click to add image" class="img-thumbnail" style="max-height: 333px; width: 100%;" src="">
                                    <input id="img-in" onchange="displayImg(this)" style="display: none;" type="file" name="attachment">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col"></div>
                            <div class="col-sm-2"><button type="submit" class="btn btn-primary btn-block">SAVE</button></div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
