<script type="text/javascript">

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
						<div class="col"><h2>NEW MATERIAL</h2></div>
					</div>
				</div>
				<div class="card-body">
					<form method="post" action="{{url('materials')}} ">
						@csrf
						<input type="hidden" name="topic_id" value="{{$topic_id}} ">
						<div class="form-group">
							<label>File</label><br>
							<input id="img-in" type="file" class="form-control" name="attachment">
						</div>
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" class="form-control">
						</div>
						<div>
							<button type="submit" class="btn btn-primary">CREATE</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection 
