@extends('layout')
@section('content')

<h1>{{$task->title}}</h1>
<hr>
<p>{{$task->description}}</p>

<p>Expected finish date: {{\Carbon\Carbon::parse($task->expected_finish_date)->toFormattedDateString()}}</p>

<p>Created {{\Carbon\Carbon::parse($task->created_at)->diffForHumans()}}</p>

<a href="/"><button>Back</button></a>

@endsection