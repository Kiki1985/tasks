@extends('layout')
@section('title', 'Update task')
@section('content')
<h1>{{$task->title}}</h1>
<hr>
<p>{{$task->description}}</p>
<p>Expected finish date: {{\Carbon\Carbon::parse($task->dateToFinish)->toFormattedDateString()}}</p>
<p>Created {{\Carbon\Carbon::parse($task->created_at)->diffForHumans()}}</p><hr>
<h2>Update task</h2>
<form method="POST" action="/tasks/{{$task->id}}">
@method('PATCH')
@csrf
	<input type="text" name="title" placeholder="task" value="{{$task->title}}" required="required" /><br><br>
	<input type="date" name="dateToFinish" value="{{date('Y-m-d',strtotime($task->dateToFinish))}}" required="required" /><br><br>
	<textarea name="description" placeholder="description" required="required" />{{$task->description}}</textarea><br><br>
	<input type="submit" value="Update">
</form><br>
<a href="/tasks"><button>Back to Tasks</button></a>
@endsection