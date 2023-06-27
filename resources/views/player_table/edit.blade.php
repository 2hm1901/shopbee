<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<h1>Edit</h1>
	<form method="post">
		@if ($errors -> any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors -> all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
		@csrf
		@foreach($data as $key => $value)
		Name: <input type="text" name="name" value="{{$value->name_player}}">
		Age: <input type="text" name="age" value="{{$value->age_player}}">
		Salary: <input type="text" name="salary" value="{{$value->salary}}">
		Position <input type="text" name="position" value="{{$value->position}}">
		@endforeach
		<button type="submit">Edit</button>
	</form>
</body>
</html>