<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.{
			margin: 0 auto;
			padding: 0px;
		}
		.main
		{
			height: 500px;
			width: 900px;
			background-color: white;
		}
		
	</style>
</head>
<body>
	<div class="main">
		<a href="{{route('index')}}"><button >Create New company</button></a>
		<h4>Companies List </h4>
		<form method="post" action="{{route('index_post')}}" enctype="multipart/form-data">
			<table border="3">
				<tr>
					<td>Sr No.</td>
					<td>Name</td>
					<td>Address</td>
					<td>Website</td>
					<td>Email</td>
					<td >Action</td>
				</tr>
				@if(@$data)
				@forelse($data as $d)
				<tr>
					<td>{{$d->id}}</td>
					<td>{{$d->name}}</td>
					<td>{{$d->address}}</td>
					<td>{{$d->web}}</td>
					<td>{{$d->mail}}</td>
					<td><a href="{{route('edit',['id'=>$d->id])}}">Edit</a>&nbsp&nbsp&nbsp<a href="{{route('delete',['id'=>$d->id])}}">Delete</a></td>
				</tr>
				@empty
				@endforelse
				@endif
			</table>
		</form>
	</div>
</body>
</html>