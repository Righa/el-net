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
			  	<div class="card-columns">
			  		
				  	<div class="card alert-primary">
				  		<div class="card-body text-center">
				  			<h1 class="display-1">12</h1>
				  		</div>
				  		<div class="card-footer">
				  			<h5 class="display-5">Total Users</h5>
				  		</div>
				  	</div>
			  		
				  	<div class="card alert-primary">
				  		<div class="card-body text-center">
				  			<h1 class="display-1">12</h1>
				  		</div>
				  		<div class="card-footer">
				  			<h5 class="display-5">Courses</h5>
				  		</div>
				  	</div>
			  		
				  	<div class="card alert-primary">
				  		<div class="card-body text-center">
				  			<h1 class="display-1">12</h1>
				  		</div>
				  		<div class="card-footer">
				  			<h5 class="display-5">Online Users</h5>
				  		</div>
				  	</div>
			  		
				  	<div class="card alert-primary">
				  		<div class="card-body text-center">
				  			<h1 class="display-1">12</h1>
				  		</div>
				  		<div class="card-footer">
				  			<h5 class="display-5">Assessments</h5>
				  		</div>
				  	</div>
			  		
				  	<div class="card alert-primary">
				  		<div class="card-body text-center">
				  			<h1 class="display-1">12</h1>
				  		</div>
				  		<div class="card-footer">
				  			<h5 class="display-5">Users Today</h5>
				  		</div>
				  	</div>
			  		
				  	<div class="card alert-primary">
				  		<div class="card-body text-center">
				  			<h1 class="display-1">12</h1>
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
					  		<div class="col-md-1">1 day ago</div>
					  		<div class="col-md-1 bg-primary"></div>
					  		<div class="col display-4"><h4>1</h4></div>
					  	</div>
					  	<div class="row p-3 ">
					  		<div class="col-md-1">2 days ago</div>
					  		<div class="col-md-8 bg-primary"></div>
					  		<div class="col display-4"><h4>8</h4></div>
					  	</div>
					  	<div class="row p-3 ">
					  		<div class="col-md-1">3 days ago</div>
					  		<div class="col-md-6 bg-primary"></div>
					  		<div class="col display-4"><h4>6</h4></div>
					  	</div>
					  	<div class="row p-3 ">
					  		<div class="col-md-1">4 days ago</div>
					  		<div class="col-md-0 bg-primary"></div>
					  		<div class="col display-4"><h4>0</h4></div>
					  	</div>
					  	<div class="row p-3 ">
					  		<div class="col-md-1">5 days ago</div>
					  		<div class="col-md-2 bg-primary"></div>
					  		<div class="col display-4"><h4>2</h4></div>
					  	</div>
					  	<div class="row p-3 ">
					  		<div class="col-md-1">6 days ago</div>
					  		<div class="col-md-5 bg-primary"></div>
					  		<div class="col display-4"><h4>5</h4></div>
					  	</div>
						<div class="row p-3 ">
					  		<div class="col-md-1">7 days ago</div>
					  		<div class="col-md-10 bg-primary"></div>
					  		<div class="col display-4"><h4>10</h4></div>
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
			  		<div class="card-body">content</div>
			  	</div>
			  </div>





			  <div class="tab-pane fade" id="menu2">
			  	<div class="card">
			  		<div class="card-header"><h3>Subjects</h3></div>
			  		<div class="card-body">content</div>
			  	</div>
			  </div>






			  <div class="tab-pane fade" id="menu3">
			  	<div class="card">
			  		<div class="card-header"><h3>Courses</h3></div>
			  		<div class="card-body">content</div>
			  	</div>
			  </div>






			  <div class="tab-pane fade" id="menu4">
			  	<div class="card">
			  		<div class="card-header"><h3>Forums</h3></div>
			  		<div class="card-body">content</div>
			  	</div>
			  </div>
		</div>
	</div>
</div>


@endsection 
