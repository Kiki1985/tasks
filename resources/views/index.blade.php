@extends('layout')
@section('content')

<div style="margin:20px"><a href="/create"><button><b>Create a new task </b></button></a></div>

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
		<td><span id="span_{{$task->id}}">{{\Carbon\Carbon::parse($task->expected_finish_date)->toFormattedDateString()}}</span></td>
	</tr>
@endforeach
</table>
<!--<div id="tabela"></div> -->
	
@endif

<script type="text/javascript">

var xhttp;
xhttp = new XMLHttpRequest();

function tasks(){
	xhttp.open("GET", "tasks", true);
	xhttp.send();
	xhttp.onreadystatechange = function(){
		if(xhttp.readyState === 4){
		var tasks = JSON.parse(xhttp.responseText);
		
			renderHTML(tasks);	
		}
	}
}

function renderHTML(t){
	xhttp.open("GET", "date", true);
	xhttp.send();
	xhttp.onreadystatechange = function(){
		if(xhttp.readyState === 4){
			for(var i in t){
				var expected_finish_date = t[i].expected_finish_date;
				expected_finish_date = new Date(expected_finish_date);
				var current_date = new Date(xhttp.responseText);
				var Difference_In_Time = expected_finish_date.getTime() - current_date.getTime();
				var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
				//alert('id ' +t[i].id +' diference in days '+Difference_In_Days);

				if(Difference_In_Days <= 10)
				document.getElementById('span_'+t[i].id).innerHTML = Difference_In_Days+ ' days';
				if(Difference_In_Days == 1)
					document.getElementById('span_'+t[i].id).innerHTML = Difference_In_Days+ ' day';
					if(Difference_In_Days == 0)
					document.getElementById('span_'+t[i].id).innerHTML = ' Today';	
				if(Difference_In_Days < 0)
					 {{DB::table('tasks')->where('expected_finish_date', '<', $date)->delete()}};
			}
		}
	}
}

tasks();

</script>

@endsection