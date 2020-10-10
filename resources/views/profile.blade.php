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
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-1">
                            <a href="{{ url('home')}}" class="btn btn-outline-danger btn-block btn-sm"><h4>&lt</h4></a>
                        </div>
                        <div class="col p-2"><h3>EDIT PROFILE</h3></div>
                    </div>

                    @if(Session::has('success'))
                    <br><div class="alert alert-success">
                        {{session('success')}}
                    </div>
                    @endif

                    @if(Session::has('errors'))
                    <div class="alert alert-danger">
                        {{session('errors')}}
                    </div>
                    @endif

                </div>
                <div class="card-body">
                    <form method="post" action="{{url('profile')}} " enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>Avatar:</label><br>
                            <img id="avatar-btn" onclick="transferClick()" alt="click to add image" class="img-thumbnail rounded-circle w-25" src="{{session('user')['avatar_url'] ?? '/storage/user_avatars/blank_profile_pic.png' }}">
                            <input id="img-in" onchange="displayImg(this)" style="display: none;" type="file" name="avatar">
                        </div>
                        <div class="form-group">
                            <label>E-Mail Address</label>
                            <input type="email" name="email" value="{{session('user')['email'] }}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="first_name" value="{{session('user')['first_name'] }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="last_name" value="{{session('user')['last_name'] }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="date" name="birthday" value="{{session('user')['birthday'] }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select type="text" name="gender" class="form-control custom-select">
                                <option value="{{session('user')['gender'] }}">{{session('user')['gender'] }}</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div><button type="submit" class="btn btn-primary">SAVE CHANGES</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
