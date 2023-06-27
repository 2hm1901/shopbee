@extends('frontend.layouts.app')
@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="table-responsive cart_info">
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
							<h4><i class="icon fa fa-check"></i>Edit!</h4>
							{{session('success')}}
						</div>
					@endif
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td>ID</td>
							<td>Name</td>
							<td>Image</td>
							<td>Price</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>
						@if(count($data)==0)
						<tr><td>You don't have any product</td></tr>
						@else
						@foreach($data as $key => $value)
						<tr>
							<td>{{$value['id']}}</td>
							<td>{{$value['name']}}</td>

							<?php  $getArrImage = json_decode($value['images'], true)?>
							<td><img src="{{url('/upload/product/hinh50_'.$getArrImage[0])}}"></td>

							@if($value['status'] == 0)
									<td>{{$value['price'] * (100 - $value['sale']) / 100}}</td>
							@else
									<td>{{$value['price']}}</td>
							@endif
							<td>
								<a href="{{url('account/product/edit/'.$value['id'])}}">Edit</a>
                                <a href="{{url('account/product/delete/'.$value['id'])}}">Delete</a>
							</td>
						</tr>
						@endforeach
						@endif
					</tbody>
				</table>
				<a class="btn btn-primary" href="{{url('account/product/add')}}">Add</a>
			</div>
		</div>
	</section> <!--/#cart_items-->
@endsection