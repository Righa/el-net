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
</script>
@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-md-2"></div>
					</div>
				</div>
				<div class="card-body">
					<form method="post" action="{{url('courses')}} ">
						@csrf
						<div class="form-group">
							<label>Question Number</label>
							<input type="text" name="number" class="form-control">
						</div>
						<div class="form-group">
							<label>Add Attachment:</label><br>
							<img id="car-img-btn" onclick="transferClick()" alt="click to add image" class="img-thumbnail" style="min-height: 222px; min-width: 222px; max-width: 444px" src="">
							<input id="img-in" onchange="displayImg(this)" style="display: none;" type="file" name="attachment">
						</div>
						<div class="form-group">
							<label>Question</label>
							<textarea type="text" rows="4" name="question" class="form-control"></textarea>
						</div>
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
						<div class="form-group">
							<label>Points</label>
							<input type="number" name="marks" class="form-control">
						</div>
						<div class="form-group">
							<label>Correct answer</label>
							<select type="text" name="correct" class="form-control">
								<option value="choice1">Choice 1</option>
								<option value="choice2">Choice 2</option>
								<option value="choice3">Choice 3</option>
								<option value="choice4">Choice 4</option>
							</select>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col"><button type="submit" class="btn btn-primary">SAVE</button></div>
								<div class="col"><button type="submit" class="btn btn-primary">FINISH</button></div></div>
							</div>
							
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection 
