@extends('layout')
@section('content')
<script type="text/javascript">
$(document).ready(function(){
	$('#show').click(function() {
		$('#show_div').slideToggle("slow");
	});
});
</script>

<div><button id="slideToggle"><b>Create a new task </b></button></div>

<div id="slideToggle_div" style="display: none">
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
</div> <!-- end div id="slideToggle_div" -->

@if($tasks->isEmpty())
<p><i>No tasks yet</i></p>
@else

<table align="center">
	<tr>
		<th>Task</th>
		<th>Expected finish date</th>
	</tr>
@foreach($tasks as $task)
	<tr>
		<td><a href="tasks/{{$task->id}}">{{$task->title}}</a></td>
		<td><span id="span_{{$task->id}}">{{--{{\Carbon\Carbon::parse($task->expected_finish_date)->toFormattedDateString() --}}</span></td>
	</tr>
@endforeach
</table><br>

	
@endif

<script type="text/javascript">
$(document).ready(function(){
	jQuery.getJSON("tasks", function(data) {
		$.each(data, function(key, value){
			const months = ["Jan", "Feb", "Mar","Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
			$.get("date", function(date){
				current_date = new Date(date);
				expected_finish_date = new Date (value.expected_finish_date);
				var Difference_In_Time = expected_finish_date.getTime() - current_date.getTime();
				var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
				var formatted_date = months[expected_finish_date.getMonth()] + ", " + expected_finish_date.getDate()+ " " + expected_finish_date.getFullYear();
				$("#span_"+ value.id +"").text(formatted_date);
				if(Difference_In_Days <= 10){
					$("#span_"+ value.id +"").text(Difference_In_Days+ ' days');
				}
				if(Difference_In_Days == 1){
					$("#span_"+ value.id +"").text(Difference_In_Days+ ' day');
				}
				if(Difference_In_Days == 0){
					$("#span_"+ value.id +"").text('Today');
				}
			});
		});
	});
});
</script>

<div>
<h3>Expired tasks</h3>
@if($expired_tasks->isEmpty())
<p><i>No expired tasks</i></p>
@else
<table align="center">
	<tr>
		<th>Task</th>
		<th>Expected finish date</th>
	</tr>
@foreach($expired_tasks as $task)
	<tr>
		<td><a href="tasks/{{$task->id}}">{{$task->title}}</a></td>
		<td>{{\Carbon\Carbon::parse($task->expected_finish_date)->toFormattedDateString()}}</span></td>
	</tr>
@endforeach
</table><br>
</div>
@endif

@endsection