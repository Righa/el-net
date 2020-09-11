@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row justify-contents-center">
		<div class="col-md-2">
			<!-- Nav pills -->
			<ul class="nav nav-pills flex-column">
				<li>
					<h3>DASHBOARD</h3>
				</li>
			  <li class="nav-item">
			    <a class="nav-link active" data-toggle="pill" href="#overview">Overview</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" data-toggle="pill" href="#menu1">Users</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" data-toggle="pill" href="#menu2">Subjects</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" data-toggle="pill" href="#menu3">Courses</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" data-toggle="pill" href="#menu4">Forums</a>
			  </li>
			</ul>
		</div>
			<!-- Tab panes -->
		<div class="col-md-10 tab-content">
			  <div class="tab-pane active" id="overview">


	                @if(Session::has('success'))

	                <div class="alert alert-success">{{session('success')}} </div>

	                @endif

	                @if(Session::has('errors'))

	                <div class="alert alert-danger">{{session('errors')}} </div>

	                @endif


			  	<div class="card-columns">
			  		
				  	<div class="card alert-primary">
				  		<div class="card-body text-center">
				  			<h1 class="display-4">{{count($res['users'])}}</h1>
				  		</div>
				  		<div class="card-footer">
				  			<h5 class="display-5">Total Users</h5>
				  		</div>
				  	</div>
			  		
				  	<div class="card alert-primary">
				  		<div class="card-body text-center">
				  			<h1 class="display-4">{{count($res['courses'])}}</h1>
				  		</div>
				  		<div class="card-footer">
				  			<h5 class="display-5">Courses</h5>
				  		</div>
				  	</div>
			  		
				  	<div class="card alert-primary">
				  		<div class="card-body text-center">
				  			<h1 class="display-4">{{$res['activity']['online']}} </h1>
				  		</div>
				  		<div class="card-footer">
				  			<h5 class="display-5">Online Users</h5>
				  		</div>
				  	</div>
			  		
				  	<div class="card alert-primary">
				  		<div class="card-body text-center">
				  			<h1 class="display-4">{{count($res['exams'])}}</h1>
				  		</div>
				  		<div class="card-footer">
				  			<h5 class="display-5">Assessments</h5>
				  		</div>
				  	</div>
			  		
				  	<div class="card alert-primary">
				  		<div class="card-body text-center">
				  			<h1 class="display-4">{{$res['activity']['day0']}}</h1>
				  		</div>
				  		<div class="card-footer">
				  			<h5 class="display-5">Logins Today</h5>
				  		</div>
				  	</div>
			  		
				  	<div class="card alert-primary">
				  		<div class="card-body text-center">
				  			<h1 class="display-4">{{count($res['forums'])}}</h1>
				  		</div>
				  		<div class="card-footer">
				  			<h5 class="display-5">Forums</h5>
				  		</div>
				  	</div>
			  	</div>
			  	
			  	<div class="card alert-secondary">
			  		<div class="card-header">
			  			<h3>Usage statistics</h3>
			  		</div>
					<div class="card-body">
						<div class="row p-3 ">
					  		<div class="col-md-1">Today <br> ...</div>
					  		<div class="col-md-{{ $res['activity']['day0'] }} bg-primary"></div>
					  		<div class="col display-4"><h4>{{ $res['activity']['day0'] }}</h4></div>
					  	</div>
					  	<div class="row p-3 ">
					  		<div class="col-md-1">1 day ago</div>
					  		<div class="col-md-{{ $res['activity']['day1'] }} bg-primary"></div>
					  		<div class="col display-4"><h4>{{ $res['activity']['day1'] }}</h4></div>
					  	</div>
					  	<div class="row p-3 ">
					  		<div class="col-md-1">2 days ago</div>
					  		<div class="col-md-{{ $res['activity']['day2'] }} bg-primary"></div>
					  		<div class="col display-4"><h4>{{ $res['activity']['day2'] }}</h4></div>
					  	</div>
					  	<div class="row p-3 ">
					  		<div class="col-md-1">3 days ago</div>
					  		<div class="col-md-{{ $res['activity']['day3'] }} bg-primary"></div>
					  		<div class="col display-4"><h4>{{ $res['activity']['day3'] }}</h4></div>
					  	</div>
					  	<div class="row p-3 ">
					  		<div class="col-md-1">4 days ago</div>
					  		<div class="col-md-{{ $res['activity']['day4'] }} bg-primary"></div>
					  		<div class="col display-4"><h4>{{ $res['activity']['day4'] }}</h4></div>
					  	</div>
					  	<div class="row p-3 ">
					  		<div class="col-md-1">5 days ago</div>
					  		<div class="col-md-{{ $res['activity']['day5'] }} bg-primary"></div>
					  		<div class="col display-4"><h4>{{ $res['activity']['day5'] }}</h4></div>
					  	</div>
					  	<div class="row p-3 ">
					  		<div class="col-md-1">6 days ago</div>
					  		<div class="col-md-{{ $res['activity']['day6'] }} bg-primary"></div>
					  		<div class="col display-4"><h4>{{ $res['activity']['day6'] }}</h4></div>
					  	</div>
			  		</div>
			  		<div class="card-footer px-3">
		  				<div class="row">
							<div class="col-md-1 text-right">0</div>
							<div class="col text-right"><strong>1</strong></div>
							<div class="col text-right"><strong>2</strong></div>
							<div class="col text-right"><strong>3</strong></div>
							<div class="col text-right"><strong>4</strong></div>
							<div class="col text-right"><strong>5</strong></div>
							<div class="col text-right"><strong>6</strong></div>
							<div class="col text-right"><strong>7</strong></div>
							<div class="col text-right"><strong>8</strong></div>
							<div class="col text-right"><strong>9</strong></div>
							<div class="col text-right"><strong>10</strong></div>
							<div class="col text-right"></div>
						</div><br>
						<div class="row">
							<div class="col"></div>
							<div class="col-md-3">No. of users</div>
						</div>
			  		</div>
			  	</div>

			  </div>







			  <div class="tab-pane fade" id="menu1">
			  	<div class="card">
			  		<div class="card-header"><h3>Users</h3></div>
			  		<div class="card-body">
			  			<table class="table table-striped table-hover">
			  				
			  				<thead>
			  					<tr>
			  						<th>ID</th>
			  						<th>NAME</th>
			  						<th>EMAIL</th>
			  						<th>ROLE</th>
			  						<th colspan="2">ACTIONS</th>
			  					</tr>
			  				</thead>

			  				<tbody>

			  					@foreach($res['users'] as $u)
			  					
			  					<tr>
			  						<td>{{$u['id']}}</td>
			  						<td>{{$u['first_name']}} {{$u['last_name']}}</td>
			  						<td><a href="mailto:{{$u['email']}}">{{$u['email']}}</a></td>
			  						<td>{{$u['role']}}</td>
			  						@if($u['role'] != 'admin')
			  						<td>
			  							<form method="post" action="{{url('users/'.$u['id'])}} ">
			  								@csrf
			  								@method('put')
			  								<input type="hidden" name="role" value="admin">
			  								<button type="submit" class="btn btn-warning btn-block">MAKE ADMIN</button>
			  							</form>
			  						</td>
			  						@else
			  						<td>
			  							<form method="post" action="{{url('users/'.$u['id'])}} ">
			  								@csrf
			  								@method('put')
			  								<input type="hidden" name="role" value="learner">
			  								<button type="submit" class="btn btn-warning btn-block">DEMOTE</button>
			  							</form>
			  						</td>
			  						@endif
			  						<td>
			  							<form method="post" action="{{url('users/'.$u['id'])}}">
			  								@csrf
			  								@method('delete')
			  								<button type="submit" class="btn btn-danger btn-block">DELETE</button>
			  							</form>
			  						</td>
			  					</tr>

			  					@endforeach

			  				</tbody>
			  			</table>
			  		</div>
			  	</div>
			  </div>





			  <div class="tab-pane fade" id="menu2">
			  	<div class="card">
			  		<div class="card-header">
			  			<div class="row">
			  				<div class="col"><h3>Subjects</h3></div>
			  				<div class="col-md-2">
			  					<button class="btn btn-primary" data-toggle="collapse" data-target="#new-subject">CREATE NEW SUBJECT</button>
			  				</div>
			  			</div>
			  			
			  			<div id="new-subject" class="collapse">
				  			<form method="post" action="{{url('subjects')}} ">
				  				@csrf
				  				<div class="form-group">
				  					<label><strong>Name</strong></label>
				  					<input class="form-control" type="text" name="name">
				  				</div>
				  				<div class="form-group">
				  					<label><strong>Description</strong></label>
				  					<textarea class="form-control" name="description"></textarea>
				  				</div>
				  				<div><button type="submit" class="btn btn-primary">CREATE</button></div>
				  			</form>
			  			</div>
			  		</div>
			  		<div class="card-body">
			  			<table class="table table-striped table-hover">
			  				
			  				<thead>
			  					<tr>
			  						<th>NAME</th>
			  						<th>DESCRIPTION</th>
			  						<th colspan="2">ACTIONS</th>
			  					</tr>
			  				</thead>

			  				<tbody>

			  					@foreach($res['subjects'] as $s)
			  					
			  					<tr>
			  						<td>{{$s['name']}}</td>
			  						<td>{{$s['description']}}</td>
			  						<td><button class="btn btn-primary btn-block" data-toggle="collapse" data-target="#edit-subject-{{$s['id']}}">EDIT</button></td>
			  						<td>
			  							<form method="post" action="{{url('subjects/'.$s['id'])}}">
			  								@csrf
			  								@method('delete')
			  								<button class="btn btn-danger btn-block">DELETE</button>
			  							</form></td>
			  					</tr>

			  					<tr id="edit-subject-{{$s['id']}}" class="collapse">
			  						<td colspan="4">
				  						<form method="post" action="{{url('subjects/'.$s['id'])}}">
				  							@csrf
				  							@method('put')
			  								<div class="form-group">
			  									<label><strong>New Name</strong></label>
			  									<input class="form-control" type="text" name="name" value="{{$s['name']}}">
			  								</div>
			  								<div class="form-group">
			  									<label><strong>New Description</strong></label>
			  									<textarea class="form-control" name="description">{{$s['description']}}</textarea>
			  								</div>
			  								<button type="submit" class="btn btn-primary btn-block">UPDATE</button>
			  							</form>
			  						</td>
			  					</tr>

			  					@endforeach

			  				</tbody>
			  			</table>
			  		</div>
			  	</div>
			  </div>






			  <div class="tab-pane fade" id="menu3">
			  	<div class="card">
			  		<div class="card-header"><h3>Courses</h3></div>
			  		<div class="card-body">
			  			<table class="table table-striped table-hover">
			  				
			  				<thead>
			  					<tr>
			  						<th>NAME</th>
			  						<th>TEACHER</th>
			  						<th>STUDENTS</th>
			  						<th colspan="2">ACTIONS</th>
			  					</tr>
			  				</thead>

			  				<tbody>

			  					@foreach($res['courses'] as $c)
			  					
			  					<tr>
			  						<td>{{$c['name']}}</td>
			  						<td>{{$c['user']['first_name']}} {{$c['user']['last_name']}}</td>
			  						<td>{{count($c['students'])}}</td>
			  						<td><a href="mailto:{{$c['user']['email']}}" class="btn btn-primary btn-block">EMAIL TEACHER</a></td>
			  						<td>
			                            <form method="post" action="{{url('courses/'.$c['id'])}} ">
			                                @csrf
			                                @method('delete')

			                                <button type="submit" class="btn  btn-danger">DELETE</button>
			                            </form>
			  						</td>
			  					</tr>

			  					@endforeach

			  				</tbody>
			  			</table>
			  		</div>
			  	</div>
			  </div>






			  <div class="tab-pane fade" id="menu4">
			  	<div class="card">
			  		<div class="card-header"><h3>Forums</h3></div>
			  		<div class="card-body">
			  			<table class="table table-striped table-hover">
			  				
			  				<thead>
			  					<tr>
			  						<th>USER</th>
			  						<th>ANSWERS</th>
			  						<th>STATUS</th>
			  						<th colspan="2">ACTIONS</th>
			  					</tr>
			  				</thead>

			  				<tbody>

			  					@foreach($res['forums'] as $f)
			  					
			  					<tr>
			  						<td>{{$f['user']['first_name']}} {{$f['user']['last_name']}}</td>
			  						<td>{{count($f['forum_answers'])}}</td>
			  						@if($f['open'])
			  						<td>open</td>
			  						@else
			  						<td>closed</td>
			  						@endif
			  						<td><a href="mailto:{{$f['user']['email']}}" class="btn btn-primary btn-block">EMAIL USER</a></td>
			  						<td>
			                            <form method="post" action="{{url('forums/'.$f['id'])}} ">
			                                @csrf
			                                @method('delete')

			                                <button type="submit" class="btn btn-block btn-danger">DELETE</button>
			                            </form>
			  						</td>
			  					</tr>

			  					@endforeach

			  				</tbody>
			  			</table>
			  		</div>
			  	</div>
			  </div>
		</div>
	</div>
</div>


@endsection 
