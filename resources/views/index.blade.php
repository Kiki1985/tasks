@extends('layout')
@section('content')


<button id="slideToggle"><b>Create a new task </b></button>
<div id="slideToggle_div" style="display: none">
	<p>Create a new task</p>
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
@if($tasks->isEmpty())

<p id="p_msg"><i>No tasks yet</i></p>

<div id="div_title"></div>

@else
<div id="div_title"></div>
@endif

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
	        	$('#p_msg').text('');
	        	$('#div_title').prepend('<p id="p_'+response.id+'">'+response.title+'</p><div id="hello_'+response.id+'" style="display:none">hello</div>');
			$('#p_'+response.id+'').click(function() {
				$("#hello_"+response.id+"").slideToggle("fast");
			});
				$('input[name ="title"]').val('');
				$('textarea[name="description"]').val('');
				$('input[name ="expected_finish_date"]').val('');
			}
		});
		return false;
	});
	jQuery.getJSON("tasks", function(data) {
		$.each(data, function(key, value){
		$('#div_title').append('<p id="p_'+value.id+'">'+value.title+'</p><div id="hello_'+value.id+'" style="display:none"><h2>'+value.title+'</h2><hr><p>'+value.description+'</p><p>Expected finish date: '+value.expected_finish_date+'</p><p>Created at: '+value.created_at+'</p><hr></div>');
			$('#p_'+value.id+'').click(function() {
				$("#hello_"+value.id+"").slideToggle("fast");
			});
			
		});
	});
});
$('#slideToggle').click(function() {
		$('#slideToggle_div').slideToggle("slow");
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