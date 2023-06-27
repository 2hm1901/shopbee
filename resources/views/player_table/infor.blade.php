<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<table>
		<thead>
			<tr>
				<td>ID</td>
				<td>Name</td>
				<td>Age</td>
				<td>Salary</td>
				<td>Position</td>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $key => $value)
			<tr>
				<td>{{$value->id}}</td>
				<td>{{$value->name_player}}</td>
				<td>{{$value->age_player}}</td>
				<td>{{$value->salary}}</td>
				<td>{{$value->position}}</td>
				<td><a href="{{url('edit/'.$value->id)}}">Edit</a></td>
				<td><a href="{{url('delete/'.$value->id)}}">Delete</a></td>
			</tr>
			@endforeach
		</tbody>

	</table>
	<a href="add">Add</a>
</body>
</html>