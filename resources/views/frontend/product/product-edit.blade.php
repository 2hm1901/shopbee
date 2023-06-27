
@extends('frontend.layouts.app');
@section('content')
<script>
	$(document).ready(function(){
		$('#status').change(function(){
			if($(this).val() == 0){
				$('#sale').show();
			}
			else{
				$('#sale').hide();
			}
		})
	})
</script>
	<div class="signup-form">

						<h2>Edit Product!</h2>
						<form method="post" enctype="multipart/form-data">
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
							<h4><i class="icon fa fa-check"></i>Edit!</h4>
							{{session('success')}}
						</div>
					@endif
							@foreach($data as $key => $infor)
							<input type="text" name="name" placeholder="Name" value="{{$infor->name}}">
							<input type="text" name="price" placeholder="Price" value="{{$infor->price}}">

							<select class="form-control form-control-line" name="id_brand">
							<option value="">Select brand</option>
                            @foreach($brand as $key => $value)
        					<option value="{{$value->id}}" {{$infor->id_brand == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
                            @endforeach
                        	</select>

                            <select class="form-control form-control-line" name="id_category">
                            <option value="">Select category</option>
                            @foreach($category as $key => $value)
        					<option value="{{$value->id}}" {{$infor->id_category == $value->id ? 'selected' : ''}}>{{$value->name}}</option>
                            @endforeach
                            </select>

                            <select class="form-control form-control-line" name="status" id="status">
                            <option value="">Select</option>
        					<option value="0" {{$infor->status == 0 ? 'selected' : ''}}>Sales</option>
        					<option value="1" {{$infor->status == 1 ? 'selected' : ''}}>New</option>
                            </select>

                            @if($infor->sale > 0)
                            <input type="text" id="sale" style="display: none;" name="sale" placeholder="ex: 10%" value="{{$infor->sale}}">
                            @endif
                            <input type="text" id="sale" style="display: none;" name="sale" placeholder="ex: 10%">
                            <input type="text" name="company" placeholder="Company profile" value="{{$infor->company}}">
							<input type="file" name="images[]" multiple>
							<?php  $getArrImage = json_decode($infor['images'], true)?>
							<ul style="display: flex;">
								@foreach($getArrImage as $key => $image)
								<li style="margin-right: 10px;">
									<img src="{{url('upload/product/hinh50_'.$image)}}">
									<input type="checkbox" name="delete_image[]" value="{{$image}}">
								</li>
								@endforeach
							</ul>
							<textarea rows="4" name="detail" placeholder="Detail">{{$infor->detail}}</textarea>
							<button type="submit" class="btn btn-default">Edit</button>
							@endforeach
						</form>

 					</div>
@endsection