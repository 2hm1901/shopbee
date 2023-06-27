@extends('admin.layout.page')
@section('content')
	<form method="post">
		@csrf
		Name Brand: <input type="text" name="name_brand">
		<button type="submit">Add</button>
	</form>
	<a href="{{url('admin/brand.html')}}">Click here to back</a>
@endsection