<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<center>
		<table>
			<form method="post" action="{{route('index_post')}}" enctype="multipart/form-data">
				<input type="hidden" name="id" value="{{ ($data) ? $data[0]->id : '' }}">
				{{csrf_field()}}
				<tr>
					<td>
						Name :- 
					</td>
					<td>
						<input type="text" name="name" value="{{$data[0]->name}}">
					</td>
				</tr>
				<tr>
					<td>
						Adress :- 
					</td>
					<td>
						<input type="text" name="address" value="{{$data[0]->address}}">
					</td>
				</tr>
				<tr>
					<td>
						Website :- 
					</td>
					<td>
						<input type="text" name="web" value="{{$data[0]->web}}">
					</td>
				</tr>
				<tr>
					<td>
						Email :- 
					</td>
					<td>
						<input type="text" name="mail" value="{{$data[0]->mail}}">
					</td>
				</tr>
				<tr>
					<td><br>&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp
					<input type="submit" value="submit">
					</td>
				</tr>
			</form>
		</table>
	</center>
</body>
</html>