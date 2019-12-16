@extends('layout')
@section('content')


<button id="slideToggle"><b>Create a new task </b></button>

<div id="slideToggle_div" style="display: none">
	<p>Create a new task</p>
<script type="text/javascript">
$( document ).ready(function() {
	$('#slideToggle').click(function() {
		$('#slideToggle_div').slideToggle("slow");
	});
});
</script>

<form>

	<input type="text" name="title" placeholder="task" required="required" /><br><br>
	<input type="date" name="expected_finish_date" required="required" /><br><br>
	<textarea name="description" placeholder="description" required="required" /></textarea><br><br>
	
	<button id="create_task">Create</button>
</form><br>
@if(count($errors))
@include('errors')
@endif


</div> <!-- end div id="slideToggle_div" -->
<table id="table" align="center">
	<tr>
		<th>Task</th>
		<th>Expected finish date</th>
	</tr>
</table>

<script type="text/javascript">

$( document ).ready(function() {
	$('#create_task').click(function() {
		expected_finish_date = new Date($('input[name ="expected_finish_date"]').val());
		$.get("date", function(date){
			current_date = new Date(date);
			if(expected_finish_date < current_date){
				alert("Invalid date");
			}	
		});
		var title = $('input[name ="title"]').val();
		var description = $('textarea[name="description"]').val();
		var expected_finish_date = $('input[name ="expected_finish_date"]').val();
		$.ajax({
	        url: 'task',
	        type: 'get',
	        data: {title: title,description: description,expected_finish_date: expected_finish_date},
	        success: function(response){
	        	var tr = $("<tr><td><a href='tasks/"+response.id+"'>"+response.title+"</a></td><td id='td_"+response.id+"'>"+response.expected_finish_date+"</td></tr>");
				$("#table").append(tr);
				$('input[name ="title"]').val('');
				$('textarea[name="description"]').val('');
				$('input[name ="expected_finish_date"]').val('');
			}
		});
		return false;
	});
	jQuery.getJSON("tasks", function(data) {
		$.each(data, function(key, value){
		var tr = $("<tr><td><a href='tasks/"+value.id+"'>"+value.title+"</a></td><td id='td_"+value.id+"'>"+value.expected_finish_date+"</td></tr>");
		$("#table").append(tr);
			//$("#td_"+ value.id +"").text('hello');
			const months = ["Jan", "Feb", "Mar","Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
			$.get("date", function(date){
				current_date = new Date(date);
				expected_finish_date = new Date (value.expected_finish_date);
				var diff = new Date(expected_finish_date - current_date);
				var days = diff/1000/60/60/24;
				var formatted_date = months[expected_finish_date.getMonth()] + ", " + expected_finish_date.getDate()+ " " + expected_finish_date.getFullYear();

				
				$("#td_"+ value.id +"").text(formatted_date);
				if(days == 0){
					$("#td_"+ value.id +"").text('Today');
				}
				if(days == 1){
					$("#td_"+ value.id +"").text(days+ ' day');
				}
				if(days <= 10){
					$("#trd_"+ value.id +"").text(days+ ' days');
				}
			});
		});
	});
});

</script>

<div style="clear: both;">
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