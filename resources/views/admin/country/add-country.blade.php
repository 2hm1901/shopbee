@extends('admin.layout.page')
@section('content')
	<form method="post">
		@csrf
		Name Country: <input type="text" name="name_country">
		<button type="submit">Add</button>
	</form>
	<a href="{{url('admin/country.html')}}">Click here to back</a>
@endsection