@extends('admin.layout.page')
@section('content')
	<form method="post">
		@csrf
		Name Category: <input type="text" name="name_category">
		<button type="submit">Add</button>
	</form>
	<a href="{{url('admin/category.html')}}">Click here to back</a>
@endsection