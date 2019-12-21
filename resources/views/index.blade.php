@extends('layout')
@section('content')

<button id="slideToggle"><b>Create a new task </b></button>
<div id="slideToggle_div" style="display: none"><br>
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
<h2>Tasks</h2>
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
	        	$('#div_title').prepend('<p style="cursor:pointer" id="p_'+response.id+'">'+response.title+'</p><div id=div1_'+response.id+'></div><div id="div_'+response.id+'" style="display:none"><hr><p>'+response.description+'</p><p>Expected finish date: '+response.expected_finish_date+'</p><p>Created at: '+response.created_at+'</p><hr></div>');
			$('#p_'+response.id+'').click(function() {
				$(this).text('');
				$('#div1_'+response.id+'').html('<h3 style="cursor:pointer" id="h3_'+response.id+'">'+response.title+'</h3>');
				$("#div_"+response.id+"").slideDown("fast");

				$('#h3_'+response.id+'').click(function() {
					$(this).text('');
					$('#p_'+response.id+'').html('<p style="cursor:pointer" id="p_'+response.id+'">'+response.title+'</p>');
					$("#div_"+response.id+"").slideUp("fast");
				});
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
		$('#div_title').append('<p style="cursor:pointer" id="p_'+value.id+'">'+value.title+'</p><div id=div1_'+value.id+'></div><div id="div_'+value.id+'" style="display:none"><hr><p>'+value.description+'</p><p>Expected finish date: '+value.expected_finish_date+'</p><p>Created at: '+value.created_at+'</p><hr></div>');

			$('#p_'+value.id+'').click(function() {
				$(this).text('');
				$('#div1_'+value.id+'').html('<h3 style="cursor:pointer" id="h3_'+value.id+'">'+value.title+'</h3>');
				$("#div_"+value.id+"").slideDown("fast");

				$('#h3_'+value.id+'').click(function() {
					$(this).text('');
					$('#p_'+value.id+'').html('<p style="cursor:pointer" id="p_'+value.id+'">'+value.title+'</p>');
					$("#div_"+value.id+"").slideUp("fast");
				});
			});
		});
	});
	//var msg ='Today';

	$('#slideToggle').click(function() {
		$('#slideToggle_div').slideToggle("slow");
	});
	jQuery.getJSON("expired", function(data) {
		$.each(data, function(key, value){
			$('#div_expired').append('<p style="cursor:pointer" id="p_'+value.id+'">'+value.title+'</p><div id=div1_'+value.id+'></div><div id="div_'+value.id+'" style="display:none"><hr><p>'+value.description+'</p><p>Expected finish date: '+value.expected_finish_date+'</p><p>Created at: '+value.created_at+'</p><hr></div>');

			$('#p_'+value.id+'').click(function() {
				$(this).text('');
				$('#div1_'+value.id+'').html('<h3 style="cursor:pointer" id="h3_'+value.id+'">'+value.title+'</h3>');
				$("#div_"+value.id+"").slideDown("fast");

					$('#h3_'+value.id+'').click(function() {
						$(this).text('');
						$('#p_'+value.id+'').html('<p style="cursor:pointer" id="p_'+value.id+'">'+value.title+'</p>');
						$("#div_"+value.id+"").slideUp("fast");
					});
			});
		});
	});
});

</script>

<div style="clear: both;">
<h2>Expired tasks</h2>
@if($expired_tasks->isEmpty())
<p><i>No expired tasks</i></p>
@else
<div id="div_expired"></div>
</div>
@endif

@endsection