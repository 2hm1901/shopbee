@extends('frontend.layouts.app')
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
<div class="signup-form"><!--sign up form-->
						<h2>Create Product!</h2>
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
							<h4><i class="icon fa fa-check"></i>Success!</h4>
							{{session('success')}}
						</div>
					@endif
							<input type="text" name="name" placeholder="Name">
							<input type="text" name="price" placeholder="Price">
							<select class="form-control form-control-line" name="id_brand">
							<option value="">Select brand</option>
                            @foreach($brand as $key => $value)
        					<option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        	</select>
                            <select class="form-control form-control-line" name="id_category">
                            	<option value="">Select category</option>
                            @foreach($category as $key => $value)
        					<option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                            </select>
                            <select class="form-control form-control-line" name="status" id="status">
                            <option value="">Select</option>
        					<option value="0">Sales</option>
        					<option value="1">New</option>
                            </select>
                            <input type="text" id="sale" style="display: none;" name="sale" placeholder="ex: 10%">
                            <input type="text" name="company" placeholder="Company profile">
							<input type="file" name="images[]" multiple>
							<textarea rows="4" name="detail" placeholder="Detail"></textarea>
							<button type="submit" class="btn btn-default">Create</button>
							
						</form>

 					</div><!--/sign up form-->
@endsection