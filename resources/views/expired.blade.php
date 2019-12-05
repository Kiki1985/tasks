@extends('layout')
@section('content')
<h1>Expired tasks</h1>
@if($expired_tasks->isEmpty())
<p><i>No expired tasks</i></p>
@else
@foreach($expired_tasks as $task)
	<h3>{{$task->title}}</h3>
	<p>{{$task->description}}</p>
	<p>Created at {{\Carbon\Carbon::parse($task->created_at)->toFormattedDateString()}}</p>
	<p>Expired {{\Carbon\Carbon::parse($task->expected_finish_date)->toFormattedDateString()}}</p>
	<hr>
@endforeach
@endif
<a href="/"><button>Tasks</button></a>
@endsection