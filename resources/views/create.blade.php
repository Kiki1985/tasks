@extends('layout')
@section('content')
<p>Create a new task</p>

<form method="POST" action="/task">
@csrf
	<input type="text" name="title" placeholder="task" required><br><br>
	<textarea name="description" placeholder="description" required></textarea><br><br>
	<input name="expected_finish_date" type="date" required><br><br>
	<a href="/"><button>Create</button></a>
</form><br>
@if(count($errors))
@include('errors')
@endif

<a href="/"><button>Back</button></a>

@endsection