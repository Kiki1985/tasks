@extends('layout')
@section('content')
<p>Create a new task</p>

<form method="POST" action="/task">
@csrf
	<input type="text" name="title" placeholder="task" required><br><br>
	<input name="expected_finish_date" type="date" required><br><br>
	<textarea name="description" placeholder="description" required></textarea><br><br>
	
	<a href="/"><button id="create">Create</button></a>
</form><br>
@if(count($errors))
@include('errors')
@endif

<a href="/"><button>Tasks</button></a>

<script type="text/javascript">
$(document).ready(function(){
	$('#create').click(function() {
		expected_finish_date = new Date($('input[name ="expected_finish_date"]').val());
		$.get("date", function(date){
			current_date = new Date(date);
			if(expected_finish_date < current_date){
				alert("Invalid date");
			}
		});
	});
});

</script>

@endsection