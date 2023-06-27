@extends('admin.layout.page')
@section('content')
	<form method="post">
		@csrf
		@foreach($data as $key => $value)
		Name Country: <input type="text" name="name_country" value="{{$value->name}}">
		@endforeach
		<button type="submit">Edit</button>
		
	</form>
	
@endsection