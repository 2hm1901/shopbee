@extends('frontend.layouts.app')
@section('content')
<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form method="post">
							@csrf
					@if($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach($errors->all() as $error)
									<li>{{$error}}</li>
								@endforeach
							</ul>
						</div>
					@endif
					@if(session('success'))
						<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
							<h4><i class="icon fa fa-check"></i>Thông báo</h4>
							{{session('success')}}
						</div>
					@endif
							<input type="email" name="email" placeholder="Email Address" />
							<input type="password" name="password" placeholder="Password" />
							<span>
								<input type="checkbox" name="remember_me" class="checkbox"> 
								Keep me signed in
							</span>
							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
					
				</div>
				</div>
			</div>
		</section>
@endsection