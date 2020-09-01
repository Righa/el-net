<script type="text/javascript">
	function transferClick() {
        document.querySelector('#img-in').click();
    }
    function displayImg(e) {
        if (e.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                document.querySelector('#avatar-btn').setAttribute('src', e.target.result);
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
                        <div class="col-md-2">
                            <a href="{{ url('home')}}" class="btn btn-outline-danger btn-block btn-sm"><h4>&lt</h4></a>
                        </div>
						<div class="col"><h2>NEW COURSE</h2></div>
					</div>
				</div>
				<div class="card-body">
					<form method="post" action="{{url('courses')}} ">
						@csrf
						<div class="form-group">
							<label>Avatar:</label><br>
							<img id="avatar-btn" onclick="transferClick()" alt="click to add image" class="img-thumbnail" style="min-height: 222px; min-width: 222px; max-width: 444px" src="">
							<input id="img-in" onchange="displayImg(this)" style="display: none;" type="file" name="avatar">
						</div>
						<div class="form-group">
							<label>Subject</label>
							<select type="text" name="correct" class="form-control">

								@foreach($res['subjects'] as $subject)

								<option value="{{$subject['id']}} ">{{$subject['name']}} </option>

								@endforeach

							</select>
						</div>
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" class="form-control">
						</div>
						<div class="form-group">
							<label>Description</label>
							<textarea type="text" name="description" class="form-control"></textarea>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control">
						</div>
						<div><button type="submit" class="btn btn-primary">CREATE</button></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection 
