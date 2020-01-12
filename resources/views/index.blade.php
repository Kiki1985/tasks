@extends('layout')
@section('title', 'Tasks')
@section('content')

<button id="slideToggle"><b>Create a new task </b></button>
<div id="slideToggleDiv" style="display: none"><br>
<form>
	<input type="text" name="title" placeholder="task" required="required" /><br><br>
	<input type="date" name="dateToFinish" required="required" /><br><br>
	<textarea name="description" placeholder="description" required="required" /></textarea><br><br>
	<button id="createTask">Create</button>
</form><br>
@if(count($errors))
@include('errors')
@endif
</div> <!-- end div id="slideToggle_div" -->
<h2>Tasks</h2>
@if($tasks->isEmpty())

<p id="msg"><i>No tasks yet</i></p>

<div id="title"></div>

@else
<div id="title"></div>
@endif

<div style="clear: both;">
<h2>Expired tasks</h2>
@if($expiredTasks->isEmpty())
<p><i>No expired tasks</i></p>
@else
<div id="expired"></div>
</div>
@endif

@endsection
