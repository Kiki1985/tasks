@extends('layout')
@section('title', 'Tasks')
@section('content')
<button id="slideTask"><b>Create a new task </b></button>
<div style="display: none"><br>
<form>
	<input type="text" name="title" placeholder="title" required="required" /><br><br>
	<input type="date" name="dateToFinish" required="required" /><br><br>
	<textarea name="description" placeholder="description" required="required" /></textarea><br><br>
	<button id="createTask">Create</button>
</form><br>
</div> <!-- end div id="slideTask" -->
<div id="title">
@foreach($tasks as $task)
@include('task')
@endforeach
</div>
<div id="expired">
@foreach($expireds as $task)
@include('task')
@endforeach
</div>
@endsection
