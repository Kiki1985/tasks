@extends('layout')
@section('content')

<h1>{{$expired_task->title}}</h1>
<hr>
<p>{{$expired_task->description}}</p>

<p>Expected finish date: {{\Carbon\Carbon::parse($expired_task->expected_finish_date)->toFormattedDateString()}}</p>

<p>Created {{\Carbon\Carbon::parse($expired_task->created_at)->diffForHumans()}}</p>

<a href="/"><button>Back</button></a>

@endsection