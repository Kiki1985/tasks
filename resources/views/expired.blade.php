@extends('layout')
@section('content')
<h1>Expired tasks</h1>
@if($expired_tasks->isEmpty())
<p><i>No expired tasks</i></p>
@else
@foreach($expired_tasks ?? '' as $expired_task)
	<h3>{{$expired_task->title}}</h3>
	<p>{{$expired_task->description}}</p>
	<p>Created at {{\Carbon\Carbon::parse($expired_task->created_at)->toFormattedDateString()}}</p>
	<p>Expired {{\Carbon\Carbon::parse($expired_task->expected_finish_date)->toFormattedDateString()}}</p>
	<hr>
@endforeach
@endif
<a href="/"><button>Tasks</button></a>
@endsection