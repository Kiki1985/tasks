@extends('layout')
@section('content')

<div style="margin:20px"><a href="/create"><button><b>Create a new task </b></button></a></div>

@if($tasks->isEmpty())
<p><i>No tasks yet</i></p>
@else
<script type="text/javascript">

</script>
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
<a href="/expired_tasks"><button>Expired tasks</button></a>
<script type="text/javascript">
$(document).ready(function(){
	jQuery.getJSON("tasks", function(data) {
		//var objects = [];
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

@endsection