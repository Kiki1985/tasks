<ul style ="list-style: none; color:red">
	@foreach($errors->all() as $error)
		<li>{{$error}}</li>
	@endforeach
</ul>