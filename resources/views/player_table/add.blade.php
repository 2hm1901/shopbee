<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<h1>Add</h1>
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
		Name: <input type="text" name="name" value="{{old('name')}}">
		Age: <input type="text" name="age">
		Salary: <input type="text" name="salary">
		Position <input type="text" name="position">
		<button type="submit">Add</button>
	</form>
</body>
</html>