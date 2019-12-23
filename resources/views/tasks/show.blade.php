@extends('layout')
@section('content')

<h1>{{$task->title}}</h1>
<hr>
<p>{{$task->description}}</p>

<p>Expected finish date: {{\Carbon\Carbon::parse($task->expected_finish_date)->toFormattedDateString()}}</p>

<p>Created {{\Carbon\Carbon::parse($task->created_at)->diffForHumans()}}</p><hr>
<h2>Update task</h2>

<form method="POST" action="{{action('TasksController@update', $id)}}">
@csrf
<input type="hidden" name="_method" value="PATCH">

	<input type="text" name="title" placeholder="task" value="{{$task->title}}" required="required" /><br><br>
	<input type="date" name="expected_finish_date" value="{{$task->expected_finish_date}}" required="required" /><br><br>
	<textarea name="description" placeholder="description" required="required" />{{$task->description}}</textarea><br><br>
	<input type="submit" value="Update">
</form><br>
<a href="/"><button>Back to Tasks</button></a>

@endsection