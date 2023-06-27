@extends('frontend.layouts.app')
@section('content')
					<div class="signup-form"><!--sign up form-->
						<h2>Update Information!</h2>
						<form method="post" enctype="multipart/form-data">
							@csrf
							<input type="text" name="name" placeholder="Name" value="{{Auth::user()->name}}">
							<input type="email" name="email" placeholder="Email Address" value="{{Auth::user()->email}}">
							<input type="password" name="password" placeholder="New password">
							<input type="text" name="phone" placeholder="Phone NO" value="{{Auth::user()->phone}}">
							<input type="file" placeholder="Avatar" name="avatar">
							<select class="form-control form-control-line" name="id_country">
                            @foreach($country as $key => $value)
        					<option value="{{$value->id}}" {{Auth::user()->id_country == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
                            @endforeach
                            </select>
							<button type="submit" class="btn btn-default">Update</button>
							
						</form>

 					</div><!--/sign up form-->
	
@endsection