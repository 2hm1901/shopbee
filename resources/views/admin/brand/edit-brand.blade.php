@extends('admin.layout.page')
@section('content')
	<form method="post">
		@csrf
		@foreach($data as $key => $value)
		Name brand: <input type="text" name="name_brand" value="{{$value->name}}">
		@endforeach
		<button type="submit">Edit</button>
		
	</form>
	
@endsection