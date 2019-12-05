@extends('layout')
@section('content')
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
		<td><span id="span_{{$task->id}}">{{\Carbon\Carbon::parse($task->expected_finish_date)->toFormattedDateString()}}</span></td>
	</tr>
@endforeach
</table><br>

	
@endif
<a href="/"><button>Tasks</button></a>
@endsection