<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<center>
		<table>
			<form method="post" action="{{route('index_post')}}" enctype="multipart/form-data">
				{{csrf_field()}}
				<tr>
					<td>
						Name :- 
					</td>
					<td>
						<input type="text" name="name">
					</td>
				</tr>
				<tr>
					<td>
						Adress :- 
					</td>
					<td>
						<input type="text" name="address">
					</td>
				</tr>
				<tr>
					<td>
						Website :- 
					</td>
					<td>
						<input type="text" name="web">
					</td>
				</tr>
				<tr>
					<td>
						Email :- 
					</td>
					<td>
						<input type="text" name="mail">
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