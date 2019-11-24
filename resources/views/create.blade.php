@extends('layout')
@section('content')
<p>Create a new task</p>


<form method="POST" action="/task">
@csrf
	<input type="text" name="title" placeholder="task" required><br><br>
	<textarea name="description" placeholder="description" required></textarea><br><br>
	<input name="expected_finish_date" type="date" required><br><br>
	<a href="/"><button name="btn">Create</button></a>
</form><br>
@if(count($errors))
@include('errors')
@endif



<a href="/"><button>Tasks</button></a>

<script type="text/javascript">
var xhttp;
xhttp = new XMLHttpRequest;
var btn = document.getElementsByName("btn")[0];
btn.addEventListener('click', ajaxDate);
xhttp.onreadystatechange = function(){
	if(xhttp.readyState === 4){
		
	}
}
xhttp.open("GET", "date", true);
xhttp.send();


function ajaxDate(){
	var expected_finish_date = new Date(document.getElementsByName("expected_finish_date")[0].value);
	var current_date = new Date(xhttp.responseText);
	if(expected_finish_date < current_date)
		alert('Invalid Date');
	else alert('Task is successfully created.');

}


</script>

@endsection