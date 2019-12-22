@extends('layout')
@section('content')

<button id="slideToggle"><b>Create a new task </b></button>
<div id="slideToggle_div" style="display: none"><br>
<form>
	<input type="text" name="title" placeholder="task" required="required" /><br><br>
	<input type="date" name="expected_finish_date" required="required" /><br><br>
	<textarea name="description" placeholder="description" required="required" /></textarea><br><br>
	<button id="create_task">Create</button>
</form><br>
@if(count($errors))
@include('errors')
@endif
</div> <!-- end div id="slideToggle_div" -->
<h2>Tasks</h2>
@if($tasks->isEmpty())

<p id="p_msg"><i>No tasks yet</i></p>

<div id="div_title"></div>

@else
<div id="div_title"></div>
@endif

<div style="clear: both;">
<h2>Expired tasks</h2>
@if($expired_tasks->isEmpty())
<p><i>No expired tasks</i></p>
@else
<div id="div_expired"></div>
</div>
@endif

@endsection