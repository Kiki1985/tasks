@extends('layout')
@section('content')
<h1>Expired tasks</h1>
@foreach($expired_tasks ?? '' as $expired_task)
	<h3>{{$expired_task->title}}</h3>
	<p>{{$expired_task->description}}</p>
	<p>Created at: {{\Carbon\Carbon::parse($expired_task->created_at)->toFormattedDateString()}}</p>
	<p>Expired at:{{\Carbon\Carbon::parse($expired_task->expected_finish_date)->toFormattedDateString()}}</p>
	<hr>
@endforeach
<a href="/"><button>Tasks</button></a>
@endsection