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
		<td>{{\Carbon\Carbon::parse($task->expected_finish_date)->toFormattedDateString()}}</td>
	</tr>
@endforeach
</table>
@endif

@endsection